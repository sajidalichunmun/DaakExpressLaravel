<?php
include './Database/dbConnection.php';

$cluse='';
$output='';
$PodNo='';
if(isset($_POST['radio']))
{
    if($_POST['radio']==="waybillId")
    {
        $cluse=" a.awbno='". $_POST['tracking-id'] ."'";
    }
    else if($_POST['radio']==="orderId")
    {
        $cluse=" RefNo1='". $_POST['id'] ."'";
    }
    else if($_POST['radio']==="lrnumber")
    {
        $cluse=" a.awbno='". $_POST['id'] ."'";
    }
    
    $query="select *from AwbMaster a Where ". $cluse;
    $result= mysqli_query($db, $query);
    $rowCount= mysqli_num_rows($result);
    if($rowCount > 0)
    {
        $output ='<div class="table-responsive">
                <table class="table table-borderd">';
        
        while ($row = mysqli_fetch_assoc($result))
        {
            $PodNo=$row['AwbNo'];
            $output .='
                <tr>
                    <td width="30%"><label>AWB No</label></td>
                    <td width="70%">'. $row['AwbNo'] .'</td>
                </tr>
                <tr>
                    <td width="30%"><label>Status</label></td>
                    <td width="70%">'. $row['Status'] .'</td>
                </tr>
                    ';
                    
            //$output .= '<div class="from-group"><lable>AWB NO</label><input type="text" class="form-control" readonly="" value="'. $row['AwbNo'] .'"';
            //$output .= '<lable>BOOKING DATE</label><input type="text" class="form-control" readonly="" value="'. $row['PodDate'] ."'";
            //$output .='</div>';
        }
        $output .= '</table></div>';
    }
    
    $query="select *from AwbMaster_Hist a Where a.AwbNo='". $PodNo ."' order by a.PodSlNo desc";
    $result= mysqli_query($db, $query);
    $rowCount= mysqli_num_rows($result);
    if($rowCount > 0)
    {
        $output .= '<hr style="border:1px solid green;"><div class="table-responsive">
                <table class="table table-dark table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Sr No</th>
                        <th>Awb No</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                ';
        
        while ($row = mysqli_fetch_assoc($result))
        {
            $output .='
                <tr>
                    <td>'. mysqli_escape_string($db, $row['PodSlNo']) .'</td>
                    <td>'. mysqli_escape_string($db, $row['AwbNo']) .'</td>
                    <td>'. mysqli_escape_string($db, $row['HistDate']) .'</td>
                    <td>'. mysqli_escape_string($db, $row['HistStatus']) .'</td>
                    <td>'. mysqli_escape_string($db, $row['CreatedBy']) .'</td>
                    <td>'. mysqli_escape_string($db, $row['CreatedOn']) .'</td>
                </tr>
                    ';
        }
        $output .= '</tbody></table></div>';
    }
    echo $output;
    exit();
}

?>
