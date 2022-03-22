<?php

ini_set("Display_errors",1); // show error in internet server

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = json_decode( file_get_contents("php://input"));
    
    if(!empty($data->userid) && !empty($data->AwbNo) && 
        !empty($data->rtostatus) && !empty($data->reasonid) && 
        !empty($data->CreatedBy) )
    {
        $UserID = $data->userid;
        $AwbNo = strtoupper($data->AwbNo); 
        $RtoStatus = strtoupper($data->rtostatus); 
        $ReasonID= strtoupper($data->reasonid);
        $CreatedBy = strtoupper($data->CreatedBy); 
        
        $stmt = $db->prepare("SELECT *FROM AWBMASTER WHERE AWBNO = ?");
        $stmt->bind_param("s", $AwbNo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows <= 0)
        {
            //http_response_code(400); // 400 Errors
            echo json_encode(array("error" => true,"message" => "Record not found.. awbmaster"));
            die;
        }

        $stmt = $db->prepare("select a.awbno from awbmaster a
        inner join awb_scan_out o on a.awbno=o.awbno
        inner join deliveryboy b on o.dlvboyid=b.DLVBOYID
        where b.USERID = ? AND a.AwbNo = ?");
        if($db->error)
        {
            //http_response_code(400); // 400 Errors
            echo json_encode(Array("error" => true,"message" => $db->error));
            die;
        }
        $stmt->bind_param("ss",$UserID, $AwbNo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows <= 0)
        {
            //http_response_code(400); // 400 Errors
            echo json_encode(array("error" => true ,"message" => $AwbNo .' not belong to Delivery boy '. $CreatedBy));
            die;
        }        
        $sql = "INSERT INTO RTO(AwbNo,RtoStatus,rtodt,R_ID,CreatedBy,CreatedOn)
        VALUES (?, ?, date_format(Now(),'%Y-%m-%d'), ?, ?, NOW())";
        $stmt = $db->prepare($sql);
        if($db->error)
        {
            //http_response_code(400); // 400 Errors
            echo json_encode(Array("error" => true,"message" => $db->error));
            die;
        }

        $stmt->bind_param("ssss", $AwbNo, $RtoStatus, $ReasonID, $CreatedBy);

        if($stmt->execute())
        {
            $sql = "UPDATE AWBMASTER SET Status = ?,RouteDate = Now() WHERE AwbNo = ?";
            $stmt = $db->prepare($sql); 
            if($db->error)
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(Array("error" => true,"message" => $db->error));
                die;
            }
            $stmt->bind_param("ss",$RtoStatus,$AwbNo);
            if($stmt->execute())
            {
                $stmt ="INSERT INTO AWBMASTER_HIST(PodSlNo,AwbNo,HistDate,HistStatus,CreatedBy,CreatedOn)
                         SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END,
                        '". $AwbNo ."',date_format(NOw(),'%Y-%m-%d'),'". $RtoStatus ."','". $CreatedBy ."',NOW() 
                        FROM AWBMASTER_HIST WHERE AWBNO='". $AwbNo ."'";

                $result = mysqli_query($db, $stmt);


                //http_response_code(200); // 200 Ok
                echo json_encode(array("error" => false, "message" => $AwbNo ." RTO Successfully Updated !!"));
                die;
            }else{
                echo json_encode(Array("error" => true,"message" => "Error in Updating AwbMaster?". $sql));
                die;
            }
        }else{  
                //http_response_code(400); // 400 Errors
                echo json_encode(Array("error" => true,"message" => "Inserting Values RTO?". $sql));
                die;
        }
    }
    else{
        //http_response_code(404); // 404 Required fields values
        echo json_encode(array(
                "error" => true,
                "message" => 'All fields value required'
                ));
    }
}
else{
    //http_response_code(500); // 503 means service unavilable
    echo json_encode(array(
            "error" => true,
            "message" => 'Access denied'
            ));
}
?>

