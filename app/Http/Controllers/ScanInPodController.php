<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\ScanInPodFormRequest;
use App\Models\ScanInPodModel;
use App\Models\AwbMasterModel;
use App\Models\FranchiseeModel;
use App\Models\AwbMasterHistModel;

class ScanInPodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName','scanin')
		->has('scanin')
		->paginate(25);
		
        return view('ScanInPod.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName','scanin')
		->where('AwbNo','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('ScanInPod.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franchisee = FranchiseeModel::pluck('name','id')->all();
        
		$result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName','scanin')
		->has('scanin')
		->where('CreatedBy','=',Auth::user()->name)->orderBy('id', 'DESC')->limit(1)->first();;
		
        //dd($result);
		
		$customername = isset($result->CustomerName) ? $result->CustomerName : '';
		$prevpodno = isset($result->AwbNo) ? $result->AwbNo : '';
		$prevfranid = isset($result->FranID) ? $result->FranID : '';
		
		
        return view('ScanInPod.create',compact('franchisee','customername','prevpodno','prevfranid'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScanInPodFormRequest $request)
    {
		try
		{
			
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			$result = DB::select('SELECT *FROM AWBMASTER WHERE AWBNO = ?',[$data['AwbNo']]);
			if(!$result)
			{
				return back()->withInput()->withErrors(['error' => 'POD NUMBER NOT FOUND...']);
			}
			
			$result = DB::select('SELECT *FROM AWBMASTER A
						INNER JOIN FRANCHISEEMASTER F ON A.FRANID=F.ID
						WHERE AWBNO = ? AND F.ID = ?',[$data['AwbNo'],$data['FranID']]);
			if(!$result)
			{
				return back()->withInput()->withErrors(['error' => $data['AwbNo'] .' not belong to selectd Franchisee']);
			}
			
			$result = DB::select('SELECT *FROM awb_scan_in WHERE AWBNO = ?',[$data['AwbNo']]);
			if($result)
			{
				return back()->withInput()->withErrors(['error' => $data['AwbNo'] .'POD NUMBER ALREADY SCANNED...']);
			}
			
			
			
			ScanInPodModel::create($data);
			
			DB::update('UPDATE AWBMASTER SET 
						STATUS = ?,
						RouteDate = ?
						WHERE AWBNO = ?',
						['SCAN IN',$data['ScanIndt'],$data['AwbNo']]);
						
			$PodSlNo = 1;
			$result1 = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['AwbNo']]);
			
			foreach($result1 as $key => $v)
			{
				$PodSlNo = $v->PodSlNo;
			}
			
			$data1['PodSlNo'] = $PodSlNo;
			$data1['AwbNo'] = $data['AwbNo'];
			$data1['HistDate'] = $data['ScanIndt'];
			$data1['HistStatus'] = 'SCAN IN';
			$data1['CreatedBy'] = Auth::user()->name;
			$data1['CreatedOn'] = $created_at;
			
			AwbMasterHistModel::create($data1);
			
			return redirect()->route('ScanInPod.TranMenu.create')->with('success','Record successfully Saved..');
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
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName','scanin')
		->FindOrFail($id);
		
		return view('ScanInPod.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$franchisee = FranchiseeModel::pluck('name','id')->all();
		
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName','scanin')
		->has('scanin')
		->FindOrFail($id);
		
		$customername = isset($result->CustomerName) ? $result->CustomerName : '';
		$prevpodno = isset($result->AwbNo) ? $result->AwbNo : '';
		$prevfranid = isset($result->FranID) ? $result->FranID : '';
		
		return view('ScanInPod.edit',compact('result','franchisee',	'customername','prevpodno','prevfranid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScanInPodFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = ScanInPodModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('ScanInPod.TranMenu.index')->with('success','Record successfully Updated...');
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
			$result = ScanInPodModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('ScanInPod.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
