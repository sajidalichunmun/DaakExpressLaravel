<?php
include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

$json = file_get_contents("php://input",true);
$data = json_decode($json,true);
//echo $data["name"];

//$UserID = $_POST["userid"];
//$AwbNo = strtoupper( $_POST["AwbNo"]); 
//$DRelation = strtoupper($_POST["DRelation"]); 
//$RecName= strtoupper($_POST["RecName"]);
//$DPhoneNo = $_POST["DPhoneNo"]; 
//$CreatedBy = strtoupper($_POST["CreatedBy"]); 

$UserID = $data["userid"];
$AwbNo = strtoupper( $data["AwbNo"]); 
$DRelation = strtoupper($data["DRelation"]); 
$RecName= strtoupper($data["RecName"]);
$DPhoneNo = $data["DPhoneNo"]; 
$CreatedBy = strtoupper($data["CreatedBy"]); 


//$UserID = 1;
//$AwbNo = strtoupper( "CIBOM0126232"); 
//$DRelation = strtoupper("Relation Name"); 
//$RecName= strtoupper("Receiver Name");
//$DPhoneNo = "6205227853"; 
//$CreatedBy ="Sajid";

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

$otp = rand(100000, 999999);

$otp = random_int(100000, 999999);
$username = "sajid.ali073@gmail.com";
$username = "pramod.gupta@daakexpress.co.in";
$password = "PkSk$4100";

//Send by Class
$MobileNo = "91".$DPhoneNo;

//    require('Textlocal.class.php');
//    
//    $Textlocal = new Textlocal(false, false, 'CMVghqFHvjQ-CnxgVdjUmbL2E2DBBUpqkU8WJJLaUv');
//
//    $numbers = array("918102795965");
//    $sender = 'TXTLCL';
//    $message = 'This is your message';
//
//    $response = $Textlocal->sendSms($numbers, $message, $sender);
//    echo json_encode(array("error" => false, "success" => 200, "message2" => $response .' Mobile No '. $MobileNo, "message1" => $AwbNo .' successfully Delivered', "OPT" => $otp, "message" => $message));
//    die();


//Send By Get Method
// Account details
//    $apiKey = urlencode('CMVghqFHvjQ-CnxgVdjUmbL2E2DBBUpqkU8WJJLaUv');
//
//    // Message details
//    $MobileNo = "91". $DPhoneNo;
//    $numbers = urlencode('917988126020');
//    $sender = urlencode('TXTLCL');
//    $message = rawurlencode('Your One Time Password is ' . $otp);
//
//    // Prepare data for POST request
//    $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
//
//    // Send the GET request with cURL
//    $ch = curl_init('https://api.textlocal.in/send/?' . $data);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $response = curl_exec($ch);
//    curl_close($ch);
//    $message = 'Your One Time Password is ' . $otp;
//    echo json_encode(array("error" => false, "success" => 200, "message2" => $response .' Mobile No '. $MobileNo, "message1" => $AwbNo .' successfully Delivered', "OPT" => $otp, "message" => $message));
//    die();
//    
// SMS BY POST METHOD
$apiKey = urlencode('6jsVmB+jG7k-v3URJ4r4i8LiYCPDGodtwACAnybQdU');

// Message details
//    $MobileNo = '918102795965, 918987654321';
//    $numbers = array($MobileNo);
//$numbers = implode(',', $numbers);

//$numbers = array($MobileNo);
$numbers = $MobileNo;
$sender = urlencode('TXTLCL');
//$sender = urlencode('6AA3L');
$message = rawurlencode('Your One Time Password is ' . $otp);

$message = rawurlencode('Welcome in Daak Express. We comes with new Approach in logistics.

Pramod Gupta.');

//Welcome to DAAK Express . Your OTP for mobile verification %%|OTP^{"inputtype" : "text", "maxlength" : "6"}%%

//Thanks 
//DAAK Express

// Prepare data for POST request
$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

// Send the POST request with cURL
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
    
$message = 'Your One Time Password is ' . $otp;

//    // Authorisation details.
//    
//    $hash = "CMVghqFHvjQ-CnxgVdjUmbL2E2DBBUpqkU8WJJLaUv";
//
//    // Config variables. Consult http://api.textlocal.in/docs for more info.
//    $test = "0";
//    $MobileNo = "91". $DPhoneNo;
//    // Data for text message. This is the text message data.
//    $sender = "TXTLCL"; // This is who the message appears to be from.
//    $numbers = "910000000000"; // A single number or a comma-seperated list of numbers
//    $numbers = "91". $DPhoneNo;
//    $message = "This is a test message from the PHP API script.";
//
//    $message = "Your One Time Password is " . $otp;
//    // 612 chars or less
//    // A single number or a comma-seperated list of numbers
//    $message = urlencode($message);
//    
//    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
//    $ch = curl_init('http://api.textlocal.in/send/?'. $data);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $response = curl_exec($ch); // This is the result from the API
//    curl_close($ch);
//    
//    $message = 'Your One Time Password is ' . $otp;
//    echo json_encode(array("error" => false, "success" => 200, "message2" => $response .' Mobile No '. $MobileNo, "message1" => $AwbNo .' successfully Delivered', "OPT" => $otp, "message" => $message));
//if($response['status'] != 'success'){
//    echo json_encode(array("error" => true,"message" => $response));
//    return;
//}
$stmt=$db->prepare("INSERT INTO pod_delivered_otp(otp,AwbNo,CreatedBy,CreatedOn,Expired)
        VALUES(?, ?, ?, Now(), 0)");
if($db->error)
{
    echo json_encode(Array("error" => true,"message" => $db->error));
    die();
}
$stmt->bind_param("sss",$otp, $AwbNo, $CreatedBy);
if($stmt->execute())
{
    echo json_encode(array("error" => false, "success" => 200, "message2" => $response .' Mobile No '. $MobileNo, "message1" => $AwbNo .' successfully Delivered', "OPT" => $otp, "message" => $message));
}else{
    echo json_encode(array("error" => true, "message" => "Sql Query !! "));
}  

?>

