<?php

namespace App\Repositories;

use App\Models\AwbMasterModel;
use App\Models\DeliveryModel;
use App\Models\RTOModel;
use App\Models\pendingMasterModel;
use App\Interfaces\IBusinessLogic;
use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;

class DeliveryBusinessLogic implements IBusinessLogic
{
    public $successStatus = 200;
    public $msg = 'Record successfully ';
    public $notFound = 'Record not found';
    public $Found = ' already exists';
    private $DeliveryModel,$RtoModel,$PendingModel,$PodModel;

    public function __construct(AwbMasterModel $podModel,DeliveryModel $deliveryModel,RTOModel $rtoModel,pendingMasterModel $pendingModel)
    {
        $this->PodModel = $podModel;
        $this->PendingModel =$pendingModel;
        $this->RtoModel = $rtoModel;
        $this->DeliveryModel = $deliveryModel;
    }

    public function list()
    {
        $result = $this->DeliveryModel::paginate(25);
        if(is_null($result))
        {
            return response()->JSON(['curd_option' => 'checking list','status' => 'success', 'message' => $this->notFound],404);
        }
        return response()->JSON(['curd_option' => 'list','status' => 'success', 'message' => 'success', 'data' => $result],$this->successStatus);
    }

    public function show($id)
    {
        $result = $this->DeliveryModel::Find($id);
        if(is_null($result))
        {
            return response()->JSON(['curd_option' => 'checking list','status' => 'success', 'message' => $this->notFound],404);
        }
        return response()->JSON(['curd_option' => 'list','status' => 'success', 'message' => 'success', 'data' => $result],$this->successStatus);
    }

    public function store($request)
    {
        try{
            
            $request->validate([
                'name' => 'required|unique:PacketStatus|max:100'
            ]);
            
            $data['AwbNo'] = $request['AwbNo'];
            $data['status'] = $request['status'];
            $data['scandate'] = $request['scandate'];
            $data['FranID'] = $request['FranID']; 

            $data['CreatedBy'] = Auth::user()->name;
                        
            $curTime = new \DateTime();
            $created_at = $curTime->format("Y-m-d H:i:s");
            $data['CreatedOn'] = $created_at;
            $data['IsActive'] = 'YES';

            $result = $this->PodModel->where('AwbNo',$data['AwbNo'])->first();
            if(is_null($result))
            {
                return response()->JSON(['status' => 'success', 'message' => $this->notFound],404);
            }
			if($result->FranID !== $data['FranID'])
            {
                return response()->JSON(['status' => 'success', 'message' => $data['AwbNo']. ' not belong to selectd Franchisee'],404);
			}

			$result = $this->deliveryModel->where('AwbNo',$data['AwbNo'])->first();
            if(!is_null($result))
            {
                return response()->JSON(['status' => 'success', 'message' => 'Pod No '. $data['AwbNo'] . $this->Found],404);
            }
			
			
			DB::update('UPDATE AWBMASTER SET
				Status = ?,
				RouteDate = ?
				WHERE AWBNO = ?',
				[$data['status'],$data['scandate'],$data['AwbNo']]);
			
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
				
				$result = $this->deliveryModel::create($data2);
			}
			else if($data['status'] === '2') //PENDING PACKETS
			{
				$data2['AwbNo'] = $data['AwbNo'];
				$data2['StatusID'] = $data['status'];
				$data2['pnddt'] = $data['scandate'];
				$data2['CreatedBy'] = Auth::user()->name;
				$data2['CreatedOn'] = $created_at;
				
				$result = $this->PendingModel::create($data2);
			}
			else if($data['status'] === '3') // RTO PACKETS
			{
				$data2['AwbNo'] = $data['AwbNo'];
				$data2['StatusID'] = $data['status'];
				$data2['RTODT'] = $data['scandate'];
				$data2['ReasonID'] = $data['Reason'];
				$data2['CreatedBy'] = Auth::user()->name;
				$data2['CreatedOn'] = $created_at;
				
				$result = $this->RtoModel::create($data2);
			}
			else
			{
				
			}

            
            if($result){
                if($data['status'] === '1')
                {
                    $response = $sms->MobileSms($data['phoneno']);
                }

                return response()->json(['status' => 'success' ,'message' => $this->msg. 'Saved..', 'data' => $result],$this->successStatus);
            }else
                return response()->json(['status' => 'success' ,'message' => 'Some error Save', 'data' => null],404);
        }catch(\Exception $ex){
            return response()->json(['message' => $ex->getMessage()],404);
        }
    }
    
    public function edit($id)
    {
        $result = $this->Model::Find($id);
        if(is_null($result))
        {
            return response()->json(['status' => 'success', 'message' => $this->notFound],404);
        }
        return response()->json(['status' => 'success', 'message' => 'success', 'data' => $result],$this->successStatus);
    }

    public function update($request, $id)
    {
        try{
            
            $data = $request->validate([
                'name' => 'required|max:100'
            ]);
            
            $todo = $this->Model::find($request->id);
            if(is_null($todo))
            {
                return response()->json(['status' => 'success', 'message' => $this->notFound ],404);
            }
                
            $data['Name'] = $request->name;
            $data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;

            $result = $this->Model::where('Id',$todo->ID)->update($data);
            
            if($result)
                return response()->json(['status' => 'success' ,'message' => $this->msg. 'Updated...', 'data' => $todo],201);
            else
                return response()->json(['status' => 'success' ,'message' => 'Some error Update', 'data' => null],404);
        }catch(\Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()],404);
        }
    }

    public function delete($id)
    {
        try{

            $result = $this->Model::find($id);
            if(is_null($result))
            {
                return response()->json(['status' => 'success', "message" => $this->notFound ],404);
            }
            
            $deleted = $this->Model::where('id',$result->ID)->delete();

            if ($deleted) 
                return response()->json(['status' => 'success' ,'message' => $this->msg. 'Deleted...', 'data' => null],201);
                // return response()->json(['data' => null,'status' => 'success', 'message' => $this->msg. 'Deleted...'],204);
             // no content
             else
                return response()->json(['status' => 'success' ,'message' => 'Some error in deleting... ', 'data' => null],201);
        }catch(\Exception $ex){
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()],404);
        }
    }
}
