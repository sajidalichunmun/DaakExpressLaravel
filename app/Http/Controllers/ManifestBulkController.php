<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\ManifestBulkFormRequest;
use App\Models\ManifestBulkModel;
use App\Models\FranchiseeModel;
use App\Models\AwbMasterModel;
use App\Models\AwbMasterHistModel;
use App\Imports\FirstSheetImport;
use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class ManifestBulkController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->where('Status','=','MANIFEST')->wherenotnull('FranID')->paginate(25);
		
        return view('ManifestBulk.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')
				->where('Status','=','MANIFEST')
				->wherenotnull('FranID')
				->where('AwbNo','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('ManifestBulk.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franchisee = FranchiseeModel::pluck('name','id')->all();
		
        return view('ManifestBulk.create',compact('franchisee'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManifestBulkFormRequest $request)
    {
		$fieldname = '';
		$valid_field = array('AwbNo');
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
								$data['awbno'] = strtoupper($row[$i][0]);

								$fran = AwbMasterModel::whereNull('franid')
										->where('AwbNo',$data['awbno'])
										->pluck('id');
								
								if(!empty($data['awbno']) && count($fran) > 0)
								{
									AwbMasterModel::where('AwbNo',$data['awbno'])
												->update([
													'Status' => 'MANIFEST',
													'RouteDate' => $request->scandate,
													'FRANID' => $request->FranID
												]);

										$PodSlNo = 1;
										$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['awbno']]);
										
										foreach($result as $key => $row)
										{
											$PodSlNo = $row->PodSlNo;
										}
										
										$data1['PodSlNo'] = $PodSlNo;
										$data1['AwbNo'] = $data['awbno'];
										$data1['HistDate'] = $request->scandate;
										$data1['HistStatus'] = $data['status'];
										$data1['CreatedBy'] = Auth::user()->name;
										$data1['CreatedOn'] = $created_at;
										
										AwbMasterHistModel::create($data1);
								}
							}
						}
					}
			  	}
			}
		
			return redirect()->route('ManifestBulk.TranMenu.index')->with('success','Record successfully Saved..');
			
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
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->where('Status','=','MANIFEST')->wherenotnull('FranID')->FindOrFail($id);
		
		return view('ManifestBulk.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->where('Status','=','MANIFEST')->wherenotnull('FranID')->FindOrFail($id);
		
		$franchisee = FranchiseeModel::pluck('name','id')->all();
		
		return view('ManifestBulk.edit',compact('result','franchisee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManifestBulkFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			//$result = ManifestBulkModel::FindOrFail($id);
			
			//$result->update($data);
			
			DB::update('UPDATE AWBMASTER SET
				FRANID = ?,
				Status = ?,
				RouteDate = ?
				WHERE AWBNO = ?',
				[$data['FranID'],'MANIFEST',$data['scandate'],$data['AwbNo']]);
			
			return redirect()->route('ManifestBulk.TranMenu.index')->with('success','Record successfully Updated...');
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
			//$result = ManifestBulkModel::findorfail($id);
			
			//$result->delete();
			
			DB::delete('DELETE FROM AwbMaster_Hist
				WHERE AWBNO = ?',[$id]);
			
			DB::update('UPDATE AWBMASTER SET
				FRANID = null,
				Status = ?,
				RouteDate = null
				WHERE AWBNO = ?',
				['Pending',$data['AwbNo']]);
							
			return redirect()->route('ManifestBulk.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
