<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\ManifestMannualFormRequest;
use App\Models\ManifestMannualModel;
use App\Models\FranchiseeModel;
use App\Models\AwbMasterModel;
use App\Models\AwbMasterHistModel;

class ManifestMannualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')
		->where('Status','=','MANIFEST')->wherenotnull('FranID')->paginate(25);
		
        return view('ManifestMannual.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->where('Status','=','MANIFEST')->wherenotnull('FranID')->where('AwbNo','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('ManifestMannual.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franchisee = FranchiseeModel::pluck('name','id')->all();
		
		//$result = AwbMasterModel::pluck('AwbNo','CustomerName','FranID')->wherenotnull('FranID')->where('CreatedBy','=',Auth::user()->name);
		
		$result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')
		->wherenotnull('FranID')
		->where('CreatedBy','=',Auth::user()->name)->orderBy('id', 'DESC')->limit(1)->first();;
		
		//$result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')
		//->where('AwbNo','=','CIBOM0126232')
		//->wherenotnull('FranID')->paginate(25);
		
		$customername = isset($result->CustomerName) ? $result->CustomerName : '';
		$prevpodno = isset($result->AwbNo) ? $result->AwbNo : '';
		$prevfranid = isset($result->FranID) ? $result->FranID : '';
		
		
        return view('ManifestMannual.create',compact('franchisee','customername','prevpodno','prevfranid'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManifestMannualFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			$result = DB::select('SELECT AwbNo,CustomerName
					FROM AWBMASTER
					WHERE AWBNO = ?',[$data['AwbNo']]);
					
			if(!$result)
			{
				return back()->withInput()->withErrors(['error' => 'Pod No not exists in system.']);
			}
			
			$result = DB::select('SELECT AwbNo,CustomerName
					FROM AWBMASTER
					WHERE AWBNO = ? AND FRANID IS NOT NULL',[$data['AwbNo']]);
			if($result)
			{
				return back()->withInput()->withErrors(['error' => 'Already Manifest POD']);
			}
			
			DB::update('UPDATE AWBMASTER SET
				FRANID = ?,
				Status = ?,
				RouteDate = ?
				WHERE AWBNO = ?',
				[$data['FranID'],'MANIFEST',$data['scandate'],$data['AwbNo']]);
			
			$PodSlNo = 1;
			$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['AwbNo']]);
			
			foreach($result as $key => $row)
			{
				$PodSlNo = $row->PodSlNo;
			}
			
			$data1['PodSlNo'] = $PodSlNo;
			$data1['AwbNo'] = $data['AwbNo'];
			$data1['HistDate'] = $data['scandate'];
			$data1['HistStatus'] = 'MANIFEST';
			$data1['CreatedBy'] = Auth::user()->name;
			$data1['CreatedOn'] = $created_at;
			
			AwbMasterHistModel::create($data1);
			
			return redirect()->route('ManifestMannual.TranMenu.create')->with('success','Record successfully Saved..');
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
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')
		->where('Status','=','MANIFEST')->wherenotnull('FranID')->FindOrFail($id);
		
		return view('ManifestMannual.show',compact('result'));
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
		
		$customername = isset($result->CustomerName) ? $result->CustomerName : '';
		$prevpodno = isset($result->AwbNo) ? $result->AwbNo : '';
		$prevfranid = isset($result->FranID) ? $result->FranID : '';
		
		return view('ManifestMannual.edit',compact('result','franchisee','customername','prevpodno','prevfranid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManifestMannualFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			//$result = ManifestMannualModel::FindOrFail($id);
			
			//$result->update($data);
			
			DB::update('UPDATE AWBMASTER SET
				FRANID = ?,
				Status = ?,
				RouteDate = ?
				WHERE AWBNO = ?',
				[$data['FranID'],'MANIFEST',$data['scandate'],$data['AwbNo']]);
			
			return redirect()->route('ManifestMannual.TranMenu.index')->with('success','Record successfully Updated...');
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
			//$result = ManifestMannualModel::findorfail($id);
			
			//$result->delete();
			
			DB::delete('DELETE FROM AwbMaster_Hist
				WHERE AWBNO = ?',[$id]);
			
			DB::update('UPDATE AWBMASTER SET
				FRANID = null,
				Status = ?,
				RouteDate = null
				WHERE AWBNO = ?',
				['Pending',$data['AwbNo']]);
							
			return redirect()->route('ManifestMannual.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
