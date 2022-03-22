<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\CountryFormRequest;
use App\Models\CountryModel;
use App\Repositories\CountryBusinessLogic;

class CountryController extends Controller
{
    private $logic;
    public function __construct(CountryBusinessLogic  $logic)
    {
        $this->logic = $logic;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = CountryModel::paginate(25);
		// $json = $this->logic->list();
        // $dummy = new \App\Models\CountryModel;
        // $collection = collect(($json->getData()->data->data));
        // $result = $dummy->newInstance($collection, true);
        // dd($result);
        return view('Country.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = CountryModel::where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('Country.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$result = CountryModel::pluck('Country','id')->all();
        
        return view('Country.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			CountryModel::create($data);
			
			return redirect()->route('Country.Mast.index')->with('success','Record successfully Saved..');
		}
		catch(Exception $ex)
		{
            return back()->with('success_message',  $ex->getMessage());
            return back()->with('status',  $ex->getMessage());
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
        $result = CountryModel::FindOrFail($id);
		
		return view('Country.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = CountryModel::FindOrFail($id);
		
		return view('Country.edit',compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = CountryModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('Country.Mast.index')->with('success','Record successfully Updated...');
		}
		catch(Exception $ex)
		{
            return back()->with('success_message',  $ex->getMessage());
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
			$result = CountryModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('Country.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
            return back()->with('success_message',  $ex->getMessage());
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
	
	public function getStateList(Request $request)
    {
        $states = DB::table("StateMaster")
                    ->where("CountryID",$request->country_id)
                    ->lists("name","id");
        return response()->json($states);
    }
	
    public function getCityList(Request $request)
    {
        $cities = DB::table("CityMaster")
                    ->where("StateID",$request->state_id)
                    ->lists("name","id");
        return response()->json($cities);
    }
}
