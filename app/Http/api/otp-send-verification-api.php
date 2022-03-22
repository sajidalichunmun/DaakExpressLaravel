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
        !empty($data->DPhoneNo) && !empty($data->CreatedBy))
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
            //http_response_code(400); // 400 Errors
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
            //http_response_code(400); // 400 Errors
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
            //http_response_code(400); // 400 Errors
            echo json_encode(Array("error" => true,"message" => $db->error));
            die();
        }
        $stmt->bind_param("ss",$UserID, $AwbNo);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows <= 0)
        {
            //http_response_code(400); // 400 Errors
            echo json_encode(array("error" => true ,"message" => $AwbNo .' not belong to Delivery boy '. $CreatedBy));
            return;
        }        

        $otp = rand(100000, 999999);

        $otp = random_int(100000, 999999);
        $username = "sajid.ali073@gmail.com";
        $username = "pramod.gupta@daakexpress.co.in";
        $password = "PkSk$4100";


        //Send by Class
        $MobileNo = "91".$DPhoneNo;

        // SMS BY POST METHOD
        $apiKey = urlencode('6jsVmB+jG7k-v3URJ4r4i8LiYCPDGodtwACAnybQdU');

        $numbers = $MobileNo;
        $sender = urlencode('TXTLCL');
        $message = rawurlencode('Your One Time Password is ' . $otp);

        $message = rawurlencode('Welcome in Daak Express. We comes with new Approach in logistics.

Pramod Gupta.');

        //$sender = urlencode('800021');
//        $sender = urlencode('');


        
      // $message = rawurlencode("Welcome to DAAK Express . Your OTP for mobile verification %%|OTP^{"inputtype" : "text", "maxlength" : "6"}%%

//Thanks 
//DAAK Express");

$message = rawurlencode('Welcome to DAAK Express . Your OTP for mobile verification '.$otp.'

Thanks 
DAAK Express');

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $xxx = json_decode($response);
        
        if($xxx->status != 'success'){
            //http_response_code(400); // 400 Errors
            echo json_encode(array("error" => true,"message" => $response));
            return;
        }
        
        
        $sql = "INSERT INTO pod_delivered_otp(otp,AwbNo,CreatedBy,Created_at)
                VALUES(?, ?, ?, Now(), 1)";
        $sql = "INSERT INTO pod_delivered_otp(otp,AwbNo,CreatedBy)
                VALUES(?, ?, ?)";
        $stmt=$db->prepare($sql);
        if($db->error)
        {
            //http_response_code(400); // 400 Errors
            echo json_encode(Array("error" => true,"message" => $db->error));
            die();
        }
        $stmt->bind_param("sss",$otp, $AwbNo, $CreatedBy);
        if($stmt->execute())
        {
            try{
            // Generation token for delivery verification

            $time = 120; // time of seconds
            $iss = "http://app.daakexpress.co.in"; // host name localhost
            $iat = time(); // issue at time
            $nbf = $iat + 10; // issue at add 10 second
            $exp = $iat + $time; // expire token after issue time of 10 seconds;
            $aud = "myusers";
            $user_array_data = array(
                "id"=> $user_data['id'],
                "name"=> $user_data['name'],
                "email"=> $user_data['email'],
            );
            if($time>60){
            $time =$time/60;
            $time .= ' Minutes';
            }else{
                $time .= ' Seconds';
            }
            $secret_key = 'owt125';

            $payload_info = array(
                "iss" => $iss,
                "iat" => $iat,
                "nbf" => $nbf,
                "exp" => $exp,
                "aud" => $aud,
                "data" => $user_array_data
            );

            //$jwt = JWT::encode($payload_info, $secret_key); // default alg

            $jwt = JWT::encode($payload_info, $secret_key, 'HS512');
        // End Delivery Token verification
            } catch (Exception $ex){
                //http_response_code(500); // 500 server error
                echo json_encode(array(
                      "error" => true, 
                      "status" => 0,
                      "message" => $ex->getMessage()
                      ));
                die;
            }
            
            $message = 'Your One Time Password is ' . $otp . ' expire after '. $time ;
            
            echo json_encode(array(
                                "jwt" => $jwt,
                                "error" => false, 
                                "success" => 200, 
                                "message2" => $response .' Mobile No '. $MobileNo, 
                                "message1" => $AwbNo .' successfully Delivered', 
                                "OPT" => $otp, "message" => $message 
                    ));
        }else{
            //http_response_code(400); // 400 Errors
            echo json_encode(array("error" => true, "message" => "Sql Query !! "));
            die;
        }  

    }
    else{
        //http_response_code(404); // 404 Required fields values
        echo json_encode(array(
                "error" => true,
                "message" => 'All fields value required'
                ));
        die;
    }
}
else{
    //http_response_code(500); // 503 means service unavilable
    echo json_encode(array(
            "error" => true,
            "message" => 'Access denied'
            ));
    die;
}

?>

