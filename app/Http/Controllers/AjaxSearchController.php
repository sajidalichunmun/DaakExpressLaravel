<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Models\TempContIn;
use Carbon\Carbon;
use DateTime;
use App\Models\AwbMasterModel;
class AjaxSearchController extends Controller
{
    /*
    public function index()
	{
        return view('TEMP_CONTAINER.Create');
    }
*/
	function searchClientCode(request $req)
	{
		$search = strtoupper($req->get('cname'));
		$client = \App\Models\ClientCodeModel::all()->where('Name','like',$search)
		->pluck('name');
		
		return $client;
	}
	function queryPod(request $req)
	{
		$search = strtoupper($req->get('podno'));
		$client = AwbMasterModel::all();//where('AwbNo','=',$search)->get();
		
		return response()->json($client);;
	}

	function queryPod1(request $request)
	{
		$cluse='';
		$output='<h2 class="text-align:center">Record Not Found!!!!</h2>';
		$PodNo='';
		if(isset($request->radio))
		{
			$result = AwbMasterModel::with('ClientCode','SubCityName')
				->when($request->radio==='track_id',function ($query) use($request){
					$query->Where('AwbNo', '=', $request->podno );
				})
				->when($request->radio==='orderId',function ($query) use($request){
					$query->Where('RefNo', '=', $request->podno );
				})
				->when($request->radio==='lrnumber',function ($query) use($request){
					$query->Where('shipmentno', '=', $request->podno );
				})->get();
				
			if($result->count() > 0)
			{
				$output ='<div class="table-responsive" id="search-pod">
						<table class="table table-borderd">';
				
				foreach($result as $key => $row)
				{
					$PodNo=$row->AwbNo;
					$output .='
                    <div class="col-lg-6"
						<dl class="dl-horizontal">
							<dt>Major Name</dt>
							<dd>'. $row->ClientCode->MajorResult->Name .'</dd>
							<dt>Sub Area Name</dt>
							<dd>'. $row->SubCityName->MainAreaName .'</dd>
							<dt>City</dt>
							<dd>'. $row->SubCityName->City->Name .'</dd>
							<dt>Pincode</dt>
							<dd>'. $row->SubCityName->Pincode .'</dd>
							<dt>AWB No</dt>
							<dd>'. $row->AwbNo .'</dd>
							<dt>Ref No</dt>
							<dd>'. $row->RefNo .'</dd>
							<dt>Customer Name</dt>
							<dd>'. $row->CustomerName .'</dd>
						</dl>
                    </div>
                    <div class="col-lg-6"
						<dl class="dl-horizontal">
							<dt><label>Client Name</dt>
							<dd>'. $row->ClientCode->Name .'</dd>
							<dt>Area Name</dt>
							<dd>'. $row->SubCityName->Name .'</dd>
							<dt>State</dt>
							<dd>'. $row->SubCityName->City->State->Name .'</dd>
							<dt>Country</dt>
							<dd>'. $row->SubCityName->City->State->Country->Name .'</dd>
							<dt>Barcode</dt>
							<dd>'. $row->awbbarcode
							.'<div class="col-lg-12"><h4 class="text-center">'. $row->shipmentno .'</h4></div>
							</dd>
							<dt>Status</dt>
							<dd>'. $row->Status .'</dd>
							<dt>Route Date</dt>
							<dd>'. date('d-m-Y', strtotime($row->RouteDate)) .'</dd>
						</dl>
                    </div>
					</table></div>		';
				}
			}
			if(!empty($PodNo))
			{
				$result1 = DB::select("select *from AwbMaster_Hist Where AwbNo = '". $PodNo ."' order by PodSlNo desc");
				if($result1)
				{
					$output .= '<hr style="border:1px solid green;"><div class="table-responsive" id="pod-details">
							<table class="table table-dark table-bordered table-hover">
							<caption><h2 class="text-align:center bold">History</h2></caption>
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
					
					foreach($result1 as $key => $row)
					{
						$output .='
							<tr>
								<td>'. $row->PodSlNo .'</td>
								<td>'. $row->AwbNo .'</td>
								<td>'. $row->HistDate .'</td>
								<td>'. $row->HistStatus .'</td>
								<td>'. $row->CreatedBy .'</td>
								<td>'. $row->CreatedOn .'</td>
							</tr>
								';
					}
					$output .= '</tbody></table></div>';
				}
			}
		}
		return Response($output);
	}
    function queryPod2(request $request)
	{
		$cluse='';
		$output='<h2 class="text-align:center">Record Not Found!!!!</h2>';
		$PodNo='';
		if(isset($request->radio))
		{
			$result = AwbMasterModel::with('ClientCode','SubCityName')
				->when($request->radio==='track_id',function ($query) use($request){
					$query->Where('AwbNo', '=', $request->podno );
				})
				->when($request->radio==='orderId',function ($query) use($request){
					$query->Where('RefNo', '=', $request->podno );
				})
				->when($request->radio==='lrnumber',function ($query) use($request){
					$query->Where('shipmentno', '=', $request->podno );
				})->get();
				
			if($result->count() > 0)
			{
				$output ='<div class="table-responsive" id="search-pod">
						<table class="table table-borderd">';
				
				foreach($result as $key => $row)
				{
                	$PodNo=$row->AwbNo;
					$output .='
						<tr>
							<td width="30%"><label>Major Name</label></td>
							<td width="70%" colspan="10">'. $row->ClientCode->MajorResult->Name .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Client Name</label></td>
							<td width="70%" colspan="10">'. $row->ClientCode->Name .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Sub Area Name</label></td>
							<td width="70%" colspan="5">'. $row->SubCityName->MainAreaName .'</td>
							<td width="30%"><label>Area Name</label></td>
							<td width="70%" colspan="5">'. $row->SubCityName->Name .'</td>
						</tr>
						<tr>
							<td width="30%"><label>City</label></td>
							<td width="70%" colspan="5">'. $row->SubCityName->City->Name .'</td>
							<td width="30%"><label>State</label></td>
							<td width="70%" colspan="5">'. $row->SubCityName->City->State->Name .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Pincode</label></td>
							<td width="70%" colspan="5">'. $row->SubCityName->Pincode .'</td>
							<td width="30%"><label>Country</label></td>
							<td width="70%" colspan="5">'. $row->SubCityName->City->State->Country->Name .'</td>
						</tr>
						<tr>
							<td width="30%"><label>AWB No</label></td>
							<td width="30%" colspan="5">'. $row->AwbNo .'</td>
							<td width="30%"><label>Barcode</label></td>
							<td width="30%" colspan="5">'. $row->BarcodeNo .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Ref No</label></td>
							<td width="30%" colspan="5">'. $row->RefNo .'</td>
							<td width="30%"><label>Status</label></td>
							<td width="70%" colspan="5">'. $row->Status .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Customer Name</label></td>
							<td width="100%" colspan="10">'. $row->CustomerName .'</td>
						</tr>
							';
				}
				$output .= '</table></div>';
			}
			if(!empty($PodNo))
			{
				$result1 = DB::select("select *from AwbMaster_Hist Where AwbNo = '". $PodNo ."' order by PodSlNo desc");
				if($result1)
				{
					$output .= '<hr style="border:1px solid green;"><div class="table-responsive" id="pod-details">
							<table class="table table-dark table-bordered table-hover">
							<caption><h2 class="text-align:center bold">History</h2></caption>
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
					
					foreach($result1 as $key => $row)
					{
						$output .='
							<tr>
								<td>'. $row->PodSlNo .'</td>
								<td>'. $row->AwbNo .'</td>
								<td>'. $row->HistDate .'</td>
								<td>'. $row->HistStatus .'</td>
								<td>'. $row->CreatedBy .'</td>
								<td>'. $row->CreatedOn .'</td>
							</tr>
								';
					}
					$output .= '</tbody></table></div>';
				}
			}
		}
		return Response($output);
	}
	public function search_pod_status_details( Request $request )
    {
		$output="";
		$overallstock = AwbMasterModel::where(function ($query) use ($request){
			if (!empty($request->podno) && !empty($request->radio) && $request->radio == "track_id") {
				$query->Where('AwbNo', '=', $request->podno );
			}

			})->orderBy('createdOn','desc')->paginate(5);

		if($overallstock)
		{
			foreach ($overallstock as $key => $overallstocke)
			{

				$output.='<tr>'.

				'<td>'.$overallstocke->$key.'</td>'.

				'<td>'.$overallstocke->AwbNo.'</td>'.

				'<td>'.$overallstocke->CustomerName.'</td>'.

				'<td>'.$overallstocke->Status.'</td>'.

				'<td>'.$overallstocke->CreatedBy.'</td>'.

				'<td>'.$overallstocke->CreatedOn.'</td>'.

				'<td>'.$overallstocke->excess_milk.'</td>'.

				'<td>'.$overallstocke->balance_milk.'</td>'.

				'</tr>';

			}
			return Response($output);
		}
	}
	public function getInfo($id)
     {
       $fill = DB::table('ClientCodeMaster')->where('Name','like', $id)->get();
       return Response::json(['success'=>true, 'info'=>$fill]);
     }

