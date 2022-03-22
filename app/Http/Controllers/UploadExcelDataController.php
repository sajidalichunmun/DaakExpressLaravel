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

class UploadExcelDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = UploadExcelDataModel::with('client')
		->wherenull('AwbNo')
		->where('DataType','=','WITHOUT POD')
		->where('Status','=','Pending')
		->paginate(25);
		
        return view('UploadClientData.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = UploadExcelDataModel::where('RefNo1','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('UploadClientData.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = ClientCodeModel::pluck('name','id')->all();
        
        return view('UploadClientData.create',compact('client'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadClientDataFormRequest $request)
    {
		try
		{
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			
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
								$data['CustomerName'] = strtoupper($row[$i][2]);
								$data['MobileNo'] = strtoupper($row[$i][3]);
								$data['Address1'] = strtoupper($row[$i][4]);
								$data['Address2'] = strtoupper($row[$i][5]);
								$data['Address3'] = strtoupper($row[$i][6]);
								$data['CityName'] = strtoupper($row[$i][7]);
								$data['StateName'] = strtoupper($row[$i][8]);
								$data['Pincode'] = strtoupper($row[$i][9]);
								$data['Status'] = 'Pending';
								$data['DataType'] ='WITHOUT POD';
								$data['UploadDT'] = $created_at;;
								$data['CreatedBy'] = Auth::user()->name;
								$data['CreatedOn'] = $created_at;
								$data['IsActive'] = 'YES';
								
								UploadExcelDataModel::create($data);
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
			
			UploadExcelDataModel::create($data);
			*/
			return redirect()->route('UploadClientData.TranMenu.index')->with('success','Record successfully Saved..');
			
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
        $result = UploadExcelDataModel::FindOrFail($id);
		
		return view('UploadClientData.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$client = ClientCodeModel::pluck('name','id')->all();
		
        $result = UploadExcelDataModel::FindOrFail($id);
		
		return view('UploadClientData.edit',compact('result','client'));
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
			
			$result = UploadExcelDataModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('UploadClientData.TranMenu.index')->with('success','Record successfully Updated...');
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
			$result = UploadExcelDataModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('UploadClientData.index')->with('success','Record successfully deleted..');
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
		//DB::table("ClientExcelData")->whereIn('id',explode(",",$ids))->delete();
        
		UploadExcelDataModel::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Client Excel Data Deleted successfully."]);
    }
}
