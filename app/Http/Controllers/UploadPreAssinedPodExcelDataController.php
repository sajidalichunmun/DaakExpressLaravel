<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\UploadPreAssinedPodFormRequest;
use App\Models\UploadPreAssinedPodExcelDataModel;
use App\Models\ClientCodeModel;
use App\Models\AwbMasterModel;
use App\Models\AwbMasterHistModel;

use App\Imports\FirstSheetImport;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class UploadPreAssinedPodExcelDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
		//$result = AwbMasterModel::with('ClientExcelData')->paginate(25);
		$result = UploadPreAssinedPodExcelDataModel::wherenotnull('AwbNo')
		->where('DataType','=','PRE POD CLIENT DATA')->where('Status','=','Pending')
		->paginate(25);
		
        return view('UploadPreAssignedPod.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = UploadPreAssinedPodExcelDataModel::where('AwbNo','=' , $request->txtSearchID .'%')->paginate(25);
		
        return view('UploadPreAssignedPod.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = ClientCodeModel::pluck('Name','id')->all();
        
        return view('UploadPreAssignedPod.create',compact('client'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadPreAssinedPodFormRequest $request)
    {
		try
		{
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$poddate = $curTime->format("Y-m-d");
			$data = $request->getData();
			
			
			$path1 = $request->file('select_file')->store('temp'); 
			
			$path=storage_path('app').'/'.$path1;  
			$file = $request->file('select_file');
			
			// File Details
			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$tempPath = $file->getRealPath();
			$fileSize = $file->getSize();
			$mimeType = $file->getMimeType();
			
			// Valid File Extensions
			$valid_extension = array("xls","xlsx");

			// 2MB in Bytes
			$maxFileSize = 2097152;

			// Check file extension
			if(in_array(strtolower($extension),$valid_extension))
			{
			  // Check file size
			  if($fileSize <= $maxFileSize)
			  {
					$location = 'images';
					$location = 'ExelData';
					$file->move($location,$filename);
					
					$path = $location .'\\'. $filename;
					//dd($path);
					
					$collection = Excel::toCollection(new FirstSheetImport, $path);
					
					foreach($collection as $key => $row)
					{
						if($row->count()>0)
						{
							for($i=1;$i<$row->count();$i++)
							{
								$data['RefNo1'] = strtoupper($row[$i][0]);
								$data['BarcodeNo'] = strtoupper($row[$i][1]);
								$data['AwbNo'] = strtoupper($row[$i][2]);
								$data['CustomerName'] = strtoupper($row[$i][3]);
								$data['MobileNo'] = strtoupper($row[$i][4]);
								$data['Address1'] = strtoupper($row[$i][5]);
								$data['Address2'] = strtoupper($row[$i][6]);
								$data['Address3'] = strtoupper($row[$i][7]);
								$data['CityName'] = strtoupper($row[$i][8]);
								$data['StateName'] = strtoupper($row[$i][9]);
								$data['Pincode'] = strtoupper($row[$i][10]);
								$data['Status'] = 'Pending';
								$data['DataType'] ='PRE POD CLIENT DATA';
								$data['UploadDT'] = $created_at;;
								$data['CreatedBy'] = Auth::user()->name;
								$data['CreatedOn'] = $created_at;
								$data['IsActive'] = 'YES';
								
								$CountryID = '';
								$StateID = '';
								$CityID = '';
								$SubCityID='';
								if(!(empty($data['AwbNo']) && empty($data['Pincode'])))
								{
									$result1 = DB::select('SELECT *FROM AWBMASTER WHERE AWBNO = ?',[$data['AwbNo']]);
									if(!$result1)
									{
										
										$result2 = DB::select('select C.Name,state.Name,city.Name,scity.Name,
										MainAreaName,c.id countryid,state.id StateID,city.id CityID,scity.id SubCityID
										 from CountryMaster c
										 inner join statemaster state on c.id=state.countryid
										 inner join citymaster city on state.id=city.StateID
										 inner join subcitymaster scity on city.id=scity.CityID
										 WHERE Pincode = ?',[$data['Pincode']]);
										if($result2)	 
										{
											foreach($result2 as $key => $value)
											{
												$CountryID = $value->countryid;
												$StateID = $value->StateID;
												$CityID = $value->CityID;
												$SubCityID = $value->SubCityID;
											}
											
											UploadPreAssinedPodExcelDataModel::create($data);
											
											
											//Pod Entry
											$data1['AwbNo'] = strtoupper($row[$i][2]);
											$data1['RefNo'] = strtoupper($row[$i][0]);
											$data1['BarcodeNo'] = strtoupper($row[$i][1]);
											$data1['PodDate'] = $poddate;
											$data1['ClientCodeID'] = $request->ClientCodeID;
											$data1['CustomerName'] = strtoupper($row[$i][3]);
											$data1['MobileNo'] = strtoupper($row[$i][4]);
											$data1['Address1'] = strtoupper($row[$i][5]);
											$data1['Address2'] = strtoupper($row[$i][6]);
											//$data1['Address3'] = strtoupper($row[$i][7]);
											$data1['Pincode'] = strtoupper($row[$i][10]);
											$data1['SubCityID'] = $SubCityID;
											$data1['CityID'] = $CityID;
											$data1['StateID'] = $StateID;
											$data1['Status'] = 'Pending';
											$data1['AssignedType'] ='PRE POD CLIENT DATA';
											$data1['AssignedType'] ='POD ASSIGNED';
											$data1['CreatedBy'] = Auth::user()->name;
											$data1['CreatedOn'] = $created_at;
											
											$shipmentno = rand(106890122,100000000);
											$redColor = '255,0,0';
											$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
											$barcodes = $generator->getBarcode($shipmentno,
												$generator::TYPE_STANDARD_2_5,2,60);
											
											$jpg_barcode = new Picqer\Barcode\BarcodeGeneratorJPG();
											file_put_contents("barcode/barcode/". $shipmentno .'.jpg',
												$jpg_barcode->getBarcode($shipmentno,
												$jpg_barcode::TYPE_CODE_128,3,50));

											$data['barcode_src'] = $shipmentno .'.jpg';
											$data1['shipmentno'] = $shipmentno;
											$data1['awbbarcode'] = $barcodes;
											
											AwbMasterModel::Create($data1);
											//Pods Entry End
											
											$PodSlNo = 1;
											$result3 = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['AwbNo']]);
											
											foreach($result3 as $key => $v)
											{
												$PodSlNo = $v->PodSlNo;
											}
											
											$data2['PodSlNo'] = $PodSlNo;
											$data2['AwbNo'] = $data['AwbNo'];
											$data2['HistDate'] = $created_at;
											$data2['HistStatus'] = 'POD ASSIGNED';
											$data2['CreatedBy'] = Auth::user()->name;
											$data2['CreatedOn'] = $created_at;
											
											AwbMasterHistModel::create($data2);
										}
									}
								}
							}
							//dd($row);
						}
					}
			  }
			}
		/*
			dd($data);
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			UploadPreAssinedPodExcelDataModel::create($data);
			*/
			return redirect()->route('UploadPreAssignedPod.TranMenu.index')->with('success','Record successfully Saved..');
			
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = UploadPreAssinedPodExcelDataModel::with('Awb')->FindOrFail($id);
		
		return view('UploadPreAssignedPod.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$client = ClientCodeModel::pluch('Name','id')->all();
		
        $result = UploadPreAssinedPodExcelDataModel::with('Awb')->FindOrFail($id);
		
		return view('UploadPreAssignedPod.edit',compact('result','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadPreAssinedPodFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = UploadPreAssinedPodExcelDataModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('UploadPreAssignedPod.TranMenu.excel')->with('success','Record successfully Updated...');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['errors' => $ex->getMessage()]);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
		{
			//+666$result = UploadPreAssinedPodExcelDataModel::findorfail($id);
			
			//$result->delete();
			
			DB::delete('DELETE FROM ClientExcelData WHERE AWBNO = ?',[$id]);
			
			return redirect()->route('UploadPreAssignedPod.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
		DB::table("ClientExcelData")->whereIn('id',explode(",",$ids))->delete();
        //DB::table("ClientExcelData")->whereIn('ID',explode(",",$ids))->delete();
        return response()->json(['success'=>"Client Excel Data Deleted successfully."]);
    }
}
