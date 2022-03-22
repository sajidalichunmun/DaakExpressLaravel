<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\FranchiseeRateFormRequest;
use App\Models\FranchiseeRateModel;
use App\Models\FranchiseeModel;

class FranchiseeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = FranchiseeRateModel::with('Franchisee')->paginate(25);
		
        return view('FranchiseeRate.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = FranchiseeRateModel::with('Franchisee')
            ->join('franchiseemaster','franchiseerate.FranID','franchiseemaster.id')
            ->where('franchiseemaster.name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('FranchiseeRate.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franchisee = FranchiseeModel::pluck('Name','id')->all();
        
        return view('FranchiseeRate.create',compact('franchisee'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FranchiseeRateFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			FranchiseeRateModel::create($data);
			
			return redirect()->route('FranchiseeRate.Mast.index')->with('success','Record successfully Saved..');
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
        $result = FranchiseeRateModel::with('Franchisee')->FindOrFail($id);
		
		return view('FranchiseeRate.show',compact('result'));
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
		
        $result = FranchiseeRateModel::with('Franchisee')->FindOrFail($id);
		
		return view('FranchiseeRate.edit',compact('result','franchisee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FranchiseeRateFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = FranchiseeRateModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('FranchiseeRate.Mast.index')->with('success','Record successfully Updated...');
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
			$result = FranchiseeRateModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('FranchiseeRate.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
