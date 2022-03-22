<?php

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');
header('Access-Control-Allow-Method: POST');

$data = file_get_contents("php://input",true);

//$data = json_decode($json,true);

$otp = $_POST['otp'];

//$otp = $otp['otp']; 

//$otp =524669;
$stmt = '';
if(empty($otp))
{
    echo json_encode(Array("error" => true,"message" => "OTP NOT BE EMPTY ". $otp));
    return;
}
$stmt = "select otp from pod_delivered_otp WHERE otp = ". $otp ." AND Expired = 0";
$result = mysqli_query($db, $stmt);
if($db->error)
{
    echo json_encode(Array("error" => true,"message" => $db->error));
    die();
}
if(mysqli_num_rows($result)>0)
{
    $stmt=$db->prepare("UPDATE pod_delivered_otp SET Expired=1 WHERE otp = ? and Expired = 0");
    if($db->error)
    {
        echo json_encode(Array("error" => true,"message" => $db->error));
        die();
    }
    $stmt->bind_param("s",$otp);
    if($stmt->execute())
    {
        echo json_encode(array("error" => false,"success" => 200,"message" => "Your OPT Successfully verified !!"));
    }
}
else{
    echo json_encode(array("error" => true,"message" => "Wrong OPT !! ". $otp  ));
}

?>

