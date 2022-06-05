<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\SubAreaFormRequest;
use App\Models\SubAreaModel;
use App\Models\CityModel;
use App\Models\StateModel;
use App\Models\CountryModel;

class SubAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = SubAreaModel::with('City')->paginate(25);
		
        return view('SubArea.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = SubAreaModel::with('City')->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('SubArea.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$City = CityModel::pluck('Name','id')->all();
        $State = StateModel::pluck('Name','id')->all();
		$Country = CountryModel::pluck('Name','id')->all();
        
        return view('SubArea.create',compact('City','State','Country'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubAreaFormRequest $request)
    {
        // $request->validate([
        //     'CityID' => 'required',
        //     'Name' => 'required|max:100',
        //     'MainAreaName' => 'required|max:100',
        //     'Pincode' => 'required|max:10'
        // ]);

        // if(!$validate){
        //     return response()->json(['message' => $validate->error],404);
        // }
		try
		{

			$data = $request->getData();

			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			SubAreaModel::create($data);
			
			return redirect()->route('SubArea.Mast.index')->with('success','Record successfully Saved..');
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
        $result = SubAreaModel::with('City')->FindOrFail($id);
			
		return view('SubArea.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
	{
		$City = CityModel::pluck('Name','id')->all();
        $State = StateModel::pluck('Name','id')->all();
		$Country = CountryModel::pluck('Name','id')->all();
		
		$result = SubAreaModel::with('City')->FindOrFail($id);
		
		return view('SubArea.edit',compact('result','City','State','Country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubAreaFormRequest $request, $id)
    {
        // $validate = $request->validate([
        //     'CityID' => 'required',
        //     'Name' => 'required|max:100',
        //     'MainAreaName' => 'required|max:100',
        //     'Pincode' => 'required|max:10'
        // ]);
        // if(!$validate){
        //     return response()->json(['message' => $validate->error],404);
        // }
		try
		{
           
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = SubAreaModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('SubArea.Mast.index')->with('success','Record successfully Updated...');
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
			$result = SubAreaModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('SubArea.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
