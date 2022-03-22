<?php
include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

$json = file_get_contents("php://input",true);
$data = json_decode($json,true);
//echo json_encode(["data" => $data]);
//return;
if(isset($_POST["AwbNo"])){
    $AwbNo = strtoupper( $_POST["AwbNo"]); 
    
    $query="select h.PodSlNo,h.HistDate,h.HistStatus,a.*from AwbMaster a 
            INNER JOIN AwbMaster_Hist h on a.awbno=h.awbno
            Where a.awbno = '". $AwbNo ."'  order by h.PodSlNo desc";
    
    $result= mysqli_query($db, $query) or die(json_encode(['error'=>true,'message' => 'Sql Query Error']));
    $rowCount= mysqli_num_rows($result);
    if($rowCount > 0)
    {
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode(array("error" => FALSE, "data" => $output ,"message" => "successs"));
    }
    else
    {
        echo json_encode(["error" => True ,"data" => "", "message" => "Record not found !!" . $query]);
    }
}else
{
    echo json_encode(["error" => True ,"data" => $data, "message" => "Invalid credential!!"]);
}


?>
