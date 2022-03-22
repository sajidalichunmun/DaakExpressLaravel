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
use App\Http\Requests\CityFormRequest;
use App\Models\CityModel;
use App\Models\StateModel;
use App\Models\CountryModel;

class UploadCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = CityModel::with('State')->paginate(25);
		
        return view('uploadcity.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = CityModel::with('State')->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('uploadcity.index',compact('result'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploadcity.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityFormRequest $request)
    {
		$fieldname = '';
		$valid_field = array('CityName','StateName');
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
								$data['city'] = strtoupper($row[$i][0]);
								$data['state'] = strtoupper($row[$i][1]);
								$city = CityModel::where('name',$data['city'])->pluck('id');
								$state = StateModel::where('name',$data['state'])->pluck('id');
								
								if(count($state) > 0 && count($city) <= 0)
								{
									CityModel::create([
										'Name' => $data['city'],
										'StateID' => $state[0],
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
			return redirect()->route('uploadcity.TranMenu.index')->with('success','Record successfully Saved..');
			
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
        $result = CityModel::FindOrFail($id);
		
		return view('uploadcity.show',compact('result'));
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
		
        $result = CityModel::FindOrFail($id);
		
		return view('uploadcity.edit',compact('result','client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityFormRequest $request, $id)
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
			
			return redirect()->route('uploadcity.TranMenu.index')->with('success','Record successfully Updated...');
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
			$result = CityModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('uploadcity.index')->with('success','Record successfully deleted..');
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
		CityModel::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Client Excel Data Deleted successfully."]);
    }
}
