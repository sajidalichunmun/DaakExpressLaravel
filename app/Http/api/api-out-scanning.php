<?php
error_reporting(E_ALL & ~ E_NOTICE);

header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');
header('Access-Control-Allow-Method: POST');
//header('Access-Control-Allow-Method: GET');
$json = file_get_contents("php://input",true);
$data = json_decode($json,true);

include_once '../../Database/dbConnection.php';

$custname = '';

$PodNo=$data['txtPodNo'];
$dlvboyid=$data['txtDlvBoy'];
$franid=$data['txtFran'];
$routedate=$data['poddate'];

$query="SELECT *FROM AWBMASTER WHERE AWBNO='". $PodNo ."'";
$result= mysqli_query($db, $query);
$rowCount= mysqli_num_rows($result);
if($rowCount <= 0)
{
    echo json_encode(["success" => "error", "status" => true,"message" => "Record not found"]);
    return;
}
 else {
    while ($rows = mysqli_fetch_array($result)){
        //$custname = $rows->CustomerName;
        $custname = $rows[7];
    }
}

$query="SELECT *FROM AWBMASTER aw".
        " INNER JOIN FranchiseeMaster F ON aw.FranID=f.FranID".
        " WHERE AWBNO='". $PodNo ."' and f.FranID=". $franid;
$result= mysqli_query($db, $query);
$rowCount= mysqli_num_rows($result);
if($rowCount <= 0)
{
    echo json_encode(["success" => "error", "status" => true,"message" => $PodNo .' not belong to selectd Franchisee']);
    return;
}
$query="SELECT *FROM AWB_SCAN_OUT WHERE AWBNO='". $PodNo ."'";

$result= mysqli_query($db, $query);
$rowCount= mysqli_num_rows($result);
if($rowCount>0)
{
    echo json_encode(["success" => "error", "status" => true,"message" => 'Already Scan POD '. $PodNo ]);
    return;
}
try 
{
    $db->autocommit(FALSE); // i.e., start transaction

    $query="UPDATE AWBMASTER SET Status='SCAN OUT',RouteDate='". $routedate .
           "' WHERE AwbNo='". $PodNo ."'";

    $result = $db->query($query);
    if ( !$result ) 
    {
        $btnSave=FALSE;
        $db->rollback(); 
        $db->autocommit(TRUE);
        return json_encode(["success" => "error", "status" => true,"message" => 'Commit transaction failed? '. $query ]);
    }

        $query="INSERT INTO AWBMASTER_HIST(PodSlNo,AwbNo,HistDate,HistStatus,CreatedBy,CreatedOn)".
               " SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END,".
               "'". $PodNo ."','". $routedate ."','SCAN OUT','". $_SESSION['USERNAME'] ."',NOW() FROM AWBMASTER_HIST WHERE AWBNO='". $PodNo ."'";

        $result = $db->query($query);
        if ( !$result ) 
        {
            $btnSave=FALSE;
            $db->rollback(); 
            $db->autocommit(TRUE);
           echo json_encode(["success" => "error", "status" => true,"message" => 'Commit transaction failed? '. $query ]);
           return;
        }

        $query="INSERT INTO AWB_SCAN_OUT(AwbNo,ScanOutdt,DlvBoyID,CreatedBy,CreatedOn)".
               " VALUES('". $PodNo ."','". $routedate ."',". $dlvboyid .",'". $_SESSION['USERNAME'] ."',Now())";

        $result = $db->query($query);
        if ( !$result ) 
        {
            $btnSave=FALSE;
            $db->rollback(); 
            $db->autocommit(TRUE);
           echo json_encode(["success" => "error", "status" => true,"message" => 'Commit transaction failed? '. $query ]);
           return;
        }
        $db->commit();
        $db->autocommit(TRUE); // i.e., end transaction
        echo json_encode(["success" => "success", "status" => false,"message" => 'Record successfully Saved', "prevcustname" => $custname ]);
}
catch (Exception $ex) 
{
    $db->rollback(); 
    $db->autocommit(TRUE);
    echo json_encode(["success" => "success", "status" => false,"message" => 'Commit transaction failed!! '. $ex->getMessage() ]);
}

?>