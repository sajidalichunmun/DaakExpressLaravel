<?php

namespace App\Http\Controllers\ReportsQuery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use PdfReport;

class ReportsController extends Controller
{
	public function ContInMissingRpt(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$stmt="SELECT CONT_ID,CONT_NO,CONT_SIZE,CONT_SHIPLINE,
				CONT_DEPOT,CONT_TYPE,CONT_STATUS,CONT_PAYMENT,CONT_AMOUNT,
				CONT_CREATEDBY,CONT_ENTRYTIME
				FROM KCT_Containers c
				LEFT OUTER JOIN KCT_ContainersIn I ON C.CONT_ID=I.CONTI_ID
				WHERE I.CONTI_ID IS NULL AND C.CONT_STATUS!='TRANSPORT' AND";
			
			if(!empty($req->input('depot')))
			{
				$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
			}
			if(!empty($req->input('contsize')))
			{
				$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
			}
			if(!empty($req->input('shippingline')))
			{
				$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
			}

			if(!empty($req->input('start_date')))
			{
				$cluse .= " DATE_FORMAT(C.Cont_EntryTime,'%Y%m%d')>=DATE_FORMAT('".  $req->input('start_date') ." 00:00:00','%Y%m%d') AND";
			}    
			if(!empty($req->input('end_date')))
			{
				$cluse .= " DATE_FORMAT(C.Cont_EntryTime,'%Y%m%d')<=DATE_FORMAT('".  $_POST['end_date'] ." 23:59:59','%Y%m%d') AND";
			}
		    if(strlen($cluse)>0)
		    {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		    }
		    else
		    {
			   $stmt = substr($stmt,0, strlen($stmt)-3);
		    }
			//dd($stmt);
			$result = DB::select($stmt);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>CONT NO</th>
										<th>CONT SIZE</th>
										<th>CONT TYPE</th>
										<th>SHIPPING LINE</th>
										<th>DEPOT</th>
										<th>AMOUNT</th>
										<th>STATUS</th>
										<th>PAYMENT TYPE</th>
										<th>CREATED BY</th>
										<th>CREATED ON</th>
										<th>CONT ID</th>
									</tr>
								</thead>
								<tbody>';
			foreach($result as $key => $u)
			{
				$output .='<tr>
				<td>'.  $u->CONT_NO  .'</td>
				<td>'.  $u->CONT_SIZE  .'</td>
				<td>'.  $u->CONT_TYPE  .'</td>
				<td>'.  $u->CONT_SHIPLINE  .'</td>
				<td>'.  $u->CONT_DEPOT  .'</td>
				<td>'.  $u->CONT_AMOUNT  .'</td>
				<td>'.  $u->CONT_STATUS  .'</td>
				<td>'.  $u->CONT_PAYMENT  .'</td>
				<td>'.  $u->CONT_CREATEDBY  .'</td>
				<td>'.  $u->CONT_ENTRYTIME  .'</td>
				<td>'.  $u->CONT_ID  .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
	
	public function ContOutMissingRpt(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$stmt='SELECT c.CONT_ID,CONT_NO,C.CONT_SIZE,CONT_SHIPLINE,
				CONT_DEPOT,CONT_TYPE,CONT_STATUS,CONT_PAYMENT,CONT_AMOUNT,
				OM.CONT_CREATEDBY,OM.CONT_ENTRYTIME,REQ_NO,R.REQ_ID
				FROM KCT_Containers c
				INNER JOIN KCT_CONTAINEROUTMAST OM ON C.CONT_ID=OM.CONT_ID
				INNER JOIN KCT_SHIPPINGLINEREQUEST R ON OM.REQ_ID=R.REQ_ID
				LEFT OUTER JOIN KCT_ContainersOUT O ON C.CONT_ID=O.CONTI_ID
				WHERE O.CONTI_ID IS NULL AND';
			
			if(!empty($req->input('depot')))
			{
				$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
			}
			if(!empty($req->input('contsize')))
			{
				$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
			}
			if(!empty($req->input('shippingline')))
			{
				$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
			}

			if(!empty($req->input('start_date')))
			{
				$cluse .= " DATE_FORMAT(OM.Cont_EntryTime,'%Y%m%d')>=DATE_FORMAT('".  $req->input('start_date') ." 00:00:00','%Y%m%d') AND";
			}    
			if(!empty($req->input('end_date')))
			{
				$cluse .= " DATE_FORMAT(OM.Cont_EntryTime,'%Y%m%d')<=DATE_FORMAT('".  $_POST['end_date'] ." 23:59:59','%Y%m%d') AND";
			}
		    if(strlen($cluse)>0)
		    {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		    }
		    else
		    {
			   $stmt = substr($stmt,0, strlen($stmt)-3);
		    }
			$result = DB::select($stmt);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>CONT NO</th>
										<th>CONT SIZE</th>
										<th>CONT TYPE</th>
										<th>SHIPPING LINE</th>
										<th>DEPOT</th>
										<th>REQ NO</th>
										<th>STATUS</th>
										<th>CREATED BY</th>
										<th>CREATED ON</th>
										<th>CONT ID</th>
									</tr>
								</thead>
								<tbody>';
			foreach($result as $key => $u)
			{
				$output .='<tr>
				<td>'.  $u->CONT_NO  .'</td>
				<td>'.  $u->CONT_SIZE  .'</td>
				<td>'.  $u->CONT_TYPE  .'</td>
				<td>'.  $u->CONT_SHIPLINE  .'</td>
				<td>'.  $u->CONT_DEPOT  .'</td>
				<td>'.  $u->REQ_NO  .'</td>
				<td>'.  $u->CONT_STATUS  .'</td>
				<td>'.  $u->CONT_CREATEDBY  .'</td>
				<td>'.  $u->CONT_ENTRYTIME  .'</td>
				<td>'.  $u->CONT_ID  .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
	
	public function ContInRpt(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$stmt='SELECT CONT_ID,CONT_NO,CONT_SIZE,CONT_SHIPLINE,
				CONT_DEPOT,CONT_TYPE,CONT_STATUS,I.CONTI_CIRIN,
				I.CONTI_INDATE,I.CONTI_FROM,I.CONTI_CONSGTYPE,
				I.CONTI_TRUCKNO,I.CONTI_TRAILERNO,I.CONTI_TOWNER,
				I.CONTI_DRIVER,I.CONTI_RECPTNO,I.CONTI_RECPTDATE,
				I.CONTI_STATUS,I.CONTI_REMARKS1,I.CONTI_REMARKS2,
				I.CONTI_EXTREMARKS,I.CONTI_BL,I.CONTI_EMPIDNO,
				I.CONTI_CREATEDBY,I.CONTI_CRDATE
				FROM KCT_Containers c
				INNER JOIN KCT_ContainersIn I ON C.CONT_ID=I.CONTI_ID
				WHERE';
			
			if(!empty($req->input('depot')))
			{
				$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
			}
			if(!empty($req->input('contsize')))
			{
				$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
			}
			if(!empty($req->input('shippingline')))
			{
				$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
			}

			if(!empty($req->input('start_date')))
			{
				$cluse .= " DATE_FORMAT(C.CONT_CRDATE,'%Y%m%d')>=DATE_FORMAT('".  $req->input('start_date') ." 00:00:00','%Y%m%d') AND";
			}    
			if(!empty($req->input('end_date')))
			{
				$cluse .= " DATE_FORMAT(C.CONT_CRDATE,'%Y%m%d')<=DATE_FORMAT('".  $_POST['end_date'] ." 23:59:59','%Y%m%d') AND";
			}
		    if(strlen($cluse)>0)
		    {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		    }
		    else
		    {
			   $stmt = substr($stmt,0, strlen($stmt)-6);
		    }
			$result = DB::select($stmt);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>CONT NO</th>
										<th>CONT SIZE</th>
										<th>CONT TYPE</th>
										<th>SHIPPING LINE</th>
										<th>DEPOT</th>
										<th>BL NO</th>
										<th>STATUS</th>
										<th>IN DATE</th>
										<th>TRUCK NO</th>
										<th>TRAILER NO</th>
										<th>OWNERE NAME</th>
										<th>DRIVER NAME</th>
										<th>EMP IDNO</th>
										<th>CIR IN</th>
										<th>RECEIPT NO</th>
										<th>RECEIPT DATE</th>
										<th>CONTAINER FROM</th>
										<th>CONSG TYPE</th>
										<th>REMARKS1</th>
										<th>REMARKS2</th>
										<th>REMARKS3</th>
										<th>CREATED BY</th>
										<th>CREATED ON</th>
										<th>CONT ID</th>
									</tr>
								</thead>
								<tbody>';
			foreach($result as $key => $u)
			{
				$output .='<tr>
				<td>'.  $u->CONT_NO  .'</td>
				<td>'.  $u->CONT_SIZE  .'</td>
				<td>'.  $u->CONT_TYPE  .'</td>
				<td>'.  $u->CONT_SHIPLINE  .'</td>
				<td>'.  $u->CONT_DEPOT  .'</td>
				<td>'.  $u->CONTI_BL  .'</td>
				<td>'.  $u->CONT_STATUS  .'</td>
				<td>'.  $u->CONTI_INDATE  .'</td>
				<td>'.  $u->CONTI_TRUCKNO  .'</td>
				<td>'.  $u->CONTI_TRAILERNO  .'</td>
				<td>'.  $u->CONTI_TOWNER  .'</td>
				<td>'.  $u->CONTI_DRIVER  .'</td>
				<td>'.  $u->CONTI_EMPIDNO  .'</td>
				<td>'.  $u->CONTI_CIRIN  .'</td>
				<td>'.  $u->CONTI_RECPTNO  .'</td>
				<td>'.  $u->CONTI_RECPTDATE  .'</td>
				<td>'.  $u->CONTI_FROM  .'</td>
				<td>'.  $u->CONTI_CONSGTYPE  .'</td>
				<td>'.  $u->CONTI_REMARKS1  .'</td>
				<td>'.  $u->CONTI_REMARKS2  .'</td>
				<td>'.  $u->CONTI_EXTREMARKS  .'</td>
				<td>'.  $u->CONTI_CREATEDBY  .'</td>
				<td>'.  $u->CONTI_CRDATE  .'</td>
				<td>'.  $u->CONT_ID  .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
	
	public function ContOutRpt(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$stmt="SELECT CONTO_ID,CONT_ID,CONT_NO,C.CONT_SIZE,CONT_SHIPLINE,
				CONT_DEPOT,CONT_TYPE,CONT_STATUS,CONTO_DOCISSUE,CONTO_DATE,
				CONTO_TRUCKNO,CONTO_TRAILER,CONTO_TOWNER,CONTO_DRIVER,
				CONTO_SEAL,CONTO_CREATEDBY,CONTO_CRDATE,CONTO_EMPIDNO,
				REQ_NO,R.REQ_ID,
				CASE WHEN R.Agent_Name IS NULL THEN '' ELSE R.Agent_Name END Agent_Name,
				CASE WHEN R.Voyage_No IS NULL THEN '' ELSE R.Voyage_No END Voyage_No,
				CASE WHEN R.Vessel_Name IS NULL THEN '' ELSE R.Vessel_Name END Vessel_Name,
				CASE WHEN R.Client_Name IS NULL THEN '' ELSE R.Client_Name END Client_Name,
				CASE WHEN R.Destination IS NULL THEN '' ELSE R.Destination END Destination,
				CASE WHEN R.Final_Dest IS NULL THEN '' ELSE R.Final_Dest END Final_Dest,
				CASE WHEN Container_TO IS NULL THEN '' ELSE  Container_TO END Container_TO,
				CASE WHEN R.Shipper_Name IS NULL THEN '' ELSE R.Shipper_Name END Shipper_Name,
				CASE WHEN Shipping_Order IS NULL THEN
				CASE WHEN Booking_No IS NULL THEN 
				CASE WHEN Release_OrderNo IS NULL THEN '' ELSE Release_OrderNo END
				ELSE Booking_No END
				ELSE Shipping_Order END Shipping_Order
				FROM KCT_Containers c
				INNER JOIN KCT_Containersout o ON C.CONT_ID=o.CONTI_ID
				INNER JOIN KCT_SHIPPINGLINEREQUEST R ON O.REQ_ID=R.REQ_ID
				WHERE";
			
			if(!empty($req->input('depot')))
			{
				$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
			}
			if(!empty($req->input('contsize')))
			{
				$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
			}
			if(!empty($req->input('shippingline')))
			{
				$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
			}

			if(!empty($req->input('start_date')))
			{
				$cluse .= " DATE_FORMAT(O.CONTO_CRDATE,'%Y%m%d')>=DATE_FORMAT('".  $req->input('start_date') ." 00:00:00','%Y%m%d') AND";
			}    
			if(!empty($req->input('end_date')))
			{
				$cluse .= " DATE_FORMAT(O.CONTO_CRDATE,'%Y%m%d')<=DATE_FORMAT('".  $_POST['end_date'] ." 23:59:59','%Y%m%d') AND";
			}
		    if(strlen($cluse)>0)
		    {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		    }
		    else
		    {
			   $stmt = substr($stmt,0, strlen($stmt)-6);
		    }
			$result = DB::select($stmt);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>CONT NO</th>
										<th>CONT SIZE</th>
										<th>CONT TYPE</th>
										<th>SHIPPING LINE</th>
										<th>DEPOT</th>
										<th>STATUS</th>
										<th>CIR OUT</th>
										<th>OUT DATE</th>
										<th>TRUCK NO</th>
										<th>TRAILER NO</th>
										<th>OWNER NAME</th>
										<th>DRIVER NAME</th>
										<th>SEAL NO</th>
										<th>REQ NO</th>
										<th>SHIPPER</th>
										<th>AGENT NAME</th>
										<th>VESSEL</th>
										<th>VOYEGE</th>
										<th>DESTINATION</th>
										<th>CLIENT TO</th>
										<th>CONTAINER TO</th>
										<th>FINAL DEST</th>
										<th>CREATED BY</th>
										<th>CREATED ON</th>
										<th>CONT ID</th>
										<th>OUT ID</th>
									</tr>
								</thead>
								<tbody>';
			foreach($result as $key => $u)
			{
				$output .='<tr>
				<td>'.  $u->CONT_NO  .'</td>
				<td>'.  $u->CONT_SIZE  .'</td>
				<td>'.  $u->CONT_TYPE  .'</td>
				<td>'.  $u->CONT_SHIPLINE  .'</td>
				<td>'.  $u->CONT_DEPOT  .'</td>
				<td>'.  $u->CONT_STATUS  .'</td>
				<td>'.  $u->CONTO_DOCISSUE  .'</td>
				<td>'.  $u->CONTO_DATE  .'</td>
				<td>'.  $u->CONTO_TRUCKNO  .'</td>
				<td>'.  $u->CONTO_TRAILER  .'</td>
				<td>'.  $u->CONTO_TOWNER  .'</td>
				<td>'.  $u->CONTO_DRIVER  .'</td>
				<td>'.  $u->CONTO_SEAL  .'</td>
				<td>'.  $u->REQ_NO  .'</td>
				<td>'.  $u->Shipper_Name  .'</td>
				<td>'.  $u->Agent_Name  .'</td>
				<td>'.  $u->Vessel_Name  .'</td>
				<td>'.  $u->Voyage_No  .'</td>
				<td>'.  $u->Destination  .'</td>
				<td>'.  $u->Client_Name  .'</td>
				<td>'.  $u->Container_TO  .'</td>
				<td>'.  $u->Final_Dest  .'</td>
				<td>'.  $u->CONTO_CREATEDBY  .'</td>
				<td>'.  $u->CONTO_CRDATE  .'</td>
				<td>'.  $u->CONT_ID  .'</td>
				<td>'.  $u->CONTO_ID  .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
	
	public function ContStockRpt(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$stmt='SELECT CONT_ID,CONT_NO,CONT_SIZE,CONT_SHIPLINE,
				CONT_DEPOT,CONT_TYPE,CONT_STATUS,CONT_PAYMENT,CONT_AMOUNT,
				CONT_CREATEDBY,CONT_ENTRYTIME,I.CONTI_INDATE
				FROM KCT_Containers c
				INNER JOIN KCT_ContainersIn I ON C.CONT_ID=I.CONTI_ID
				LEFT OUTER JOIN KCT_ContainersOUT O ON C.CONT_ID=O.CONTI_ID
				WHERE O.CONTI_ID IS NULL AND';
			
			if(!empty($req->input('depot')))
			{
				$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
			}
			if(!empty($req->input('contsize')))
			{
				$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
			}
			if(!empty($req->input('shippingline')))
			{
				$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
			}
			if(!empty($req->input('status')))
			{
				if(strtoupper($req->input('status'))!="ALL")
				{
					$cluse .= " C.Cont_STATUS='".  strtoupper($req->input('status')) ."' AND";
				}
			}
			/*if(!empty($req->input('start_date')))
			{
				$cluse .= " DATE_FORMAT(C.Cont_EntryTime,'%Y%m%d')>=DATE_FORMAT('".  $req->input('start_date') ." 00:00:00','%Y%m%d') AND";
			}    
			if(!empty($req->input('end_date')))
			{
				$cluse .= " DATE_FORMAT(C.Cont_EntryTime,'%Y%m%d')<=DATE_FORMAT('".  $_POST['end_date'] ." 23:59:59','%Y%m%d') AND";
			}*/
		    if(strlen($cluse)>0)
		    {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		    }
		    else
		    {
			   $stmt = substr($stmt,0, strlen($stmt)-3);
		    }
			$result = DB::select($stmt);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>CONT NO</th>
										<th>CONT SIZE</th>
										<th>CONT TYPE</th>
										<th>SHIPPING LINE</th>
										<th>DEPOT</th>
										<th>STATUS</th>
										<th>IN DATE</th>
										<th>CONT ID</th>
									</tr>
								</thead>
							<tbody>';
			foreach($result as $key => $u)
			{
				$output .='<tr>
				<td>'.  $u->CONT_NO  .'</td>
				<td>'.  $u->CONT_SIZE  .'</td>
				<td>'.  $u->CONT_TYPE  .'</td>
				<td>'.  $u->CONT_SHIPLINE  .'</td>
				<td>'.  $u->CONT_DEPOT  .'</td>
				<td>'.  $u->CONT_STATUS  .'</td>
				<td>'.  $u->CONTI_INDATE  .'</td>
				<td>'.  $u->CONT_ID  .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
	
	public function ContInMissingRptTest(Request $request)
	{
		$arr = array('msg' => 'Something goes to wrong. Please try again lator ', 'status' => false);		
		try
		{
			$arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			$arr = array('msg' => $ex->getMessage(), 'status' => false);
		}
        return Response()->json($arr);
	}
	
	public function ContInMissingRptResult(Request $req)
	{
		$arr = array('msg' => 'Something goes to wrong. Please try again lator ', 'status' => false);		
		$cluse = '';
		$stmt='';
		try
		{
			$stmt='SELECT CONT_ID,CONT_NO,CONT_SIZE,CONT_SHIPLINE,
				CONT_DEPOT,CONT_TYPE,CONT_STATUS,CONT_PAYMENT,CONT_AMOUNT,
				CONT_CREATEDBY,CONT_ENTRYTIME
				FROM KCT_Containers c
				LEFT OUTER JOIN KCT_ContainersIn I ON C.CONT_ID=I.CONTI_ID
				WHERE I.CONTI_ID IS NULL AND';
			
			if(!empty($req->input('depot')))
			{
				$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
			}
			if(!empty($req->input('contsize')))
			{
				$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
			}
			if(!empty($req->input('shippingline')))
			{
				$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
			}

			if(!empty($req->input('start_date')))
			{
				$cluse .= " C.Cont_EntryTime>=DATE_FORMAT('".  $req->input('start_date') ."','%Y%m%d') AND";
			}    
			if(!empty($req->input('end_date')))
			{
				$cluse .= " C.Cont_EntryTime<=DATE_FORMAT('".  $_POST['end_date'] ."','%Y%m%d') AND";
			}
		    if(strlen($cluse)>0)
		    {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		    }
		    else
		    {
			   $stmt = substr($stmt,0, strlen($stmt)-3);
		    }
		   $arr = array('msg' => 'Something goes to wrong. Please try again lator ', 'status' => false);		
			$result = DB::select($stmt);
				
				return view('Reports.ContainerInMissingRpt.Index',['result'=>$result] );
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
		}
        //return Response()->json($arr);
		return view('Reports.ContainerInMissingRpt.Index',['result'=>$result] );
	}
	
    public function ContInMissingRpt1(Request $req)
	{
		$cluse = '';
		$stmt='';
		if(!empty($req->input('depot')))
		{
			$cluse .= " C.Cont_Depot='".  strtoupper($req->input('depot')) ."' AND";
		}
		if(!empty($req->input('contsize')))
		{
			$cluse .= " substr(C.Cont_Size,1,2)='". substr($req->input('contsize'),0,2) ."' AND";
		}
		if(!empty($req->input('shippingline')))
		{
			$cluse .= " C.Cont_ShipLine='".  strtoupper($req->input('shippingline')) ."' AND";
		}

		if(strtoupper($req->input('rptType'))==='IN')
		{
		if(!empty($req->input('start_date')))
		{
			$cluse .= " C.Cont_EntryTime>=DATE_FORMAT('".  $req->input('start_date') ."','%Y%m%d') AND";
		}    
		if(!empty($req->input('end_date')))
		{
			$cluse .= " C.Cont_EntryTime<=DATE_FORMAT('".  $_POST['end_date'] ."','%Y%m%d') AND";
		}
	   $stmt="Select Cont_No 'Cont No',Cont_Size 'Cont Size',Cont_ShipLine 'Shipping Line',
			   Cont_Status 'Status',Cont_Depot 'Depot',Cont_CreatedBy 'Created By',
			   Cont_CreatedOn 'Created On',Cont_UpdatedBy 'Updated By',Cont_UpdatedOn 'Updated On',Cont_EntryTime 'Entry Time',cont_id 'CONT ID'
			   From KCT_Containers c 
			   Left Outer Join KCT_ContainersIn i on c.cont_id=i.conti_id
			   WHERE c.CONT_STATUS != 'TRANSPORT' AND i.conti_ID is null And";
		}
		   if(strlen($cluse)>0)
		   {
			   $cluse = substr($cluse,0, strlen($cluse)-3);
			   
			   $stmt .= $cluse;
		   }
		   else
		   {
			   $stmt = substr($stmt,0, strlen($stmt)-3);
		   }
		   $output='<table id="tbExport" class="table table-dark table-bordered table-hover">
											<thead class="thead-dark">';
		   $result = DB::connection()->getPdo();
			$rs = $result->query($stmt);
			if($rs->getColumnMeta()>0)
			{
				$output .= '<tr>';
				for ($i = 0; $i < $rs->columnCount(); $i++) {
						$col = $rs->getColumnMeta($i);
						$columns[] = $col['name'];
						$output .= '<th>'.  $col['name'] .'</th>';
				}
				$output .= '</tr>';
				print_r($columns);
			}
		   
		   $output .= '</tbody></table>';
	
		return Response()->$output;
		//return Response()->json($arr);
	}
	
	
	public function ContainerInWardSummary1(Request $req)
	{
		
		$query = "SELECT COUNT(*) TOTAL,CONT_DEPOT,CONT_PAYMENT,
				CONT_STATUS,CONT_SIZE,SUM(CONT_AMOUNT) CONT_AMOUNT 
				FROM KCT_CONTAINERS C
				INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID
				WHERE date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format(NOW(),'%Y-%m-%d') AND date_format(CONTI_INDATE,'%Y-%m-%d')<=date_format(NOW(),'%Y-%m-%d')
				GROUP BY CONT_DEPOT,CONT_PAYMENT,CONT_STATUS,CONT_SIZE";
		//dd($query);
		$result = DB::select($query);	
		
		$query1 = "SELECT COUNT(*) TOTAL,CONT_SHIPLINE,CONT_DEPOT,CONT_STATUS,CONT_SIZE,
			SUM(CONT_AMOUNT) CONT_AMOUNT,CONT_PAYMENT
			FROM KCT_CONTAINERS C
			INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID 
			WHERE date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format(NOW(),'%Y-%m-%d') AND date_format(CONTI_INDATE,'%Y-%m-%d')<=date_format(NOW(),'%Y-%m-%d')
			GROUP BY CONT_SHIPLINE,CONT_DEPOT,CONT_PAYMENT,CONT_STATUS,CONT_SIZE";
			
		$inresult = DB::select($query1);
		
		$query2 = "SELECT CONT_ID,CONT_NO,CONT_SHIPLINE,CONT_DEPOT,
				CONT_STATUS,CONT_SIZE,CONT_AMOUNT,CONT_PAYMENT,
				CONT_REMARKS,CONT_CREATEDBY,CONT_ENTRYTIME 
				FROM KCT_CONTAINERS C
				INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID
				WHERE date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format(NOW(),'%Y-%m-%d') AND date_format(CONTI_INDATE,'%Y-%m-%d')<=date_format(NOW(),'%Y-%m-%d')";
				
		$tmpOutresult = DB::select($query2);	
		
		
		return view('Reports.ContainerInWardRpt.index', compact('result', 'inresult','tmpOutresult'));
	}
	
	public function ContainerInWardSummary(Request $req)
	{
		$query = "SELECT COUNT(*) TOTAL,CONT_DEPOT,CONT_PAYMENT,
				CONT_STATUS,CONT_SIZE,SUM(CONT_AMOUNT) CONT_AMOUNT 
				FROM KCT_CONTAINERS C
				INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID";
				
				 
	    if(!empty($req->shippingline))
		{
			$query .= " AND CONT_SHIPLINE='". strtoupper($req->shippingline) ."'";
		}
		if(!empty($req->depot))
		{
			$query .= " AND CONT_DEPOT='". strtoupper($req->depot) ."'";
		}
		if(!(empty($req->fromdt) && empty($req->todt)))
		{
			$query .= " AND date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format('". $req->fromdt ."','%Y-%m-%d')
			 AND format(CONTI_INDATE,'%Y-%m-%d')<=date_format('". $req->todt ."','%Y-%m-%d')";
		}
		if(!empty($req->fromdt))
		{
			$query .= " AND date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format('". $req->fromdt ."','%Y-%m-%d')";
		}
		$query .= " GROUP BY CONT_DEPOT,CONT_PAYMENT,CONT_STATUS,CONT_SIZE";
		
		$result = DB::select($query);	
		
		$query1 = "SELECT COUNT(*) TOTAL,CONT_SHIPLINE,CONT_DEPOT,CONT_STATUS,CONT_SIZE,
			SUM(CONT_AMOUNT) CONT_AMOUNT,CONT_PAYMENT
			FROM KCT_CONTAINERS C
			INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID";
			
		if(!empty($req->shippingline))
		{
			$query1 .= " AND CONT_SHIPLINE='". strtoupper($req->shippingline) ."'";
		}
		if(!empty($req->depot))
		{
			$query1 .= " AND CONT_DEPOT='". strtoupper($req->depot) ."'";
		}
		if(!(empty($req->fromdt) && empty($req->todt)))
		{
			$query1 .= " AND date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format('". $req->fromdt ."','%Y-%m-%d')
			 AND date_format(CONTI_INDATE,'%Y-%m-%d')<=date_format('". $req->todt ."','%Y-%m-%d')";
		}
		if(!empty($req->fromdt))
		{
			$query1 .= " AND date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format('". $req->fromdt ."','%Y-%m-%d')";
		}
		$query1 .= " GROUP BY CONT_SHIPLINE,CONT_DEPOT,CONT_PAYMENT,CONT_STATUS,CONT_SIZE";
		
		$inresult = DB::select($query1);
		
		$query2 = "SELECT CONT_ID,CONT_NO,CONT_SHIPLINE,CONT_DEPOT,
				CONT_STATUS,CONT_SIZE,CONT_AMOUNT,CONT_PAYMENT,
				CONT_REMARKS,CONT_CREATEDBY,CONT_ENTRYTIME 
				FROM KCT_CONTAINERS C
				INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID";
		if(!empty($req->shippingline))
		{
			$query2 .= " AND CONT_SHIPLINE='". strtoupper($req->shippingline) ."'";
		}
		if(!empty($req->depot))
		{
			$query2 .= " AND CONT_DEPOT='". strtoupper($req->depot) ."'";
		}
		if(!(empty($req->fromdt) && empty($req->todt)))
		{
			$query2 .= " AND date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format('". $req->fromdt ."','%Y-%m-%d')
			 AND date_format(CONTI_INDATE,'%Y-%m-%d')<=date_format('". $req->todt ."','%Y-%m-%d')";
		}
		if(!empty($req->fromdt))
		{
			$query2 .= " AND date_format(CONTI_INDATE,'%Y-%m-%d')>=date_format('". $req->fromdt ."','%Y-%m-%d')";
		}
		
		$tmpOutresult = DB::select($query2);	
		
		
		return view('Reports.ContainerInWardRpt.index', compact('result', 'inresult','tmpOutresult'));
	}
	
public function displayReport(Request $request)
{
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $sortBy = $request->input('sort_by');

    $title = 'Registered User Report'; // Report title

    $meta = [ // For displaying filters description on header
        'Registered on' => $fromDate . ' To ' . $toDate,
        'Sort By' => $sortBy
    ];

    $queryBuilder = User::select(['name', 'balance', 'registered_at']) // Do some querying..
                        ->whereBetween('registered_at', [$fromDate, $toDate])
                        ->orderBy($sortBy);

    $columns = [ // Set Column to be displayed
        'Name' => 'name',
        'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
        'Total Balance' => 'balance',
        'Status' => function($result) { // You can do if statement or any action do you want inside this closure
            return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
        }
    ];

    // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
    return PdfReport::of($title, $meta, $queryBuilder, $columns)
                    ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                        'displayAs' => function($result) {
                            return $result->registered_at->format('d M Y');
                        },
                        'class' => 'left'
                    ])
                    ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
                        'class' => 'right bold'
                    ])
                    ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                        'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                    ])
                    ->limit(20) // Limit record to be showed
                    ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
	}
	
	public function rptshiplinerequest(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$query = "SELECT ContTypeName,
			Req_ID,SHP_ID,ShippingLine,NoOfCont,NoOfRelease,
			Cont_Size,Req_Status,Req_No,Req_Date,Expire_Date,
			Expire_Days,Agent_Name,Voyage_No,Shipping_Order,
			Vessel_Name,Client_Name,Destination,TempNoOfCont,
			TempNoOfRelease,TempStatus,Final_Dest,Container_TO,
			Req_Remarks,r.ContTypeID,Req_SealStatus,Shipper_Name,
			Booking_No,Release_OrderNo,R.CreatedBy,R.CreatedOn,
			R.UpdatedBy,R.UpdatedOn,R.IsActive,R.EntryTime
			FROM KCT_SHIPPINGLINEREQUEST R
			INNER JOIN KCT_ContainerTypeMaster T ON R.ContTypeID=T.ContTypeID
			WHERE";
			if(!empty($req->shippingline))
			{
				$cluse .= " ShippingLine='". strtoupper($req->shippingline) ."' AND";
			}
			if(!empty($req->reqno))
			{
				$cluse .= " Req_No='". strtoupper($req->reqno) ."' AND";
			}
			
			if(!(empty($req->start_date) && empty($req->end_date)))
			{
				$cluse .= " date_format(Req_Date,'%Y-%m-%d')>=date_format('". $req->start_date ."','%Y-%m-%d') AND";
				$cluse .= " date_format(Req_Date,'%Y-%m-%d')<=date_format('". $req->end_date ."','%Y-%m-%d') AND";
			}
			else if(!empty($req->start_date))
			{
				$cluse .= " date_format(Req_Date,'%Y-%m-%d')>=date_format('". $req->start_date ."','%Y-%m-%d') AND";
			}
			
			if(strlen($cluse)>0)
			{
				$cluse = substr($cluse,0,strlen($cluse)-3);
			}
			else
			{
				$query = substr($query,0,strlen($query)-6);
			}
			
			$query .=' '. $cluse;
			
			$result = DB::select($query);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>REQ NO</th>
										<th>SHIPPING LINE</th>
										<th>CONT SIZE</th>
										<th>CONT TYPE</th>
										<th>REQ DATE</th>
										<th>NO OF COUNT</th>
										<th>NO OF OUT</th>
										<th>STATUS</th>
										<th>TEMP NO OF COUNT</th>
										<th>TEMP NO OF OUT</th>
										<th>TEMP STATUS</th>
										<th>AGENT NAME</th>
										<th>VOYEGE NO</th>
										<th>VESSEL NAME</th>
										<th>CLIENT NAME</th>
										<th>DESTINATION</th>
										<th>FINAL DEST</th>
										<th>CONTAINER TO</th>
										<th>SHIPPER NAME</th>
										<th>SHIPPING ORDER</th>
										<th>BOOKING NO</th>
										<th>RELEASE NO</th>
										<th>SEAL TYPE</th>
										<th>CREATED BY</th>
										<th>CREATED ON</th>
									</tr>
								</thead>
							<tbody>';
			foreach($result as $key => $v)
			{
				$output .='<tr>
					<td>'. $v->Req_No .'</td>
					<td>'. $v->ShippingLine .'</td>
					<td>'. $v->Cont_Size .'</td>
					<td>'. $v->ContTypeName .'</td>
					<td>'. $v->Req_Date .'</td>
					<td>'. $v->NoOfCont .'</td>
					<td>'. $v->NoOfRelease .'</td>
					<td>'. $v->Req_Status .'</td>
					<td>'. $v->TempNoOfCont .'</td>
					<td>'. $v->TempNoOfRelease .'</td>
					<td>'. $v->TempStatus .'</td>
					<td>'. $v->Agent_Name .'</td>
					<td>'. $v->Voyage_No .'</td>
					<td>'. $v->Vessel_Name .'</td>
					<td>'. $v->Client_Name .'</td>
					<td>'. $v->Destination .'</td>
					<td>'. $v->Final_Dest .'</td>
					<td>'. $v->Container_TO .'</td>
					<td>'. $v->Shipper_Name .'</td>
					<td>'. $v->Shipping_Order .'</td>
					<td>'. $v->Booking_No .'</td>
					<td>'. $v->Release_OrderNo .'</td>
					<td>'. $v->Req_SealStatus .'</td>
					<td>'. $v->CreatedBy .'</td>
					<td>'. $v->CreatedOn .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
	
	public function rptuploaddata(Request $req)
	{
		$cluse = '';
		$stmt='';
		$output='';
		try
		{
			$query = "SELECT REQ_NO,R.REQ_ID,
			CONT_NO,C.CONT_SIZE,CONT_SHIPLINE,CONT_TYPE,
			U.CreatedBy,U.CreatedOn
			FROM KCT_SHIPPINGLINEREQUEST R
			INNER JOIN KCT_releasedataupload U ON R.Req_ID=U.Req_ID
			INNER JOIN KCT_CONTAINERS C ON U.CONT_ID=C.CONT_ID
			WHERE";
			
			if(!empty($req->shippingline))
			{
				$cluse .= " ShippingLine='". strtoupper($req->shippingline) ."' AND";
			}
			if(!empty($req->reqid))
			{
				$cluse .= " r.Req_ID='". strtoupper($req->reqid) ."' AND";
			}
			
			if(strlen($cluse)>0)
			{
				$cluse = substr($cluse,0,strlen($cluse)-3);
			}
			else
			{
				$query = substr($query,0,strlen($query)-6);
			}
			
			$query .=' '. $cluse;
			
			$result = DB::select($query);
			
			$output ='<thead class="thead-dark">
									<tr>
										<th>REQ NO</th>
										<th>CONT NO</th>
										<th>CONT SIZE</th>
										<th>SHIPPING LINE</th>
										<th>CONT TYPE</th>
										<th>CREATED BY</th>
										<th>CREATED ON</th>
										<th>REQ ID</th>
									</tr>
								</thead>
							<tbody>';
			foreach($result as $key => $v)
			{
				$output .='<tr>
					<td>'. $v->REQ_NO .'</td>
					<td>'. $v->CONT_NO .'</td>
					<td>'. $v->CONT_SIZE .'</td>
					<td>'. $v->CONT_SHIPLINE .'</td>
					<td>'. $v->CONT_TYPE .'</td>
					<td>'. $v->CreatedBy .'</td>
					<td>'. $v->CreatedOn .'</td>
					<td>'. $v->REQ_ID .'</td>
				</tr>';
			}
			
			$output .= '</tbody>';
			
			//dd($stmt);
		} 
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			//$arr = array('msg' => $ex->getMessage(), 'status' => false);
			$output = $ex->getMessage();
		}
        return Response()->json($output);
	}
}
