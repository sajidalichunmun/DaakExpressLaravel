<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\CityFormRequest;
use App\Models\CityModel;
use App\Models\StateModel;
use App\Models\CountryModel;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = CityModel::with('State')->paginate(25);
		// $users = DB::table('City')
        //         ->whereJsonContains('options->languages', ['en', 'de'])
        //         ->get();
        return view('City.index',compact('result','find'));
    }
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = CityModel::with('State')->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('City.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $State = StateModel::pluck('Name','id')->all();
		$Country = CountryModel::pluck('Name','id')->all();
        
        return view('City.create',compact('State','Country'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			CityModel::create($data);
			
			return redirect()->route('City.Mast.index')->with('success','Record successfully Saved..');
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
        $result = CityModel::with('State')->FindOrFail($id);
			
		return view('City.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $State = StateModel::pluck('Name','id')->all();
		$Country = CountryModel::pluck('Name','id')->all();
		
		$result = CityModel::with('State')->FindOrFail($id);
		
		return view('City.edit',compact('result','State','Country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = CityModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('City.Mast.index')->with('success','Record successfully Updated...');
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
			$result = CityModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('City.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
	
	public function getStateList(Request $request)
    {
		/*
        $states = DB::table("StateMaster")
                    ->where("CountryID",$request->CountryID)
                    ->lists("name","id");
					*/
		
		/*
        $states = DB::table("StateMaster")
                    ->where("CountryID",$request->CountryID)
                    ->pluck("name","id");
					*/
					
		$states = StateModel::where('CountryID','=',$request->CountryID)->pluck('name','id');
		
		
        return response()->json($states);
    }
	
    public function getCityList(Request $request)
    {
        $cities = DB::table("CityMaster")
                    ->where("StateID",$request->StateID)
                    ->pluck("name","id");
        return response()->json($cities);
    }
	
}
