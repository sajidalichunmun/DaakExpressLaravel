<?php

ini_set("Display_errors",1); // show error in internet server

include_once '../../../SGL/vendor/autoload.php';
use \Firebase\JWT\JWT;

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = json_decode( file_get_contents("php://input"));
    
    if(!empty($data->userid) && !empty($data->AwbNo) && 
        !empty($data->DRelation) && !empty($data->RecName) && 
        !empty($data->DPhoneNo) && !empty($data->CreatedBy) &&
        !empty($data->otp) && !empty($data->jwt) )
    {
        $UserID = $data->userid;
        $AwbNo = strtoupper($data->AwbNo); 
        $DRelation = strtoupper($data->DRelatio); 
        $RecName= strtoupper($data->RecName);
        $DPhoneNo = $data->DPhoneNo; 
        $CreatedBy = strtoupper($data->CreatedBy); 
        $otp = $data->otp;
        $jwt = $data->jwt;

        try{
//                //$all_headers = getallheaders();
//                
                $secret_key = 'owt125';
                //$jwt = $all_headers['Authorization'];

                $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));
                
           }catch(Exception $ex){
              //http_response_code(500); // 500 server error
              echo json_encode(array(
                    "error" => true,
                    "status" => 0,
                    "message" => $ex->getMessage()
                    ));
              die;
            }
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

            $stmt = $db->prepare("SELECT AwbNo FROM delivery WHERE AwbNo = ?");
            $stmt->bind_param("s", $AwbNo);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows > 0)
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(array("error" => true,"message" => $AwbNo .' Already Delivered !!'));
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

            $sql = "select * from pod_delivered_otp WHERE Expired = 1 and otp = ?";
            $sql = "select * from pod_delivered_otp WHERE otp = ?";
            $stmt = $db->prepare($sql);
            if($db->error)
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(Array("error" => true,"message" => $db->error));
                die;
            }

            $stmt->bind_param("i", $otp);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows <= 0)
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(array("error" => true ,"message" => 'Wrong OPT Number!!'));
                die;
            }        

            $sql = "UPDATE pod_delivered_otp SET Expired=0 WHERE otp = ? and Expired = 1";
            $sql = "UPDATE pod_delivered_otp SET Expired=0 WHERE otp = ?";
            $stmt=$db->prepare($sql);
            if($db->error)
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(Array("error" => true,"message" => $db->error));
                die;
            }
                    
            $stmt->bind_param("s",$otp);
            if(!$stmt->execute())
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(array("error" => true,"message" => "Error in OTP Verification ". $sql ));
                die;
            }

            
            $sql = "INSERT INTO delivery (AwbNo,RecName,DRelation,DPhoneNo,CreatedBy,CreatedOn,DlvStatus,dlvDt)
            VALUES (?, ?, ?, ?, ?, NOW(),'DELIVERED',date_format(now(),'%Y-%m-%d'))";
            $stmt = $db->prepare($sql);
            if($db->error)
            {
                //http_response_code(400); // 400 Errors
                echo json_encode(Array("error" => true,"message" => $db->error));
                die;
            }
                
            $stmt->bind_param("sssss", $AwbNo, $RecName, $DRelation, $DPhoneNo, $CreatedBy);

            if($stmt->execute())
            {
                $sql = "UPDATE AWBMASTER SET Status = 'DELIVERED',RouteDate = Now() WHERE AwbNo = ?";
                $stmt = $db->prepare($sql); 
                if($db->error)
                {
                    //http_response_code(400); // 400 Errors
                    echo json_encode(Array("error" => true,"message" => $db->error));
                    die;
                }
                $stmt->bind_param("s",$AwbNo);
                if($stmt->execute())
                {
                    $stmt ="INSERT INTO AWBMASTER_HIST(PodSlNo,AwbNo,HistDate,HistStatus,CreatedBy,CreatedOn)
                             SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END,
                            '". $AwbNo ."',date_format(NOw(),'%Y-%m-%d'),'DELIVERED','". $CreatedBy ."',NOW() 
                            FROM AWBMASTER_HIST WHERE AWBNO='". $AwbNo ."'";

                    $result = mysqli_query($db, $stmt);


                    //http_response_code(200); // 200 Ok
                    echo json_encode(array("error" => false, "message" => $AwbNo ." Your OPT Successfully verified !!"));
                    die;
                }else{
                    echo json_encode(Array("error" => true,"message" => "Error in Updating AwbMaster?". $sql));
                    die;
                }
            }else{  
                    //http_response_code(400); // 400 Errors
                    echo json_encode(Array("error" => true,"message" => "Inserting Values Delivery?". $sql));
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

