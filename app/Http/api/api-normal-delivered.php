<?php
ini_set("Display_errors",1);

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->AwbNo) && !empty($data->DRelation) &&
       !empty($data->RecName) && !empty($data->CreatedBy) &&
       !empty($data->userid))
    {
        $UserID = $data->userid;
        $AwbNo = strtoupper( $data->AwbNo); 
        $DRelation = strtoupper($data->DRelation); 
        $RecName= strtoupper($data->RecName);
        $DPhoneNo = $data->DPhoneNo; 
        $CreatedBy = strtoupper($data->CreatedBy); 

        $stmt = $db->prepare("SELECT *FROM AWBMASTER WHERE AWBNO = ?");
        $stmt->bind_param("s", $AwbNo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows <= 0)
        {
            echo json_encode(array("error" => true,"message" => "Record not found.. awbmaster"));
            $stmt->close();
            return;
        }

        $stmt = $db->prepare("SELECT AwbNo FROM delivery WHERE AwbNo = ?");
        $stmt->bind_param("s", $AwbNo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0)
        {
            echo json_encode(array("error" => true,"message" => $AwbNo .' Already Delivered !!'));
            $stmt->close();
            return;
        }

        $stmt = $db->prepare("select a.awbno from awbmaster a
        inner join awb_scan_out o on a.awbno=o.awbno
        inner join deliveryboy b on o.dlvboyid=b.DLVBOYID
        where b.USERID = ? AND a.AwbNo = ?");
        if($db->error)
        {
            echo json_encode(Array("error" => true,"message" => $db->error));
            die();
        }
        $stmt->bind_param("ss",$UserID, $AwbNo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows <= 0)
        {
            echo json_encode(array("error" => true ,"message" => $AwbNo .' not belong to Delivery boy '. $CreatedBy));
            return;
        }        

        $stmt = '';

        $stmt = $db->prepare("INSERT INTO delivery (AwbNo,RecName,DRelation,DPhoneNo,CreatedBy,CreatedOn,DlvStatus,dlvDt)
        VALUES (?, ?, ?, ?,?,NOW(),'DELIVERED',date_format(now(),'%Y-%m-%d'))");
        if($db->error)
        {
            echo json_encode(Array("error" => true,"message" => $db->error));
            die();
        }

        $stmt->bind_param("sssss", $AwbNo, $RecName, $DRelation, $DPhoneNo, $CreatedBy);

        if($stmt->execute())
        {
            $stmt = $db->prepare("UPDATE AWBMASTER SET Status = 'DELIVERED',RouteDate = Now() WHERE AwbNo = ?"); 
            if($db->error)
            {
                echo json_encode(Array("error" => true,"message" => $db->error));
                die();
            }
            $stmt->bind_param("s",$AwbNo);
            $stmt->execute();
            $stmt->close();
            $stmt ="INSERT INTO AWBMASTER_HIST(PodSlNo,AwbNo,HistDate,HistStatus,CreatedBy,CreatedOn)
                     SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END,
                    '". $AwbNo ."',date_format(NOw(),'%Y-%m-%d'),'DELIVERED','". $CreatedBy ."',NOW() 
                    FROM AWBMASTER_HIST WHERE AWBNO='". $AwbNo ."'";

            $result = mysqli_query($db, $stmt);

            echo json_encode(array("error" => false, "message" => $AwbNo ."  Successfully Saved !!"));
            return;
        }else{
        echo json_encode(array(
            "error" => true,
            "message" => 'Error in inserting recores?'
            ));
        }
    }
    else{
        echo json_encode(array(
            "error" => true,
            "message" => 'All fields value required...'
            ));
    }
}else{
    //http_response_code(500); // 503 means service unavilable
    echo json_encode(array(
            "error" => true,
            "message" => 'Access denied'
            ));
}
?>