	function searchClientCode1(request $req)
	{
	
		$json=array();
		
		$search = strtoupper($req->get('search'));
		if($search)
		{
			$query = "SELECT c.id,c.name clientname,m.name majorname FROM clientmajormaster M
			INNER JOIN CLIENTCODEMASTER C ON M.ID=C.ClientMajorID
			WHERE C.Name LIKE '". $search ."%'";

			$data = DB::select($query);
			
			foreach($data as $key => $v)
			{
				
				$json[]=  array('id' => $v->id, 
							  'majorname' => $v->majorname,
							  'clientname' => $v->clientname,
							  'label' => $v->clientname,
							  'value' => $v->clientname
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchAreaName(request $req)
	{
	
		$json=array();
		
		$search = strtoupper($req->get('search'));
		if($search)
		{
			$query = "SELECT cont.name CountryName,cont.ID CountryID,
			state.Name StateName,state.id StateID,
			city.Name CityName,city.id CityID,
			scity.Name SubAreaName,scity.ID SubCityID,
			scity.MainAreaName,scity.Pincode
			FROM countrymaster cont
			inner join statemaster state on cont.id=state.CountryID
			inner join citymaster city on state.id=city.StateID
			inner join subcitymaster scity on city.ID=scity.CityID
			WHERE scity.Pincode LIKE '". $search ."%'";

			$data = DB::select($query);
			
			foreach($data as $key => $v)
			{
				
				$json[]=  array('SubCityID' => $v->SubCityID, 
							  'CountryName' => $v->CountryName,
							  'StateName' => $v->StateName,
							  'CityName' => $v->CityName,
							  'SubAreaName' => $v->SubAreaName,
							  'MainAreaName' => $v->MainAreaName,
							  'Pincode' => $v->Pincode,
							  'CountryID' => $v->CountryID,
							  'StateID' => $v->StateID,
							  'CityID' => $v->CityID,
							  'label' => $v->Pincode .'|'. $v->SubAreaName .'|'. $v->MainAreaName .'|'. $v->CityName,
							  'value' => $v->Pincode .'|'. $v->SubAreaName .'|'. $v->MainAreaName .'|'. $v->CityName
						      );
			}
		}
		
		return response()->json($json);
	}

	function searchClientDataRefNo(request $req)
	{
	
		$json=array();
		try
		{
		$search = strtoupper($req->get('search'));
		if($search)
		{
			$query = "SELECT AwbNo,Status,cd.id,RefNo1,BarcodeNo,
			CustomerName,MobileNo,Address1,Address2,Address3,cd.Status,
			country.name CountryName,country.ID CountryID,
			state.Name StateName,state.id StateID,
			city.Name CityName,city.id CityID,
			scity.Name SubAreaName,scity.ID SubCityID,
			scity.MainAreaName,scity.Pincode
			FROM clientexceldata cd
			left outer join subcitymaster scity on cd.Pincode=scity.Pincode
			left outer join citymaster city on scity.CityID=city.ID
			left outer join statemaster state on city.StateID=state.ID
			left outer join countrymaster country on state.CountryID=country.ID
			WHERE cd.RefNo1 = '". $search ."'";

			$result = DB::select($query);
			
			if($result)
			{
				foreach($result as $key => $v)
				{
					
					$json[]=  array('id' => $v->id, 
								  'CountryName' => $v->CountryName,
								  'StateName' => $v->StateName,
								  'CityName' => $v->CityName,
								  'SubAreaName' => $v->SubAreaName,
								  'MainAreaName' => $v->MainAreaName,
								  'Pincode' => $v->Pincode,
								  'CountryID' => $v->CountryID,
								  'StateID' => $v->StateID,
								  'CityID' => $v->CityID,
								  'label' => $v->SubAreaName,
								  'value' => $v->SubCityID,
								  'SubCityID' => $v->SubCityID,
								  "AwbNo" => $v->AwbNo,
								  "Status" => 'FIND',
								  "BarcodeNo" => $v->BarcodeNo,
								  "" => $v->RefNo1,
								  "CustomerName" => $v->CustomerName,
								  "MobileNo" => $v->MobileNo,
								  "Address1" => $v->Address1,
								  "Address2" => $v->Address2 .','. $v->Address3
								  );
				}
			}
			else
			{
				$json[]=array("Status" =>'Record not found');
			}
		}
		}
		catch(Exception $ex)
		{
			$json[]=array("Status" => $ex->getMessage());
		}
		return response()->json($json);
	}
	
	function searchClientDataBarcodeNo(request $req)
	{
	
		$json=array();
		
		$search = strtoupper($req->get('search'));
		if($search)
		{
			$query = "SELECT AwbNo,Status,cd.id,RefNo1,BarcodeNo,
			CustomerName,MobileNo,Address1,Address2,Address3,cd.Status,
			country.name CountryName,country.ID CountryID,
			state.Name StateName,state.id StateID,
			city.Name CityName,city.id CityID,
			scity.Name SubAreaName,scity.ID SubCityID,
			scity.MainAreaName,scity.Pincode
			FROM clientexceldata cd
			left outer join subcitymaster scity on cd.Pincode=scity.Pincode
			left outer join citymaster city on scity.CityID=city.ID
			left outer join statemaster state on city.StateID=state.ID
			left outer join countrymaster country on state.CountryID=country.ID
			WHERE cd.BarcodeNo =  '". $search ."'";

			$data = DB::select($query);
			
			if($data)
			{
				foreach($data as $key => $v)
				{
					
					$json[]=  array('id' => $v->id, 
								  'CountryName' => $v->CountryName,
								  'StateName' => $v->StateName,
								  'CityName' => $v->CityName,
								  'SubAreaName' => $v->SubAreaName,
								  'MainAreaName' => $v->MainAreaName,
								  'Pincode' => $v->Pincode,
								  'CountryID' => $v->CountryID,
								  'StateID' => $v->StateID,
								  'CityID' => $v->CityID,
								  'label' => $v->SubAreaName,
								  'value' => $v->SubCityID,
								  'SubCityID' => $v->SubCityID,
								  "AwbNo" => $v->AwbNo,
								  "Status" => $v->Status,
								  "BarcodeNo" => $v->BarcodeNo,
								  "RefNo" => $v->RefNo1,
								  "CustomerName" => $v->CustomerName,
								  "MobileNo" => $v->MobileNo,
								  "Address1" => $v->Address1,
								  "Address2" => $v->Address2 .','. $v->Address3
								  );
				}
			}
			else
			{
				$json[]=array("Status" =>'Record not found');
			}
		}
		
		return response()->json($json);
	}
	
	function searchPodUpdation(request $req)
	{
	
		$json=array();
		try
		{
			$search = strtoupper($req->get('search'));
			if($search)
			{
				$query = "SELECT AwbNo,Status,CustomerName
				FROM AwbMaster
				WHERE AwbNo =  '". $search ."' AND FRANID IS NOT NULL";

				$data = DB::select($query);
				
				if($data)
				{
					foreach($data as $key => $v)
					{
						
						$json[]=  array('id' => $v->AwbNo, 
									  'CustomerName' => $v->CustomerName,
									  'Status' => $v->Status,
									  'AwbNo' => $v->AwbNo,
									  'label' => $v->AwbNo,
									  'value' => $v->AwbNo
									  
									  );
					}
				}
				else
				{
					$json[]=array("Status" =>'Record not found');
				}
			}
		}
		catch(Exception $ex)
		{
			$json[]=array("Status" => $ex->getMessage());
		}
		return response()->json($json);
	}
	
	function searchUserSeriesAllocation(request $req)
	{
	
		$json=array();
		try
		{
			$search = strtoupper($req->get('search'));
			if($search)
			{
				/*
				$query = "SELECT CONCAT(Prefix,LPAD((AllocatedSeries),Length-(LENGTH(Prefix)),'0')) PODNO,
					AllocationQty,Prefix,Length,SeriesFrom,SeriesTo,AllocatedSeries,
					(AllocationQty-AllocatedSeries) Balance
					FROM seriesmaster WHERE ID = ". $search ."
					AND AllocationQty>(AllocatedSeries+1) AND IsActive='YES'";
				*/

				$query = "SELECT CONCAT(Prefix,LPAD(((AllocatedSeries+1)),Length-(LENGTH(Prefix)),'0')) PODNO,
					AllocationQty,Prefix,Length,SeriesFrom,SeriesTo,AllocatedSeries AllocatedSeries,
					(AllocationQty-AllocatedSeries)) Balance
					FROM seriesmaster WHERE ID = ". $search ."
					AND AllocationQty>(AllocatedSeries+1) AND IsActive='YES'";

				$data = DB::select($query);
				
				if($data)
				{
					foreach($data as $key => $v)
					{
						
						$json[]=  array('id' => $v->PODNO, 
									  'Prefix' => $v->Prefix,
									  'Balance' => $v->Balance,
									  'label' => $v->PODNO,
									  'value' => $v->Prefix
									  
									  );
					}
				}
				else
				{
					$json[]=array("Status" =>'Record not found');
				}
			}
		}
		catch(Exception $ex)
		{
			$json[]=array("Status" => $ex->getMessage());
		}
		return response()->json($json);
	}
	
	function trackingpod(request $request)
	{
		$cluse='';
		$output='';
		$PodNo='';
		if(isset($request->radio))
		{
			if($request->radio==="waybillId")
			{
				$cluse=" a.awbno='". $request->get("tracking-id") ."'";
			}
			else if($request->radio==="orderId")
			{
				$cluse=" RefNo1='". $request->get("id") ."'";
			}
			else if($request->radio==="lrnumber")
			{
				$cluse=" a.awbno='". $request->get("id") ."'";
			}
			
			$result = DB::select("select *from AwbMaster Where ". $cluse);
			if($result->count() > 0)
			{
				$output ='<div class="table-responsive">
						<table class="table table-borderd">';
				
				foreach($result as $key => $row)
				{
					$PodNo=$row->AwbNo;
					$output .='
						<tr>
							<td width="30%"><label>AWB No</label></td>
							<td width="70%">'. $row->AwbNo .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Status</label></td>
							<td width="70%">'. $row->Status .'</td>
						</tr>
							';
				}
				$output .= '</table></div>';
			}
			
			$result1 = DB::select("select *from AwbMaster_Hist Where AwbNo = '". $PodNo ."' order by a.PodSlNo desc");
			if($result1->Count() > 0)
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
				
				foreach($result1 as $key => $row)
				{
					$output .='
						<tr>
							<td>'. $row->PodSlNo .'</td>
							<td>'. $row->AwbNo .'</td>
							<td>'. $row->HistDate .'</td>
							<td>'. $row->HistStatus .'</td>
							<td>'. $row->CreatedBy .'</td>
							<td>'. $row->CreatedOn .'</td>
						</tr>
							';
				}
				$output .= '</tbody></table></div>';
			}
		}
		return $output;
	}
	
    function searchShpLine(Request $req)
	{
	    $json = array();
		if($req->get('query'))
		{
			$search=$req->get('query');

		 	$data=DB::table("kct_shippingline")->
		 	where('SHIP_LINE','like', '%'. $search .'%')->
		 	take(10)->
		 	get();

		 	foreach ($data as $key => $value) 
		 	{
		 		$json[]=  array('name' => $value->SHIP_LINE, 
		 						'id' => $value->SHIP_ID,
		 						'label' => $value->SHIP_LINE
		 			);
		 	}
		 }

		return response()->json($json);

	}


	function autocompleteContSize(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_containersizemaster')->
			where('ContSizeName','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->ContSizeID, 
						      'value' => $v->ContSizeName
						      );
			}
		}
		return response()->json($json);
	}
	
