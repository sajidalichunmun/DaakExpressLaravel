<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Models\UploadExcelDataModel;

use App\Imports\FirstSheetImport;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App\Http\Requests\SubAreaFormRequest;
use App\Models\SubAreaModel;
use App\Models\CityModel;
use App\Models\StateModel;
use App\Models\CountryModel;

class UploadSubareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = SubAreaModel::with('City')->paginate(25);
		
        return view('uploadsubarea.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = SubAreaModel::with('City')->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('uploadsubarea.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploadsubarea.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubAreaFormRequest $request)
    {
		$fieldname = '';
		$valid_field = array('SubArea','MainAreaName','pincode','CityName');
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
					$k = 0;
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
								$data['subarea'] = strtoupper($row[$i][0]);
								$data['mainarea'] = strtoupper($row[$i][1]);
								$data['pincode'] = strtoupper($row[$i][2]);
								$data['city'] = strtoupper($row[$i][3]);
								
								$city = CityModel::where('name',$data['city'])->pluck('id');
								
								if(!(empty($data['pincode']) && !empty($data['subarea']) && !empty($data['mainarea'])) && count($city) > 0)
								{
									$subarea = SubAreaModel::where('Pincode',$data['pincode'])
											->where('Name',$data['subarea'])
											->where('MainAreaName',$data['mainarea'])
											->pluck('id');
									if(count($subarea) <= 0)
									{
										SubAreaModel::create([
											'Name' => $data['subarea'],
											'MainAreaName' => $data['mainarea'],
											'Pincode' => $data['pincode'],
											'CityID' => $city[0],
											'CreatedBy' => Auth::user()->name,
											'CreatedOn' => $created_at,
											'IsActive' => 'YES'
										]);
									}
								}
							}
						}
					}
			  	}
			}
			return redirect()->route('uploadsubarea.TranMenu.index')->with('success','Record successfully Saved..');
			
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
        $result = SubAreaModel::FindOrFail($id);
		
		return view('uploadsubarea.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$City = CityModel::pluck('Name','id')->all();
        $State = StateModel::pluck('Name','id')->all();
		$Country = CountryModel::pluck('Name','id')->all();
		
		return view('uploadsubarea.edit',compact('result','City','State','Country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubAreaFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = SubAreaModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('uploadsubarea.TranMenu.index')->with('success','Record successfully Updated...');
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
			$result = SubAreaModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('uploadsubarea.index')->with('success','Record successfully deleted..');
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
		SubAreaModel::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Client Excel Data Deleted successfully."]);
    }
}
