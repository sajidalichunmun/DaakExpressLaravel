<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\UploadClientDataFormRequest;
use App\Models\UploadExcelDataModel;

use App\Imports\FirstSheetImport;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App\Models\ClientCodeModel;
use App\Models\PacketStatusModel;
use App\Models\RTOModel;
use App\Models\RelationModel;
use App\Models\DeliveryModel;
use App\Models\pendingMasterModel;
use App\Models\AwbMasterModel;
use App\Models\AwbMasterHistModel;
use App\Models\ReasonModel;
use App\Models\Delivered_Rto_By_Excel;

class DeliveryRtoByExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = Delivered_Rto_By_Excel::paginate(25);
		
        return view('deliveryrtoexcel.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = Delivered_Rto_By_Excel::where('AwbNo','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('deliveryrtoexcel.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliveryrtoexcel.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadClientDataFormRequest $request)
    {
		$fieldname = '';
		$valid_field=array('awbno','status','receivername','relation','mobileno','reason','routedate');
		try
		{
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			
			$curTime1 = new \DateTime();
			$hdate = $curTime1->format("Y-m-d");

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
					
					$collection = Excel::toCollection(new FirstSheetImport, $path);
					$k=0;
					foreach($collection as $key => $row)
					{
						if($row->count()>0)
						{
							if($k===0)
							{
								$check = $row[0];
								if(count($check)!=count($valid_field))
								{
									return back()->withInput()->withErrors(['error' =>'Fields are not matched!! '.count($check) .' '.count($valid_field)]);
								}
								for($i=0;$i<$check->count();$i++)
								{
									if(in_array(strtolower($check[$i]),array_map('strtolower', $valid_field)))
									{
										
									}
									else
									{
										$fieldname .= $check[$i] .',';
									}
								}
								if(!empty($fieldname))
								{
									return back()->withInput()->withErrors(['error' =>'Missing fields are ( '. $fieldname .' )']);
								}
								$k=1;
							}
							for($i=1;$i<$row->count();$i++)
							{
								$data['awbno'] = strtoupper($row[$i][0]);
								$data['status'] = strtoupper($row[$i][1]); 
								$data['ReceiverName'] = strtoupper($row[$i][2]);
								$data['Relation'] = strtoupper($row[$i][3]);
								$data['MobileNo'] = strtoupper($row[$i][4]);
								$data['Reason'] = strtoupper($row[$i][5]);
								$data['RouteDate'] = strtoupper($row[$i][6]);

								if($data['RouteDate'] != '')
								{
									//$newDateFormat2 = date('d/m/Y', strtotime($data['RouteDate']));
									
									$data['RouteDate'] = \Carbon\Carbon::parse($data['RouteDate'])->format('Y-m-d');
									//$routedate = date('Y-m-d', strtotime(str_replace('/', '-', trim($orgDate))));
									//$data['RouteDate'] = $routedate;
									//$data['RouteDate'] = $data['RouteDate']->format('Y-m-d');
								}

								$data['CurrentStatus'] = "Not Uploaded";
								$data['UploadDT'] = $created_at;
								$data['CreatedBy'] = Auth::user()->name;
								$data['CreatedOn'] = $created_at;

								$awbmast = AwbMasterModel::where('AwbNo',$data['awbno'])->pluck('AwbNo');
								
								$delivered = DeliveryModel::where('AwbNo',$data['awbno'])->pluck('AwbNo');
								
								$status = PacketStatusModel::where('name',$data['status'])->pluck('id');

								if(strtoupper($data['status'])=="DELIVERED" && count($status) > 0 && count($awbmast) > 0 && count($delivered) > 0)
								{
									$relation = RelationModel::where('name',$data['Relation'])->pluck('id');
									
									if(count($relation) > 0)
									{
										AwbMasterModel::where('AwbNo',$data['awbno'])
												->update([
													'Status' => $data['status'],
													'RouteDate' => $data['RouteDate'],
												]);

										$PodSlNo = 1;
										$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['awbno']]);
										
										foreach($result as $key => $row)
										{
											$PodSlNo = $row->PodSlNo;
										}
										
										$data1['PodSlNo'] = $PodSlNo;
										$data1['AwbNo'] = $data['awbno'];
										$data1['HistDate'] = $data['RouteDate'];
										$data1['HistStatus'] = $data['status'];
										$data1['CreatedBy'] = Auth::user()->name;
										$data1['CreatedOn'] = $created_at;
										
										AwbMasterHistModel::create($data1);

										$data2['AwbNo'] = $data['awbno'];
										$data2['StatusID'] = $status[0];
										$data2['dlvdt'] = $data['RouteDate'];
										$data2['RecName'] = $data['ReceiverName'];
										$data2['RelationID'] = $relation[0];
										$data2['DPhoneNo'] = $data['MobileNo'];
										$data2['CreatedBy'] = Auth::user()->name;
										$data2['CreatedOn'] = $created_at;
										$data2['dlvoption'] = "Delivery/Rto By Excel Data";

										DeliveryModel::create($data2);

										$data['CurrentStatus'] = "Uploaded Delivered";
									}
								}
								else if(strtoupper($data['status'])=="RTO" && count($status) > 0 && count($awbmast))
								{
									$reason = ReasonModel::where('name',$data['Reason'])->Pluck('id');
									if(count($reason) > 0)
									{
										AwbMasterModel::where('AwbNo',$data['awbno'])
												->update([
													'Status' => $data['status'],
													'RouteDate' => $data['RouteDate'],
												]);

											$PodSlNo = 1;
											$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['awbno']]);
											
											foreach($result as $key => $row)
											{
												$PodSlNo = $row->PodSlNo;
											}
											
											$data1['PodSlNo'] = $PodSlNo;
											$data1['AwbNo'] = $data['awbno'];
											$data1['HistDate'] = $data['RouteDate'];
											$data1['HistStatus'] = $data['status'];
											$data1['CreatedBy'] = Auth::user()->name;
											$data1['CreatedOn'] = $created_at;
											
										AwbMasterHistModel::create($data1);


											$data2['AwbNo'] = $data['awbno'];
											$data2['StatusID'] = $status[0];
											$data2['RTODT'] = $data['RouteDate'];
											$data2['ReasonID'] = $reason[0];
											$data2['CreatedBy'] = Auth::user()->name;
											$data2['CreatedOn'] = $created_at;
											$data2['rtooption'] = 'Delivery/Rto By Excel Data';

										RTOModel::create($data2);
										$data['CurrentStatus'] = "Uploaded RTO";
									}
								}
								else if(strtoupper($data['status'])=="PENDING" && count($status) > 0 && count($awbmast))
								{
									AwbMasterModel::where('AwbNo',$data['awbno'])
											->update([
												'Status' => $data['status'],
												'RouteDate' => $data['RouteDate'],
											]);

									$PodSlNo = 1;
									$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['awbno']]);
									
									foreach($result as $key => $row)
									{
										$PodSlNo = $row->PodSlNo;
									}
									
									$data1['PodSlNo'] = $PodSlNo;
									$data1['AwbNo'] = $data['awbno'];
									$data1['HistDate'] = $data['RouteDate'];
									$data1['HistStatus'] = $data['status'];
									$data1['CreatedBy'] = Auth::user()->name;
									$data1['CreatedOn'] = $created_at;
									
									AwbMasterHistModel::create($data1);

									$data2['AwbNo'] = $data['AwbNo'];
									$data2['StatusID'] = $status[0];
									$data2['pnddt'] = $data['RouteDate'];
									$data2['CreatedBy'] = Auth::user()->name;
									$data2['CreatedOn'] = $created_at;
									$data2['pendingoption'] = 'Delivery/Rto By Excel Data';

									pendingMasterModel::create($data2);

									$data['CurrentStatus'] = "Uploaded Pending";
								}
								
								//Delivered_Rto_By_Excel::create($data);

								Delivered_Rto_By_Excel::create([
									'AwbNo' => $data['awbno'],
									'Status' => $data['status'], 
									'ReceiverName' => $data['ReceiverName'],
									'Relation' => $data['Relation'],
									'MobileNo' => $data['MobileNo'],
									'Reason' => $data['Reason'],
									'RouteDate' => $data['RouteDate'],
									'CreatedBy' => $data['CreatedBy'],
									'CreatedOn' => $data['CreatedOn'],
									'CurrentStatus' => $data['CurrentStatus']
								]);
							}
							//dd($row);
						}
					}
			  }
			}
			return redirect()->route('deliveryrtoexcel.TranMenu.index')->with('success','Record successfully Saved..');
			
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
        $result = Delivered_Rto_By_Excel::FindOrFail($id);
		
		return view('deliveryrtoexcel.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Delivered_Rto_By_Excel::FindOrFail($id);
		
		return view('deliveryrtoexcel.edit',compact('result','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadClientDataFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = Delivered_Rto_By_Excel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('deliveryrtoexcel.TranMenu.index')->with('success','Record successfully Updated...');
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
			$result = Delivered_Rto_By_Excel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('deliveryrtoexcel.index')->with('success','Record successfully deleted..');
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
		
		DB::table("Delivered_Rto_By_Excel")->whereIn('id',explode(",",$ids))->delete();
        
        return response()->json(['success'=>"Delivery/Rto Excel Data Deleted successfully."]);
    }
}
