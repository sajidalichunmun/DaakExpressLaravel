<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Imports\FirstSheetImport;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use DateTime;
use Auth;
use Exception;


class ImportShpLineReqData extends Controller
{
    public function create() 
    {
        return view('ImportShpLineRequest.excel');
    }
	
	public function import(Request $request) 
    {
		
		$arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        				
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
				
				$rrr = $collection[0];

				
				$array1[] = array('Req_ID','SHP_ID','ShippingLine','NoOfCont','NoOfRelease',
				'Cont_Size','Req_Status','Req_No','Req_Date','Expire_Date','Expire_Days',
				'Agent_Name','Voyage_No','Shipping_Order','Vessel_Name','Client_Name',
				'Destination','TempNoOfCont','TempNoOfRelease','TempStatus','Final_Dest',
				'Container_TO','Req_Remarks','ContTypeID','Req_SealStatus','Shipper_Name',
				'Booking_No','Release_OrderNo','CreatedBy','CreatedOn','UpdatedBy',
				'UpdatedOn','IsActive','EntryTime');
				
				
				foreach($collection as $key => $row)
				{
					if($row->count()>0)
					{
						$rrr = $row;
						//Checking excel sheet field and db fields
						$array[] = $row[0];
						
						for($i=1; $i<=$rrr->count()-1;$i++)
						{
							$Req_ID = $rrr[$i][0];
							$SHP_ID = $rrr[$i][1];
							$ShippingLine = $rrr[$i][2];
							$NoOfCont = $rrr[$i][3];
							$NoOfRelease = $rrr[$i][4];
							$Cont_Size = $rrr[$i][5];
							$Req_Status = $rrr[$i][6];
							$Req_No = $rrr[$i][7];
							$Req_Date = \Carbon\Carbon::parse($rrr[$i][8]);
							$Expire_Date = \Carbon\Carbon::parse($rrr[$i][9]);
							$Expire_Days = $rrr[$i][10];
							$Agent_Name = $rrr[$i][11];
							$Voyage_No = $rrr[$i][12];
							$Shipping_Order = $rrr[$i][13];
							$Vessel_Name = $rrr[$i][14];
							$Client_Name = $rrr[$i][15];
							$Destination = $rrr[$i][16];
							$TempNoOfCont = $rrr[$i][17];
							$TempNoOfRelease = $rrr[$i][18];
							$TempStatus = $rrr[$i][19];
							$Final_Dest = $rrr[$i][20];
							$Container_TO = $rrr[$i][21];
							$Req_Remarks = $rrr[$i][22];
							$ContTypeID = $rrr[$i][23];
							$Req_SealStatus = $rrr[$i][24];
							$Shipper_Name = $rrr[$i][25];
							$Booking_No = $rrr[$i][26];
							$Release_OrderNo = $rrr[$i][27];
							$CreatedBy = $rrr[$i][28];
							$CreatedOn = \Carbon\Carbon::parse($rrr[$i][29]);
							$UpdatedBy = $rrr[$i][30];
							$UpdatedOn = $rrr[$i][31] === '' ? null : \Carbon\Carbon::parse($rrr[$i][31]);
							$IsActive = $rrr[$i][32];
							$EntryTime = \Carbon\Carbon::parse($rrr[$i][33]);
							
							$result = DB::select("select *from kct_shippinglinerequest WHERE Req_ID = ?" , [$Req_ID]);
							if(!$result)
							{
								try
								{
									$check = DB::insert('INSERT INTO kct_shippinglinerequest(
									Req_ID,SHP_ID,ShippingLine,NoOfCont,NoOfRelease,Cont_Size,
									Req_Status,Req_No,Req_Date,Expire_Date,Expire_Days,Agent_Name,
									Voyage_No,Shipping_Order,Vessel_Name,Client_Name,Destination,
									TempNoOfCont,TempNoOfRelease,TempStatus,Final_Dest,Container_TO,
									Req_Remarks,ContTypeID,Req_SealStatus,Shipper_Name,Booking_No,
									Release_OrderNo,CreatedBy,CreatedOn,UpdatedBy,UpdatedOn,IsActive,EntryTime)
									VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
									[$Req_ID,$SHP_ID,$ShippingLine,$NoOfCont,$NoOfRelease,
									$Cont_Size,$Req_Status,$Req_No,$Req_Date,$Expire_Date,
									$Expire_Days,$Agent_Name,$Voyage_No,$Shipping_Order,
									$Vessel_Name,$Client_Name,$Destination,$TempNoOfCont,
									$TempNoOfRelease,$TempStatus,$Final_Dest,$Container_TO,
									$Req_Remarks,$ContTypeID,$Req_SealStatus,$Shipper_Name,
									$Booking_No,$Release_OrderNo,$CreatedBy,$CreatedOn,
									$UpdatedBy,$UpdatedOn,$IsActive,$EntryTime]);
									
								}
								catch(\Exception $ex)
								{
									dd($ex->getMessage());
								}
							}
							else
							{
								$check = DB::update('UPDATE kct_shippinglinerequest SET
									SHP_ID = ?,ShippingLine = ?,NoOfCont = ?,NoOfRelease = ?,Cont_Size = ?,
									Req_Status = ?,Req_No = ?,Req_Date = ?,Expire_Date = ?,Expire_Days = ?,Agent_Name = ?,
									Voyage_No = ?,Shipping_Order = ?,Vessel_Name = ?,Client_Name = ?,Destination = ?,
									TempNoOfCont = ?,TempNoOfRelease = ?,TempStatus = ?,Final_Dest = ?,Container_TO = ?,
									Req_Remarks = ?,ContTypeID = ?,Req_SealStatus = ?,Shipper_Name = ?,Booking_No = ?,
									Release_OrderNo = ?,CreatedBy = ?,CreatedOn = ?,UpdatedBy = ?,UpdatedOn = ?,IsActive = ?,EntryTime = ?
									WHERE Req_ID = ?',
									[$SHP_ID,$ShippingLine,$NoOfCont,$NoOfRelease,
									$Cont_Size,$Req_Status,$Req_No,$Req_Date,$Expire_Date,
									$Expire_Days,$Agent_Name,$Voyage_No,$Shipping_Order,
									$Vessel_Name,$Client_Name,$Destination,$TempNoOfCont,
									$TempNoOfRelease,$TempStatus,$Final_Dest,$Container_TO,
									$Req_Remarks,$ContTypeID,$Req_SealStatus,$Shipper_Name,
									$Booking_No,$Release_OrderNo,$CreatedBy,$CreatedOn,
									$UpdatedBy,$UpdatedOn,$IsActive,$EntryTime,$Req_ID]);
							}
						}
					}
				}
				//Session::flash('message','Upload Successful.');
				$arr = array('msg' => 'Successfully Data Uploaded', 'status' => true);
			}
			else
			{
				 Session::flash('message','File too large. File must be less than 2MB.');
				 $arr = array('msg' => 'File too large. File must be less than 2MB.', 'status' => false);
			}
		}
		else
		{
		   //Session::flash('message','Invalid File Extension.');
		   $arr = array('msg' => 'Invalid File Extension.', 'status' => false);
		}
        return back()->with('success', 'Excel Imported, Download to see the imported data.');
    }
}
