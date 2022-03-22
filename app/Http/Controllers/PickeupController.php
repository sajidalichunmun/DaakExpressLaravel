<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\PickeupFormRequest;
use App\Models\PickeupModel;
use App\Models\ClientCodeModel;
use App\Models\BranchModel;

class PickeupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = PickeupModel::with('Client','BranchName')->paginate(25);
		
        return view('Pickeup.index',compact('result'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = PickeupModel::with('Client','BranchName')
          ->join('clientcodemaster','pickupdetails.ClientID','clientcodemaster.id')
          ->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('Pickeup.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = ClientCodeModel::pluck('Name','id')->all();
        $branch = BranchModel::pluck('Name','id')->all();
		
        return view('Pickeup.create',compact('client','branch'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PickeupFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			PickeupModel::create($data);
			
			return redirect()->route('Pickeup.Mast.index')->with('success','Record successfully Saved..');
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
        $result = PickeupModel::with('Client','BranchName')->FindOrFail($id);
		
		return view('Pickeup.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$client = ClientCodeModel::pluck('Name','id')->all();
        $branch = BranchModel::pluck('Name','id')->all();
		
        $result = PickeupModel::with('Client','BranchName')->FindOrFail($id);
		
		return view('Pickeup.edit',compact('result','client','branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PickeupFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = PickeupModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('Pickeup.Mast.index')->with('success','Record successfully Updated...');
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
			$result = PickeupModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('Pickeup.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
