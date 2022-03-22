<?php
error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content Type: Application/json');
header('Access-Control-Allow-Method: GET');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    

include_once '../../Database/dbConnection.php';

$query = "SELECT R_ID ID,R_Name NAME FROM ReasonMaster";

$result = mysqli_query($db, $query) or die(json_encode(["error" => true ,"message" => "MySql Query Error? ".$query]));
if(mysqli_num_rows($result)>0)
{
    $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode(array("error" => false,"message"=>"find", "data" => $output));
}
else
{
    echo json_encode(["error" => true ,"message" => "Record not found !!"]);
}
}else{
    echo json_encode(["error" => true ,"message" => "Access denied !!"]);
}
?>