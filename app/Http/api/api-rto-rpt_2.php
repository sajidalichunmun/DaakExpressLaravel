<?php

ini_set("Display_errors",1);

include_once '../../Database/dbConnection.php';

error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/Json');
header('Access-Control-Allow-Method: POST');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $json = json_decode(file_get_contents("php://input"));

    $query="SELECT RM.R_NAME,RTODT,A.* FROM AWBMASTER A
        INNER JOIN rto R ON A.AwbNo=R.AwbNo
        INNER JOIN REASONMASTER RM ON RM.R_ID=R.R_ID
        WHERE A.STATUS='RTO'";
    if(!empty($json->AwbNo)){
        $query="SELECT RM.R_NAME,RTODT,A.* FROM AWBMASTER A
        INNER JOIN rto R ON A.AwbNo=R.AwbNo
        INNER JOIN REASONMASTER RM ON RM.R_ID=R.R_ID
        WHERE A.STATUS='RTO' and a.awbno = ?"; 
    }

    $stmt = $db->prepare($query);
    if(!empty($json->AwbNo)){
         $stmt->bind_param("s",$json->AwbNo);
    }
       
    $stmt->execute();
   $result = $stmt->store_result();
echo json_encode(["error" => true, "data" => $result->num_rows,"xxx" => $stmt->num_rows]);
die;
    if($stmt->num_rows > 0)
    {
        $output = $result->fetch_assoc();
        echo json_encode(array("error" => false,"message" => "successs","data" => $output)));
        die;
    }
    else
    {
        echo json_encode(["error" => True ,"message" => "Record not found !!" . $query]);
        die;
    }
}else{
    //http_response_code(500); // 503 means service unavilable
    echo json_encode(array(
            "error" => true,
            "message" => 'Access denied'
            ));
    die;
}
?>
