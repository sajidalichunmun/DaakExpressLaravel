<?php

namespace App\Repositories;

use App\Models\CityModel;
use App\Interfaces\IBusinessLogic;
use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;

class CityBusinessLogic implements IBusinessLogic
{
    public $successStatus = 200;
    public $msg = 'Record successfully ';
    public $notFound = 'Record not found';
    private $Model;

    public function __construct(CityModel $model)
    {
        $this->Model = $model;
    }

    public function list()
    {
        $result = $this->Model::with('State')->latest('id')->get();//paginate(25);
        if(is_null($result))
        {
            return response()->JSON(['status' => 'success', 'message' => $this->notFound],404);
        }
        return response()->JSON(['status' => 'success', 'message' => 'success', 'data' => $result],$this->successStatus);
    }

    public function show($id)
    {
        $result = $this->Model::Find($id);
        if(is_null($result))
        {
            return response()->JSON(['status' => 'success', 'message' => $this->notFound],404);
        }
        return response()->JSON(['status' => 'success', 'message' => 'success', 'data' => $result],$this->successStatus);
    }

    public function store($request)
    {
        try{
            
            $request->validate([
                'name' => 'required|unique:PacketStatus|max:100'
            ]);
            
            $data['Name'] = $request['name'];
            $data['StateID'] = $request->stateid;

            $data['CreatedBy'] = Auth::user()->name;
                        
            $curTime = new \DateTime();
            $created_at = $curTime->format("Y-m-d H:i:s");
            $data['CreatedOn'] = $created_at;
            $data['IsActive'] = 'YES';

            $result = $this->Model::create($data);
            if($result)
                return response()->json(['status' => 'success' ,'message' => $this->msg. 'Saved..', 'data' => $result],$this->successStatus);
            else
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
            $data['StateID'] = $request->stateid;
            
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