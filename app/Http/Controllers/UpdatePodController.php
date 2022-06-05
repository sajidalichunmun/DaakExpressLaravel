<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\UpdatePodFormRequest;
use App\Models\UpdatePodModel;
use App\Models\FranchiseeModel;
use App\Models\ReasonModel;
use App\Models\PacketStatusModel;
use App\Models\RelationModel;
use App\Models\AwbMasterModel;
use App\Models\AwbMasterHistModel;
use App\Models\pendingMasterModel;
use App\Models\DeliveryModel;
use App\Models\RTOModel;

class UpdatePodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->wherenotnull('FranID')->paginate(25);
		
        return view('UpdatePod.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->wherenotnull('FranID')
				->where('AwbNo','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('UpdatePod.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reason = ReasonModel::pluck('name','id')->all();
        $franchisee = FranchiseeModel::pluck('name','id')->all();
		$relation = RelationModel::pluck('name','id')->all();
		$status = PacketStatusModel::pluck('name','id')->all();
		
		$result = AwbMasterModel::wherenotnull('FranID')->where('CreatedBy','=',Auth::user()->name)->orderBy('id', 'DESC')->limit(1)->first();;
		
		$customername = isset($result->CustomerName) ? $result->CustomerName : '';
		$prevpodno = isset($result->AwbNo) ? $result->AwbNo : '';
		$prevfranid = isset($result->FranID) ? $result->FranID : '';
		
        return view('UpdatePod.create',compact('reason','franchisee','relation','status','customername','prevpodno','prevfranid'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdatePodFormRequest $request)
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
			
			$result = DB::select('SELECT AwbNo FROM DELIVERY
					WHERE AWBNO = ?',[$data['AwbNo']]);
			if($result)
			{
				return back()->withInput()->withErrors(['error' => 'Pod No '. $data['AwbNo'] .' Already Scan POD !!']);
			}
			
			$result = DB::select('SELECT AwbNo,CustomerName
					FROM AWBMASTER
					WHERE AWBNO = ? AND FRANID = ?',[$data['AwbNo'],$data['FranID']]);
			if(!$result)
			{
				return back()->withInput()->withErrors(['error' => $data['AwbNo']. ' not belong to selectd Franchisee']);
			}
			
			$packetstatus = PacketStatusModel::where('id',$data['status'])->pluck('name');
			DB::update('UPDATE AWBMASTER SET
				Status = ?,
				RouteDate = ?
				WHERE AWBNO = ?',
				[$packetstatus[0],$data['scandate'],$data['AwbNo']]);
			
			$PodSlNo = 1;
			$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['AwbNo']]);
			
			foreach($result as $key => $row)
			{
				$PodSlNo = $row->PodSlNo;
			}
			
			$data1['PodSlNo'] = $PodSlNo;
			$data1['AwbNo'] = $data['AwbNo'];
			$data1['HistDate'] = $data['scandate'];
			$data1['HistStatus'] = $data['status'];
			$data1['HistStatus'] = $packetstatus[0];
			$data1['CreatedBy'] = Auth::user()->name;
			$data1['CreatedOn'] = $created_at;
			
			AwbMasterHistModel::create($data1);
			
			if($data['status'] === '1')   //DELIVERY
			{
				$data2['AwbNo'] = $data['AwbNo'];
				$data2['StatusID'] = $data['status'];
				$data2['dlvdt'] = $data['scandate'];
				$data2['RecName'] = $data['RecName'];
				$data2['RelationID'] = $data['Relation'];
				$data2['DPhoneNo'] = $data['PhoneNo'];
				$data2['CreatedBy'] = Auth::user()->name;
				$data2['CreatedOn'] = $created_at;
				$data['dlvoption'] = 'Mannual Delivered';
				
				DeliveryModel::create($data2);
			}
			else if($data['status'] === '2') //PENDING PACKETS
			{
				$data2['AwbNo'] = $data['AwbNo'];
				$data2['StatusID'] = $data['status'];
				$data2['pnddt'] = $data['scandate'];
				$data2['CreatedBy'] = Auth::user()->name;
				$data2['CreatedOn'] = $created_at;
				
				pendingMasterModel::create($data2);
			}
			else if($data['status'] === '3') // RTO PACKETS
			{
				$data2['AwbNo'] = $data['AwbNo'];
				$data2['StatusID'] = $data['status'];
				$data2['RTODT'] = $data['scandate'];
				$data2['ReasonID'] = $data['Reason'];
				$data2['CreatedBy'] = Auth::user()->name;
				$data2['CreatedOn'] = $created_at;
				
				RTOModel::create($data2);
			}
			else
			{
				
			}
			return redirect()->route('UpdatePod.TranMenu.create')->with('success','Record successfully Saved..');
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
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->FindOrFail($id);
		
		return view('UpdatePod.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->FindOrFail($id);
		
		$reason = ReasonModel::pluck('name','id')->all();
        $franchisee = FranchiseeModel::pluck('name','id')->all();
		$relation = RelationModel::pluck('name','id')->all();
		$status = PacketStatusModel::pluck('name','id')->all();
		
		
		return view('UpdatePod.edit',compact('result','reason','franchisee','relation','status','customername','prevpodno','prevfranid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePodFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = UpdatePodModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('UpdatePod.TranMenu.index')->with('success','Record successfully Updated...');
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
			
			$result = UpdatePodModel::findorfail($id);
			
			$result->delete();
			
			
			
			return redirect()->route('UpdatePod.TranMenu.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
