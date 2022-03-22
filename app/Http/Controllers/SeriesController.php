<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\SeriesFormRequest;
use App\Models\SeriesModel;
use App\Models\BranchModel;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = SeriesModel::with('BranchName')->paginate(25);
		
        return view('Series.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = SeriesModel::with('BranchName')
            ->join('branchmaster','seriesmaster.BranchID','branchmaster.id')
            ->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('Series.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = BranchModel::pluck('Name','id')->all();
        
        return view('Series.create',compact('branch'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesFormRequest $request)
    {
		try
		{
			$data = $request->getData();
						
			$result = DB::select('select *from SeriesMaster
			where Prefix = ?',[$data['Prefix']]);
			/*
			$result = DB::select('select *from SeriesMaster
			where Prefix = ? AND BranchID = ?',[$data['Prefix'],$data['BranchID']]);
			*/
			if($result)
			{
				return back()->withInput()->withErrors(['error_message' => 'Record Already Exists in system']);
			}
			
			$data['AllocationQty'] = $data['SeriesTo'];
			$data['AllocatedSeries'] = $data['SeriesFrom'];
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = "YES";
			
			SeriesModel::create($data);
			
			return redirect()->route('Series.Mast.index')->with('success','Record successfully Saved..');
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
        $result = SeriesModel::with('BranchName')->FindOrFail($id);
		
		return view('Series.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$branch = BranchModel::pluck('Name','id')->all();
		
        $result = SeriesModel::with('BranchName')->FindOrFail($id);
		
		return view('Series.edit',compact('result','branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeriesFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = SeriesModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('Series.Mast.index')->with('success','Record successfully Updated...');
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
			$result = SeriesModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('Series.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
