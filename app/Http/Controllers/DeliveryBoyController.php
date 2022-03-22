<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\DeliveryBoyFormRequest;
use App\Models\DeliveryBoyModel;
use App\Models\FranchiseeModel;

class DeliveryBoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = DeliveryBoyModel::with('Franchisee','Creator')->paginate(25);
		
        return view('DeliveryBoy.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = DeliveryBoyModel::with('Franchisee','Creator')->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('DeliveryBoy.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franchisee = FranchiseeModel::pluck('Name','id')->all();
        $creator = User::pluck('Name','id')->all();
		
        return view('DeliveryBoy.create',compact('franchisee','creator'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryBoyFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			DeliveryBoyModel::create($data);
			
			return redirect()->route('DeliveryBoy.Mast.index')->with('success','Record successfully Saved..');
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
        $result = DeliveryBoyModel::with('Franchisee','Creator')->FindOrFail($id);
		
		return view('DeliveryBoy.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$franchisee = FranchiseeModel::pluck('Name','id')->all();
		$creator = User::pluck('Name','id')->all();
		
        $result = DeliveryBoyModel::with('Franchisee','Creator')->FindOrFail($id);
		
		return view('DeliveryBoy.edit',compact('result','franchisee','creator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryBoyFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
						
			$result = DeliveryBoyModel::FindOrFail($id);
									
			$result->update($data);
			
			return redirect()->route('DeliveryBoy.Mast.index')->with('success','Record successfully Updated...');
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
			$result = DeliveryBoyModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('DeliveryBoy.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
