<?php

namespace App\Repositories;

use App\Interfaces\IBusinessLogic;
use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Models\MajorCodeModel;

class MajorCodeBusinessLogic implements IBusinessLogic
{
    public $successStatus = 200;
    public $msg = 'Record successfully ';
    public $notFound = 'Record not found';
    private $Model;

    public function __construct(MajorCodeModel $model)
    {
        $this->Model = $model;
    }

    public function list()
    {
        $result = $this->Model::latest('id')->get();//paginate(25);
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
                'name' => 'required|unique:clientmajormaster|max:100'
            ]);
            
            $data['MajorCode'] = $request->majorcode;
            $data['Name'] = $request->name;
            $data['MobileNo'] = $request->mobileno;
            $data['Address1'] = $request->address1;
            $data['Address2'] = $request->address2;
            $data['Description'] = $request->description;

            $data['CreatedBy'] = Auth::user()->name;
                        
            $curTime = new \DateTime();
            $created_at = $curTime->format("Y-m-d H:i:s");
            $data['CreatedOn'] = $created_at;
            $data['IsActive'] = 'YES';

            $result = $this->Model::create($data);
            if($result)
                return response()->json(['curd_option' => 'save', 'status' => 'success' ,'message' => $this->msg. 'Saved..', 'data' => $result],$this->successStatus);
            else
                return response()->json(['curd_option' => 'save error','status' => 'success' ,'message' => 'Some error Save', 'data' => null],404);
        }catch(\Exception $ex){
            return response()->json(['curd_option' => 'save excpttion','option' => 'error','message' => $ex->getMessage()],404);
        }
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
                return response()->json(['curd_option' => 'checking update','status' => 'success', 'message' => $this->notFound ],404);
            }
                
            $data['MajorCode'] = $request->majorcode;
            $data['Name'] = $request->name;
            $data['MobileNo'] = $request->mobileno;
            $data['Address1'] = $request->address1;
            $data['Address2'] = $request->address2;
            $data['Description'] = $request->description;
            
            $data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;

            $result = $this->Model::where('Id',$todo->ID)->update($data);
            
            if($result){
                $todo = $this->Model::find($request->id);
                return response()->json(['curd_option' => 'update','status' => 'success' ,'message' => $this->msg. 'Updated...', 'data' => $todo],201);
            }
            else
                return response()->json(['curd_option' => 'update error','status' => 'success' ,'message' => 'Some error Update', 'data' => null],404);
        }catch(\Exception $ex){
            return response()->json(['curd_option' => 'update exception','option' => 'error','status' => 'error', 'message' => $ex->getMessage()],404);
        }
    }

    public function delete($id)
    {
        try{

            $result = $this->Model::find($id);
            if(is_null($result))
            {
                return response()->json(['curd_option' => 'checking delete','status' => 'success', "message" => $this->notFound ],404);
            }
            
            $deleted = $this->Model::where('id',$result->ID)->delete();

            if ($deleted) 
                return response()->json(['curd_option' => 'delete','status' => 'success' ,'message' => $this->msg. 'Deleted...', 'data' => null],201);
                // return response()->json(['data' => null,'status' => 'success', 'message' => $this->msg. 'Deleted...'],204);
             // no content
             else
                return response()->json(['curd_option' => 'delete error','status' => 'success' ,'message' => 'Some error in deleting... ', 'data' => null],201);
        }catch(\Exception $ex){
            return response()->json(['curd_option' => 'delete exception','status' => 'error', 'message' => $ex->getMessage()],404);
        }
    }
}