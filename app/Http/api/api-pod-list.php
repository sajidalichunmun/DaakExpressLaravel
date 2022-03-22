<?php
error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');
header('Access-Control-Allow-Method: POST');
//header('Access-Control-Allow-Method: GET');
$json = file_get_contents("php://input",true);
$data = json_decode($json,true);

include_once '../../Database/dbConnection.php';

$UserID = $_GET["userid"];
//$UserID = $_POST["userid"];

$query = "select a.awbno,a.status from awbmaster a
inner join awb_scan_out o on a.awbno=o.awbno
inner join deliveryboy b on o.dlvboyid=b.DLVBOYID 
where b.USERID =". $UserID ." AND a.status='SCAN OUT'";


$result = mysqli_query($db, $query) or die(json_encode(Array("error" => true,"data" => "", "message" => 'Sql Query error '. $query)));
if(mysqli_num_rows($result)>0)
{
    $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode(array("error" => FALSE, "data" => $output ,"message" => "successs"));
}
else
{
    echo json_encode(["error" => true ,"data" => "", "message" => "Record not found !!"]);
}

//$sql = "select *From RelationMaster";
//if(!$db->query($sql))
//{
//   echo "Error in Connection to Database.";
//}
//else
//{
//    $result = $db->query($sql);
//    if($result->num_rows >0)
//    {
//        $return_arr['relation'] = array();
//        while($row = $result->fetch_Array())
//        {
//            array_push($return_arr['relation'], array(
//                'id' => $row['RelID'],
//                'name' => $row['RelName']
//                ));
//        }
//        echo json_encode($return_arr);
//    }
//}
?>