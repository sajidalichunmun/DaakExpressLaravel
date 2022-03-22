<?php

namespace App\Repositories;
use App\Interfaces\IBusinessLogic;
use App\Models\AwbMasterModel;

class BusinessLogic implements IBusinessLogic //, Responsable, Htmlable
{
    private $Model;
    public function __construct(AwbMasterModel $model)
    {
        $this->Model = $model;
    }
    public function list()
    {
        $result = $this->Model::all();
        if(is_null($result))
        {
            return response()->JSON(["message"=>"Record not found"],404);
        }
        return response()->JSON(['message' => 'success', 'data' => $result],200);
    }
    public function show($id)
    {
        $result = $this->Model::Find($id);
        if(is_null($result))
        {
            return response()->JSON(["message"=>"Record not found"],404);
        }
        return response()->JSON(['message' => 'success', 'data' => $result],200);
    }
    public function store($request)
    {
        try{

            $validate = $request->validate([
                'name' => 'required|unique:PacketStatus|max:100'
            ]);
            if(!$validate){
                return response()->json(['message' => $validate->error],404);
            }

            $data = $request->getData();
            $data['CreatedBy'] = Auth::user()->name;
                        
            $curTime = new \DateTime();
            $created_at = $curTime->format("Y-m-d H:i:s");
            $data['CreatedOn'] = $created_at;
            $data['IsActive'] = 'YES';

            $result = $this->Model::create($request->all());
            
            return response()->json(['status' => 'success' ,'message' => 'Record successfully Saved..', 'data' => $result],201);
        }catch(\Exception $ex){
            return response()->json(['message' => $ex->getMessage()],404);
        }
    }
    public function edit($id)
    {
        $result = $this->Model::Find($id);
        if(is_null($result))
        {
            return response()->json(["message" => "Record not found"],404);
        }
        return response()->json(['message' => 'success', 'data' => $result],200);
    }
    public function update($request, $id)
    {
        $result = $this->Model::find($id);
        if(is_null(result))
        {
            return response()->json([ "message" => "Record not found" ],404);
        }
        $result->update($request->all());
        return response()->json(['message' => 'success', 'data' => $result],200);
    }
    public function delete($id)
    {
        $result = $this->Model::find($id);
        if(is_null(result))
        {
            return response()->json([ "message" => "Record not found" ],404);
        }
        $result->delete();
        return response()->json([null],204); // no content
    }
}