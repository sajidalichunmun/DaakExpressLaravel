<?php

//ini_set("Display_errors",1);

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $json = json_decode(file_get_contents("php://input"));

    $AwbNo='';
    if(!empty($json->AwbNo)){
        $AwbNo =" and a.awbno ='". strtoupper( $json->AwbNo) ."' ";
    }

    $query="SELECT RM.R_NAME,RTODT,A.* FROM AWBMASTER A
        INNER JOIN rto R ON A.AwbNo=R.AwbNo
        INNER JOIN REASONMASTER RM ON RM.R_ID=R.R_ID
        WHERE A.STATUS='RTO'  ". $AwbNo;

    $result= mysqli_query($db, $query) or die(json_encode(['error'=>true,'message' => 'Sql Query Error']));
    $rowCount= mysqli_num_rows($result);
    if($rowCount > 0)
    {
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode(array("error" => false, "data" => $output ,"message" => "successs"));
    }
    else
    {
        echo json_encode(["error" => True ,"data" => "", "message" => "Record not found !!" . $query]);
    }
}else{
    //http_response_code(500); // 503 means service unavilable
    echo json_encode(array(
            "error" => true,
            "message" => 'Access denied'
            ));
}
?>
