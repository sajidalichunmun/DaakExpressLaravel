<?php

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

$json = file_get_contents("php://input",true);
$data = json_decode($json,true);


$UserID = $_POST["userid"];
//$AwbNo = strtoupper( $_POST["AwbNo"]); 

$stmt = "select a.awbno,a.CustomerName,a.product,a.cod_prepaid,a.amount from awbmaster a
inner join awb_scan_out o on a.awbno=o.awbno
inner join deliveryboy b on o.dlvboyid=b.DLVBOYID
where b.USERID =". $UserID ." AND a.status='SCAN OUT'";
//where a.AwbNo like '". $AwbNo ."%'"; //AND b.USERID =". $UserID ." AND SSa.status='SCAN OUT'";
$result = mysqli_query($db, $stmt) or die(json_encode(Array("error" => true,"message" => 'Sql Query error' . $stmt)));

if(mysqli_num_rows($result) <= 0)
{
    echo json_encode(array("error" => true ,"message" => $AwbNo .' not found'));
    return;
}
while ($row = mysqli_fetch_all($result,MYSQLI_ASSOC))
{
    $output = $row;
}

echo json_encode(["error" => false, "data" => $output, "message" => "success"]);
?>