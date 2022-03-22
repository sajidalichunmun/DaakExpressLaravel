<?php

//ob_start();
//require '../../fpdf182/fpdf.php';
include_once '../../Database/dbConnection.php';
require 'code128.php';

/*
$from=0;
$to=0;

$query="select *from AwbMaster WHERE AWBNO='". $_POST['fromPodNo'] ."'";
$result= mysqli_query($db, $query);
$rowCount= mysqli_num_rows($result);
if($rowCount > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $from=$row['PodID'];
    }
}
$query="select *from AwbMaster WHERE AWBNO ='". $_POST['toPodNo'] ."'";
$result= mysqli_query($db, $query);
$rowCount= mysqli_num_rows($result);
if($rowCount > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $to=$row['PodID'];
    }
}
if($from===0)
{
    echo 'From Record not found..';
    exit();
}
if($to===0)
{
    echo 'To Record not found..';
    exit();
}
 
 */
//A4 Width : 219mm
//default margin : 100mm each side
//writable horizontal: 219 -910*20=189mm
//$pdf=new FPDF('p','mm','A4');
$pdf=new PDF_Code128();
//$pdf=new PDF_BARCODE('p','mm','A4');
$pdf->AddPage();

$left1=55;
$left2=155;
$top=8;
$width=45;
$height=6;

//Set font name and size and style
$pdf->SetFont('Arial', '',10);

//$from = preg_replace('/[0-9]+/', '', $_POST['from']);
//$to = preg_replace('/[0-9]+/', '', $_POST['to']);

$query="select *from AwbMaster a".
        " inner join ClientCodeMaster cc on a.ClientCodeID=cc.ClientID".
        " inner join ClientMajorMaster cm on cc.ClientMajorID=cm.MajorID".
        " inner join SubCityMaster sc on a.SubCityID=sc.SubCityID".
        " inner join FranchiseeMaster fr on a.FranID=fr.FranID".
        //" WHERE a.awbno between '". $_POST['from'] ."' AND '". $_POST['to'] ."' order by a.PodID";

		" WHERE a.PodID >=". $from ." AND a.PodID <=". $to ."' order by a.PodID";

$result= mysqli_query($db, $query);

$rowCount= mysqli_num_rows($result);
if($rowCount > 0)
{
    $i=0;
    $poddate='';
    $podno='';
    $ClientCode='';
    $CLIENTNAME='';
    $AREA='';
    $RefNo='';
    $franid='';
    $NAME='';
    $poddate1='';
    $podno1='';
    $ClientCode1='';
    $CLIENTNAME1='';
    $AREA1='';
    $RefNo1='';
    $franid1='';
    $NAME1='';
    while ($row = mysqli_fetch_array($result))
    {
        //if (ob_get_length()) ob_end_clean();
        if($i===0)
        {
            $poddate=$row['PodDate'];
            //bar128(stripcslashes($row['AwbNo']));
            $podno=$row['AwbNo'];
            $ClientCode=$row['ClientCode'];
            $CLIENTNAME=$row['MajorName'];
            $AREA=$row['Address1'].",". $row['Address2']. ",". $row['SubCity']. ",". $row['Pincode'];
            $NAME=$row['CustomerName'];
            $franid=$row['FranID'];
            //$RefNo=$row['RefNo'];
            $i++;
        }
        else if($i===1)
        {
            $poddate1=$row['PodDate'];
            $podno1=$row['AwbNo'];
            $ClientCode1=$row['ClientCode'];
            $CLIENTNAME1=$row['MajorName'];
            $AREA1=$row['Address1'].",". $row['Address2']. ",". $row['SubCity']. ",". $row['Pincode'];
            $NAME1=$row['CustomerName'];
            $franid1=$row['FranID'];
            //$RefNo1=$row['RefNo'];
            
            $i++;
        }
        if($i===2)
        {
            
            $pdf->Cell(52, 5,'Pod Date : '. $poddate,0,0);
            $pdf->Cell(52, 5,$pdf->Code128($left1,$top,$podno,$width,$height) ,0,0);
            $pdf->Cell(52, 5,'Pod Date : '. $poddate1,0,0);
            $pdf->Cell(52,5,$pdf->Code128($left2,$top,$podno1,$width,$height),0,1); //END LINE
            
            $top+=60;
            
            $pdf->Cell(52,5,'Cl Code : '.$ClientCode,0,0); 
            $pdf->Cell(52,5,$podno,0,0);
            $pdf->Cell(52,5,'Cl Code : '.$ClientCode1,0,0); 
            $pdf->Cell(52,5,$podno1,0,1);
            
            $pdf->Cell(104,5,'Cl Name : '.$CLIENTNAME,0,0); 
            $pdf->Cell(105,5,'Cl Name1 : '.$CLIENTNAME1,0,1); //END LINE

            $pdf->Cell(105,5,'Name : '.$NAME,0,0); 
            $pdf->Cell(105,5,'Name : '.$NAME1,0,1); //END LINE

            $pdf->Cell(105,5,'Area : '.$AREA,0,0); 
            $pdf->Cell(105,5,'Area : '.$AREA1,0,1); //END LINE

            $pdf->Cell(105,5,'Ref No : ',0,0); 
            $pdf->Cell(105,5,'Ref No : ',0,1); 
            
            $pdf->Cell(10590,5,'',0,1); 
            $pdf->Cell(105,5,'Receiver Name_____________________________',0,0); 
            $pdf->Cell(105,5,'Receiver Name_____________________________',0,1); 
            $pdf->Cell(105,5,'',0,1); 
            $pdf->Cell(105,5,'Sign & Phone______________________________',0,0); 
            $pdf->Cell(105,5,'Sign & Phone_______________________________',0,1); //END LINE

            $pdf->Cell(180,5,'',0,1); //END LINE
            $pdf->Cell(180,5,'',0,1); //END LINE

            $i=0;
            $poddate='';
            $podno='';
            $poddate1='';
            $podno1='';
        }
    }
    if(!empty(($podno)))
    {
        //$podno='<div style="width:50%;height:30%"><p>'. bar128(stripcslashes($podno)) .'</p></div>'; 
        $pdf->Cell(52, 5,'Pod Date : '.  $poddate,0,0);
        $pdf->Cell(52, 5,$pdf->Code128($left1,$top,$podno,$width,$height) ,0,1);
        /*$pdf->SetXY($left1+10,$top+6);
        $pdf->Write(5,$podno);
        $pdf->Cell(90,5,'',0,1);
        */
        $pdf->Cell(52,5,'Cl Code : '. $ClientCode,0,0); 
        $pdf->Cell(52,5,$podno,0,1); //END LINE
        $pdf->Cell(105,5,'Cl Name : '. $CLIENTNAME,0,1); // END LINE 
        $pdf->Cell(105,5,'Name :'. $NAME,0,1); //END LINE
        $pdf->Cell(105,5,'Area : '. $AREA,0,1); //END LINE
        $pdf->Cell(105,5,'Ref No : ',0,0); 
        
        $pdf->Cell(52,5,'',0,1); //END LINE
        $pdf->Cell(105,5,'Receiver Name_________________________________',0,1); 
        $pdf->Cell(52,5,'',0,1); //END LINE
        $pdf->Cell(105,5,'Sign & Phone__________________________________',0,1); //END LINE
    }
}

$pdf->Output();
//ob_end_flush();

?>
