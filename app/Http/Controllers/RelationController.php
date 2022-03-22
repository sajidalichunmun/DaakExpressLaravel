<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\RelationFormRequest;
use App\Models\RelationModel;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = RelationModel::paginate(25);
		
        return view('Relation.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = RelationModel::where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('Relation.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$result = RelationModel::pluck('Relation','id')->all();
        
        return view('Relation.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelationFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			RelationModel::create($data);
			
			return redirect()->route('Relation.Mast.index')->with('success','Record successfully Saved..');
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
        $result = RelationModel::FindOrFail($id);
		
		return view('Relation.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = RelationModel::FindOrFail($id);
		
		return view('Relation.edit',compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RelationFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = RelationModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('Relation.Mast.index')->with('success','Record successfully Updated...');
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
			$result = RelationModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('Relation.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