	function autocompleteDepotName(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_Depots')->
			where('DEP_NAME','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->DEP_ID, 
						      'value' => $v->DEP_NAME
						      );
			}
		}
		return response()->json($json);
	}
	
	function SearchBlockContNo(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_BlockContainers')->
			where('Cont_No','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->ID, 
						      'value' => $v->Cont_No
						      );
			}
		}
		return response()->json($json);
	}
	
	function autocompleteContType(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_ContainerTypeMaster')->
			where('ContTypeName','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->ContTypeID, 
						      'value' => $v->ContTypeName,
						      'label' => $v->ContTypeName
						      );
			}
		}
		return response()->json($json);
	}
/*
	function autocompleteContType(request $req)
	{
		$json=array();
		if($req->get('query'))
		{
			$search=$req->get('query');
			$data=DB::table('kct_ContainerTypeMaster')->
			where('ContTypeName','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->ContTypeID, 
						      'value' => $v->ContTypeName,
						      'label' => $v->ContTypeName
						      );
			}
		}
		return response()->json($json);
	}
	*/
	function autocompleteShpLine(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_shippingline')->
			where('SHIP_LINE','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->SHIP_ID, 
						      'value' => $v->SHIP_LINE,
						      'label' => $v->SHIP_LINE
						      );
			}
		}
		return response()->json($json);
	}

	function containersearch(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_CONTAINERS')->
			where('CONT_NO','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
						      'value' => $v->CONT_NO,
						      'label' => $v->CONT_NO
						      );
			}
		}
		return response()->json($json);
	}

	function findInContNo(request $req)
	{
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		$search=$req->term;
		if($search)
		{
			/*$data = DB::table('KCT_CONTAINERS')
        	    ->leftJoin('kct_ContainersIn','kct_ContainersIn.CONTI_ID', '=', 'kct_Containers.CONT_ID')
			->where('CONT_NO','LIKE',$search .'%')
			->wherenull("CONTI_ID")
			->get()->toArray();
			*/
			//dd(strtoupper(session('depot')));
			$query = "SELECT CONT_ID,CONT_NO,CONT_TYPE,CONT_SHIPLINE,
			CONT_DEPOT,CONT_PAYMENT,CONT_SIZE,CONT_AMOUNT FROM KCT_Containers C
			LEFT OUTER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.ContI_Id
			WHERE C.CONT_NO LIKE '". $search ."%' AND 
			I.CONTI_ID IS NULL";
			if(strtoupper(session('depot')) === strtoupper("DEPOT NO. 5"))
			{
				$query .= " AND CONT_DEPOT='". strtoupper(session('depot')) ."'";
			}
			else
			{
				$query .= " AND CONT_DEPOT != 'DEPOT NO. 5'";
			}
			//dd($query);
			$data = DB::select($query);
			
			foreach($data as $key => $v)
			{
				$PAYMENT="UN PAID";
				if ($v->CONT_PAYMENT ==="PAID") {
					$PAYMENT="PAID";
					# code...
				}
				else {
					$PAYMENT="UN PAID";
				}
				
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'PAYMENT' => $PAYMENT,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'CONT_AMOUNT' => $v->CONT_AMOUNT,
						      'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		return response()->json($json);
	}

	function findAdditionalTransportContNo(request $req)
	{
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		$search=$req->term;
		if($search)
		{
			$query = "SELECT CONT_ID,CONT_NO,CONT_TYPE,CONT_SHIPLINE,
			CONT_DEPOT,CONT_PAYMENT,CONT_SIZE,CONTI_TRUCKNO,CONTI_TRAILERNO,
			CONTI_DRIVER,CONTI_TOWNER,CONTI_CIRIN
			FROM KCT_Containers C
			INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.ContI_Id
			WHERE C.CONT_NO LIKE '". $search ."%'";
			
			$data = DB::select($query);
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'CONTI_TRUCKNO' => $v->CONTI_TRUCKNO,
							  'CONTI_TRAILERNO' => $v->CONTI_TRAILERNO,
							  'CONTI_DRIVER' => $v->CONTI_DRIVER,
							  'CONTI_TOWNER' => $v->CONTI_TOWNER,
							  'CONTI_CIRIN' => $v->CONTI_CIRIN,
						      'label' => $v->CONT_NO,// .'@'. $v->CONT_SIZE .'@'. $v->CONT_SHIPLINE,
							  'recdt' => $created_at
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchDriverName(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			

			/*$data = DB::table('kct_drivers')
				->leftJoin('KCT_DriverList','KCT_DriverList.LICNO', '=', 'KCT_DRIVERS.LicenceNo')
			//->where("CASE WHEN DRV_NAME IS NULL THEN DRV_FNAME WHEN DRV_NAME='' THEN DRV_FNAME ELSE DRV_NAME END","like",$search .'%')
			->select(DB::raw("CASE WHEN EMP_IDNO IS NULL THEN '' ELSE EMP_IDNO END EMP_IDNO,
			CASE WHEN DRV_NAME IS NULL THEN DRV_FNAME WHEN DRV_NAME='' THEN DRV_FNAME ELSE DRV_NAME END DRV_FNAME,
			CASE WHEN LICNO IS NULL THEN LicenceNo WHEN LICNO='' THEN LicenceNo ELSE LICNO END LicenceNo,
			DRV_MNAME,DRV_LNAME,NVL(kct_drivers.IncentiveAmount,0) IncentiveAmount,kct_drivers.CompanyName,
			CASE WHEN TRUCKNO IS NULL THEN '' ELSE TRUCKNO END TRUCKNO,
			CASE WHEN TRAILER IS NULL THEN '' ELSE TRAILER END TRAILER"))->where('DRV_FNAME','like', $search ."%")
			//->whereRaw("CASE WHEN DRV_NAME IS NULL THEN DRV_FNAME WHEN DRV_NAME='' THEN DRV_FNAME ELSE DRV_NAME END like ". $search .'%')
			//->where("CASE WHEN DRV_NAME IS NULL THEN DRV_FNAME WHEN DRV_NAME='' THEN DRV_FNAME ELSE DRV_NAME END ","like",$search .'%')
			->take(10)->get()->toArray();
*/
			$data = DB::select("SELECT DISTINCT DRV_ID,CASE WHEN EMP_IDNO IS NULL THEN '' ELSE EMP_IDNO END EMP_IDNO,
			CASE WHEN DRV_NAME IS NULL THEN DRV_FNAME WHEN DRV_NAME='' THEN DRV_FNAME ELSE DRV_NAME END DRV_FNAME,
			CASE WHEN LICNO IS NULL THEN LicenceNo WHEN LICNO='' THEN LicenceNo ELSE LICNO END LicenceNo,
			DRV_MNAME,DRV_LNAME,NVL(IncentiveAmount,0) IncentiveAmount,CompanyName,
			CASE WHEN TRUCKNO IS NULL THEN '' ELSE TRUCKNO END TRUCKNO,
			CASE WHEN TRAILER IS NULL THEN '' ELSE TRAILER END TRAILER
			FROM kct_drivers D
			LEFT OUTER JOIN KCT_DriverList L ON L.LICNO=D.LicenceNo
			WHERE CONCAT(DRV_FNAME,CASE WHEN LICNO IS NULL THEN LicenceNo WHEN LICNO='' THEN LicenceNo ELSE LICNO END) LIKE '". $search ."%'");
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->DRV_ID, 
							  'value' => $v->DRV_FNAME,
							  'empidno' => $v->EMP_IDNO,
							  'licno' => $v->LicenceNo,
						      'label' => $v->DRV_FNAME .'@' . $v->LicenceNo
						      );
			}
		}
		return response()->json($json);
	}

	function findInContNo2(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			/*
			$data=DB::table('KCT_CONTAINERS')->SELECT(
				DB::raw("select (CASE WHEN (CONT_TIRLINE='P') THEN 'PAID' WHEN (CONT_TIRLINE='U') THEN 'UN PAID' ELSE CONT_TIRLINE END) as PAYMENT,
			C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,C.CONT_SHIPLINE,C.CONT_DEPOT from kct_Containers c
			LEFT OUTER JOIN kct_ContainersIn I ON C.CONT_ID=I.CONTI_ID"))
			->where('c.CONT_NO','like', $search .'%')->get();*/
			/*
			$data = DB::table("kct_Containers")->join("kct_ContainersIn","kct_Containers.CONT_ID","=","kct_ContainersIn.CONTI_ID")->
			where("kct_Containers.CONT_NO","LIKE",@search)->get()->toArray();
			*/

			//$data = DB::table("kct_Containers")
			//->leftJoin("kct_ContainersIn","kct_Containers.CONT_ID","=","kct_ContainersIn.CONTI_ID", 'left outer')
			//->select("CONT_ID,CONT_NO")->get();
			//->where("CONT_NO","LIKE",@search)->get()->toArray();
			
			//$data = DB::table("kct_Containers")
			//->leftJoin("kct_ContainersIn","kct_Containers.CONT_ID","=","kct_ContainersIn.CONTI_ID")
			//->where("kct_Containers.CONT_NO","LIKE",@search)->get();
			/*
			$query = Worker::select('workers.name_and_surname', 'workers.id', 'workers.location','company_saved_cv.worker_id')
        ->leftJoin('company_saved_cv', function($leftJoin)
        {
            $leftJoin->on('company_saved_cv.worker_id', '=', 'workers.id')

                ->on('company_saved_cv.company_id', '=', Session::get('company_id') );


		})
		*/
		/*
			$data = DB::table("kct_Containers")
			->leftJoin("kct_ContainersIn","kct_Containers.CONT_ID","=","kct_ContainersIn.CONTI_ID")
			->get();
			*/

			$data = DB::table('KCT_CONTAINERS')
        	    ->leftJoin('kct_ContainersIn','kct_ContainersIn.CONTI_ID', '=', 'kct_Containers.CONT_ID')
			->where('CONT_NO','LIKE',$search .'%')
			->wherenull("CONTI_ID")
			->get()->toArray();

			foreach($data as $key => $v)
			{
				$PAYMENT="UN PAID";
				if ($v->CONT_TIRLINE ==="P") {
					$PAYMENT="PAID";
					# code...
				}
				elseif ($v->CONT_TIRLINE ==="U") {
					$PAYMENT="UN PAID";
				}
				
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'PAYMENT' => $v->CONT_TIRLINE,
							  'CONT_SHIPLINE' => $PAYMENT,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
						      'label' => $v->CONT_NO
						      );
			}
		}
		return response()->json($json);
	}

	function findInContNo1(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_Containers')->
			where('CONT_NO','like', $search .'%')->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
						      'value' => $v->CONT_NO,
						      'label' => $v->CONT_NO
						      );
			}
		}
		return response()->json($json);
	}

	function searchRemark1(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_Remarks1Master')->
			where('RemarksName1','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->RemarkID1, 
						      'value' => $v->RemarksName1,
						      'label' => $v->RemarksName1
						      );
			}
		}
		return response()->json($json);
	}

	function searchRemark2(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_Remarks2Master')->
			where('RemarksName2','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->RemarkID2, 
						      'value' => $v->RemarksName2,
						      'label' => $v->RemarksName2
						      );
			}
		}
		return response()->json($json);
	}

	function searchOwner(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('kct_owner_mast')->
			where('Owner_Name','like', $search .'%')
			->take(10)->get(["Owner_ID","Owner_Name"]);

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->Owner_ID, 
							  'value' => $v->Owner_Name,
						      'label' => $v->Owner_Name
						      );
			}
		}
		return response()->json($json);
	}

	function searchFloorMaster(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			
			$data = DB::select("SELECT FLOOR_NAME,FLOOR_ID FROM FloorMaster WHERE REPLACE(UPPER(FLOOR_NAME),' ','') LIKE '". str_replace(' ','',strtoupper($search)) ."%'");
			//$data = \App\Models\FloorMaster::where('FLOOR_NAME','like',strtoupper($search) .'%')->get();
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->FLOOR_ID, 
							  'value' => $v->FLOOR_NAME,
							  'label' => $v->FLOOR_NAME,
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchFlatTypeMaster(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			
			$data = DB::select("SELECT FlatType,FlatTypeID FROM FlatTypeMaster WHERE REPLACE(UPPER(FlatType),' ','') LIKE '". str_replace(' ','',strtoupper($search)) ."%'");
			//$data = \App\Models\FloorMaster::where('FlatType','like',strtoupper($search) .'%')->get();
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->FlatTypeID, 
							  'value' => $v->FlatType,
							  'label' => $v->FlatType,
							  );
			}
		}
		return response()->json($json);
	}
	
	function searchFlatMaster(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			
			$data = DB::select("SELECT FLATNAME,FLATID FROM FlatMaster WHERE REPLACE(UPPER(FLATNAME),' ','') LIKE '". str_replace(' ','',strtoupper($search)) ."%'");
			//$data = \App\Models\FlatMaster::where('FLATNAME','like',strtoupper($search) .'%')->get();
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->FLATID, 
							  'value' => $v->FLATNAME,
							  'label' => $v->FLATNAME,
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchTrailerNo(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('scancardmaster')->
			where('RegNo','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->SHIP_ID, 
						      'value' => $v->RegNo,
						      'label' => $v->RegNo
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchInClearAgent(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_Clearing_Agent')->
			where('AGENT_NAME','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->ID, 
						      'value' => $v->AGENT_NAME,
						      'label' => $v->AGENT_NAME
						      );
			}
		}
		return response()->json($json);
	}

	function searchClientName(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_Client_Master')->
			where('ClientName','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->ClientID, 
						      'value' => $v->ClientName,
						      'label' => $v->ClientName
						      );
			}
		}
		return response()->json($json);
	}

	function searchVesselName(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_VESSEL')->
			where('VESSEL_NAME','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->Vessel_ID, 
						      'value' => $v->Vessel_Name,
						      'label' => $v->Vessel_Name
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchPortDisch(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_PORT_DISCH')->
			where('Port_Name','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->Port_ID, 
						      'value' => $v->Port_Name,
						      'label' => $v->Port_Name
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchFinalDest(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('countries')->
			where('name','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->id, 
						      'value' => $v->name,
						      'label' => $v->name
						      );
			}
		}
		return response()->json($json);
	}

	function searchGoing(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_Destination_Mast')->
			where('Dest_Name','like', $search .'%')
			->take(10)->get();

			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->Dest_ID, 
						      'value' => $v->Dest_Name,
						      'label' => $v->Dest_Name
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchAllReqNo(request $req)
	{
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_ShippingLinerequest')->
			where('Req_No','like', $search .'%')->
			get(["Req_ID","Req_No","ShippingLine","Cont_Size","Destination","Client_Name",
			"NoOfCont","NoOfRelease","TempNoOfCont","TempNoOfRelease","NoOfRelease"
				
			]);

			foreach($data as $key => $v)
			{
				$TempNoOfRelease = $v->TempNoOfCont - $v->TempNoOfRelease;
				$NoOfCont = $v->NoOfCont; // - $v->NoOfRelease;
				
				$json[]=  array('id' => $v->Req_ID, 
							  'value' => $v->Req_No,
							  'shpline' => $v->ShippingLine,
							  'size' => $v->Cont_Size,
							  'destination' => $v->Destination,
							  'total' => $v->TempNoOfCont,
							  'out' => $TempNoOfRelease,
							  'NoOfCont' => $NoOfCont,
							  'balqty' => $v->TempNoOfCont,
							  'client' => $v->Client_Name,
							  'label' => $v->Req_No .'/'. $v->ShippingLine .'/'. $v->Cont_Size .'/'. $v->Destination .'/'. $v->Req_ID
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchOutReqNo(request $req)
	{
		/*
		"Req_ID","SHP_ID","ShippingLine","Cont_Size","Req_Status","Req_No","NoOfCont","NoOfRelease",
				"Case When Client_Name Is Null then '' else Client_Name End Client_Name",
				"Case When Destination Is Null then '' else Destination End Destination",
				"NVL(TempNoOfCont,NVL(NoOfCont,0)) TempNoOfCont",
				"NVL(TempNoOfRelease,NVL(NoOfRelease,0)) TempBal",
				"NVL(TempNoOfCont,NVL(NoOfCont,0))-NVL(TempNoOfRelease,NVL(NoOfRelease,0)) TempNoOfRelease",
				"Case When TempStatus is null then Req_Status else TempStatus end TempStatus"
				*/
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data=DB::table('KCT_ShippingLinerequest')->
			where('Req_No','like', $search .'%')->
			where('tempStatus','=','Pending')->
			where('TempNoOfRelease','>=',0)->
			get(["Req_ID","Req_No","ShippingLine","Cont_Size","Destination","Client_Name",
			"NoOfCont","NoOfRelease","TempNoOfCont","TempNoOfRelease","NoOfRelease"
				
			]);

			foreach($data as $key => $v)
			{
				$TempNoOfRelease = $v->TempNoOfCont - $v->TempNoOfRelease;
				$NoOfCont = $v->NoOfCont; // - $v->NoOfRelease;
				
				$json[]=  array('id' => $v->Req_ID, 
							  'value' => $v->Req_No,
							  'shpline' => $v->ShippingLine,
							  'size' => $v->Cont_Size,
							  'destination' => $v->Destination,
							  'total' => $v->TempNoOfCont,
							  'out' => $TempNoOfRelease,
							  'NoOfCont' => $NoOfCont,
							  'balqty' => $v->TempNoOfCont,
							  'client' => $v->Client_Name,
							  'label' => $v->Req_No .'/'. $v->ShippingLine .'/'. $v->Cont_Size .'/'. $v->Destination
						      );
			}
		}
		return response()->json($json);
	}
	
	function swapOutReqNo(request $req)
	{
		/*
		"Req_ID","SHP_ID","ShippingLine","Cont_Size","Req_Status","Req_No","NoOfCont","NoOfRelease",
				"Case When Client_Name Is Null then '' else Client_Name End Client_Name",
				"Case When Destination Is Null then '' else Destination End Destination",
				"NVL(TempNoOfCont,NVL(NoOfCont,0)) TempNoOfCont",
				"NVL(TempNoOfRelease,NVL(NoOfRelease,0)) TempBal",
				"NVL(TempNoOfCont,NVL(NoOfCont,0))-NVL(TempNoOfRelease,NVL(NoOfRelease,0)) TempNoOfRelease",
				"Case When TempStatus is null then Req_Status else TempStatus end TempStatus"
				*/
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data = DB::select("SELECT R.Req_ID,R.Req_No,COUNT(*) Total,
				R.ShippingLine,R.Cont_Size,R.Destination,R.Client_Name
				FROM KCT_ShippingLinerequest r
				INNER JOIN KCT_CONTAINERSOUT O ON r.Req_ID=O.Req_ID
				WHERE REQ_NO LIKE '". $search ."%'
				GROUP BY R.Req_ID,R.Req_No,
				R.ShippingLine,R.Cont_Size,R.Destination,R.Client_Name");
				
			
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->Req_ID, 
							  'value' => $v->Req_No,
							  'shpline' => $v->ShippingLine,
							  'size' => $v->Cont_Size,
							  'destination' => $v->Destination,
							  'Total' => $v->Total,
							  'client' => $v->Client_Name,
							  'label' => $v->Req_No .'/'. $v->ShippingLine .'/'. $v->Cont_Size .'/'. $v->Destination
						      );
			}
		}
		return response()->json($json);
	}
	

	function findTempOutContNo1(request $req)
	{
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		$search=$req->term;
		if($search)
		{
			$data = DB::select("SELECT C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,C.CONT_SHIPLINE,C.CONT_DEPOT FROM kct_containers C
			INNER JOIN KCT_ContainersIn I ON C.CONT_ID=I.CONTI_ID
			LEFT OUTER JOIN KCT_ContainerOutMast O ON C.CONT_ID=O.CONT_ID
			WHERE C.CONT_NO LIKE '" . $search . "%' AND C.CONT_STATUS='IN' AND O.CONT_ID IS NULL");
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		return response()->json($json);
	}
	
	function findTempOutContNo2tested(request $req)
	{
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		$search=$req->contno;
		if($search)
		{
			$query="SELECT C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,C.CONT_SHIPLINE,C.CONT_DEPOT FROM kct_containers C
			INNER JOIN KCT_ContainersIn I ON C.CONT_ID=I.CONTI_ID
			LEFT OUTER JOIN KCT_ContainerOutMast O ON C.CONT_ID=O.CONT_ID
			WHERE C.CONT_NO LIKE '" . $search . "%' AND C.CONT_STATUS='IN' AND O.CONT_ID IS NULL";
			/*if (strtoupper($_POST['depot']) === "DEPOT NO. 5")
			{
				$query .= " And c.CONT_DEPOT='" . strtoupper($_POST['depot']) . "'";
			}
			else
			{
				$query .= " And c.CONT_DEPOT<>'DEPOT NO. 5'";
			}
			*/
			$data = DB::select($query);
			
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		return response()->json($json);
	}
	
	function searchDepot(Request $req)
	{
		$query='';
		$json=array();
		$search = strtoupper($req->contno);
		$depot = strtoupper($req->depot);
		if(!empty($search))
		{
			$query="SELECT DEP_ID,DEP_NAME FROM KCT_DEPOTS
				WHERE DEP_NAME LIKE '". $search ."%' AND ISACTIVE IN('Y','YES')";
			if(!empty($depot))
			{
					$query .= " AND DEP_NAME != '". $depot ."'";
			}
			$data = DB::select($query);
			
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->DEP_ID, 
							  'label' => $v->DEP_NAME,
							  'value' => $v->DEP_ID
						      );
			}
		}
		//$json=$query;
		return response()->json($json);
	}
	
	function searchContNoForTransfer(Request $req)
	{
		$query='';
		$json=array();
		$search = strtoupper($req->contno);
		$depot = strtoupper($req->depot);
		if(!empty($search))
		{
			$query="SELECT CONT_ID,CONT_NO,CONT_SIZE,CONT_TYPE,CONT_SHIPLINE,
				CONT_DEPOT,CONTI_TRUCKNO,CONTI_TRAILERNO,CONTI_DRIVER,
				CONTI_TOWNER
				FROM KCT_CONTAINERS C
				INNER JOIN KCT_CONTAINERSIN I ON C.CONT_ID=I.CONTI_ID
				LEFT OUTER JOIN kct_transfers T ON C.CONT_ID=T.CONTI_ID
				WHERE CONT_NO LIKE '". $search ."%' AND T.CONTI_ID IS NULL";
			if(!empty($depot))
			{
					$query .= " AND CONT_DEPOT != '". $depot ."'";
			}
			$data = DB::select($query);
			
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'CONTI_TRUCKNO' => $v->CONTI_TRUCKNO,
							  'CONTI_TRAILENO' => $v->CONTI_TRAILERNO,
							  'CONTI_DRIVER' => $v->CONTI_DRIVER,
							  'CONTI_OWNER' => $v->CONTI_TOWNER,
							  'CONT_ID' => $v->CONT_ID,
							  'label' => $v->CONT_NO
						      );
			}
		}
		//$json=$query;
		return response()->json($json);
	}
	
	function findTempOutContNo(Request $req)
	{
		$query='';
		
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		if(!empty($req->contno))
		{
			$query="select C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,
					C.CONT_SHIPLINE,C.CONT_DEPOT 
					From KCT_Containers c
					Inner Join KCT_ContainersIn I on c.Cont_id=I.Conti_ID";
			if(strtoupper($req->searchType)==='IN')
			{
				$query .="
					Left Outer Join KCT_ContainerOutMast o on c.cont_id=o.cont_id
					LEFT OUTER JOIN KCT_ReleaseDataUpload u ON I.CONTI_ID=U.CONT_ID";
			}
			else
			{
				$query .="
				 INNER JOIN KCT_ReleaseDataUpload u ON I.CONTI_ID=U.CONT_ID
				 Left Outer Join KCT_ContainerOutMast o on c.cont_id=o.cont_id";
			}
			$query .= "	where C.Cont_status ='In' and o.Cont_Id is Null
					and c.cont_no like '". strtoupper($req->contno) ."%'
					AND C.CONT_SHIPLINE='". strtoupper($req->shippingline) ."'
					AND SUBSTR(C.Cont_Size,1,2)='". substr($req->contsize,0,2) ."'";

			if (strtoupper(session('depot')) === "DEPOT NO. 5")
			{
				$query .= " And c.CONT_DEPOT='" . strtoupper(session('depot')) . "'";
			}
			else
			{
				$query .= " And c.CONT_DEPOT != 'DEPOT NO. 5'";
			}
			
			$data = DB::select($query);
			
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		//$json=$query;
		return response()->json($json);
	}
	
	function findExchangeContNo(Request $req)
	{
		$query='';
		
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		if(!empty($req->contno))
		{
			$query="select C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,
					C.CONT_SHIPLINE,C.CONT_DEPOT 
					From KCT_Containers c
					Inner Join KCT_ContainersIn I on c.Cont_id=I.Conti_ID
					LEFT OUTER JOIN KCT_ContainersOut o on c.CONT_ID=O.CONTI_ID
					WHERE C.Cont_status ='In' and o.Conti_Id is Null
					and c.cont_no like '". strtoupper($req->contno) ."%'";
			
			$data = DB::select($query);
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		//$json=$query;
		return response()->json($json);
	}
	
	function findExchangeOutContNo(Request $req)
	{
		$query='';
		
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		if(!empty($req->contno))
		{
			$query="select C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,
					C.CONT_SHIPLINE,C.CONT_DEPOT,CONTO_TRUCKNO,
					CONTO_TRAILER,CONTO_DRIVER,CONTO_TOWNER,
					CLIENT_NAME,R.REQ_ID,REQ_NO,DESTINATION,
					O.CONTO_ID
					From KCT_Containers c
					INNER JOIN KCT_ContainersOut o on c.CONT_ID=O.CONTI_ID
					INNER JOIN KCT_ShippingLinerequest R ON O.Req_ID=R.REQ_ID
					WHERE c.cont_no like '". strtoupper($req->contno) ."%'";
			
			$data = DB::select($query);
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'CONTI_TRUCKNO' => $v->CONTO_TRUCKNO,
							  'CONTI_TRAILENO' => $v->CONTO_TRAILER,
							  'CONTI_DRIVER' => $v->CONTO_DRIVER,
							  'CONTI_OWNER' => $v->CONTO_TOWNER,
							  'CLIENTNAME' => $v->CLIENT_NAME,
							  'REQ_ID' => $v->REQ_ID,
							  'REQ_NO' => $v->REQ_NO,
							  'DESTINATION' => $v->DESTINATION,
							  'CONTO_ID' => $v->CONTO_ID,
							  'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		//$json=$query;
		return response()->json($json);
	}
	
	function findOutContNo(Request $req)
	{
		$query='';
		
		$curTime = new \DateTime();
		$created_at = $curTime->format("Y-m-d");

		$updateTime = new \DateTime();
		$updated_at = $updateTime->format("Y-m-d H:i:s");
		
		$json=array();
		if(!empty($req->term))
		{
			$query="select C.CONT_ID,C.CONT_NO,C.CONT_SIZE,C.CONT_TYPE,C.CONT_SHIPLINE,
					C.CONT_DEPOT,I.CONTI_REMARKS1,I.CONTI_REMARKS2,
					R.REQ_ID,R.REQ_NO,R.CONT_SIZE REQ_SIZE,R.NoOfCont,R.NoOfRelease,
					uCase(CASE WHEN R.REQ_SEALSTATUS IS NULL THEN 'NO'
					WHEN R.REQ_SEALSTATUS='' THEN 'NO' ELSE R.REQ_SEALSTATUS END) REQ_SEALSTATUS
					FROM KCT_Containers c
					INNER JOIN KCT_ContainersIn I on c.Cont_id=I.Conti_ID
					INNER JOIN KCT_ContainerOutMast o on c.cont_id=o.cont_id
					INNER JOIN KCT_ShippingLinerequest R ON O.Req_ID=R.Req_ID
					LEFT OUTER JOIN KCT_CONTAINERSOUT ot on C.CONT_ID=ot.CONTI_ID
					WHERE C.Cont_status = 'In' and oT.ContI_Id is Null
					and c.cont_no like '". strtoupper($req->term) ."%'";

			if (strtoupper(session('depot')) === "DEPOT NO. 5")
			{
				$query .= " And c.CONT_DEPOT='" . strtoupper(session('depot')) . "'";
			}
			else
			{
				$query .= " And c.CONT_DEPOT != 'DEPOT NO. 5'";
			}
			
			$data = DB::select($query);
			
			
			foreach($data as $key => $v)
			{
				$json[]=  array('id' => $v->CONT_ID, 
							  'CONT_NO' => $v->CONT_NO,
							  'CONT_DEPOT' => $v->CONT_DEPOT,
							  'CONT_SHIPLINE' => $v->CONT_SHIPLINE,
							  'CONT_SIZE' => $v->CONT_SIZE,
							  'CONT_TYPE' => $v->CONT_TYPE,
							  'REQ_ID' => $v->REQ_ID,
							  'REQ_NO' => $v->REQ_NO,
							  'REQ_SIZE' => $v->REQ_SIZE,
							  'REQ_SEALSTATUS' => $v->REQ_SEALSTATUS,
							  'NoOfCont' => $v->NoOfCont,
							  'NoOfRelease' => $v->NoOfRelease,
							  'CONTI_REMARKS1' => $v->CONTI_REMARKS1,
							  'CONTI_REMARKS2' => $v->CONTI_REMARKS2,
							  'label' => $v->CONT_NO,
							  'recdt' => $created_at
						      );
			}
		}
		//$json=$query;
		return response()->json($json);
	}
}
