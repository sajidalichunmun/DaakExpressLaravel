<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\AssignedSeriesFormRequest;
use App\Models\AssignedSeriesModel;
use App\Models\SeriesModel;

class AssignedSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = AssignedSeriesModel::with('Creator','Series')->paginate(25);
		
        return view('AssignedSeries.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = AssignedSeriesModel::with('Creator','Series')
            ->join('users','userseriesmaster.userid','users.id')
            ->where('name','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('AssignedSeries.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $creator = User::pluck('Name','id')->all();
        $series  = SeriesModel::where('isactive','=','YES')->pluck('Prefix','id')->all();
		
        return view('AssignedSeries.create',compact('creator','series'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignedSeriesFormRequest $request)
    {
		try
		{
			$data = $request->getData();

			
			$result = DB::select('select U.ID from Users u
				 INNER JOIN UserSeriesMaster USM ON U.ID=USM.UserID
				 INNER JOIN SeriesMaster SM ON USM.SeriesID=SM.ID
				 where u.ID = ?  and USM.ISACTIVE = ?',[$data['UserID'],'YES']);
			if($result)
			{
				return back()->withInput()->withErrors(['error' => 'Record Already Exists in system']);
			}
			
			$result = DB::select('select *from seriesmaster where ID = ?',[$data['SeriesID']]);
			if($result)
			{
				foreach($result as $key => $row)
				{
					$AllocatedSeries = $row->AllocatedSeries;
                    $AllocationQty = $row->AllocationQty;
                    $length = $row->Length;
                    $prefix = $row->Prefix;
				}
					
				$balance = $AllocationQty - ($AllocatedSeries + $data['SeriesTo']);
				
			}
			else
			{
				return back()->withInput()->withErrors(['error' => 'Record Already Exists in system']);
			}
			
			if($balance<=0)
			{
				return back()->withInput()->withErrors(['error' => 'No Balance Series for Allocation!!!!']);
			}
			
			$SeriesToTotal=($data['SeriesTo'] + $AllocatedSeries);
            $length1 = $length - (strlen($SeriesToTotal));
            $series = str_pad($prefix, $length1, '0', STR_PAD_RIGHT) . $SeriesToTotal;
			
			$data['SeriesTo'] = $series;
			$data['CurrentNo'] = $data['SeriesFrom'];
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			AssignedSeriesModel::create($data);
			
			return redirect()->route('AssignedSeries.Mast.index')->with('success','Record successfully Saved..');
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
        $result = AssignedSeriesModel::with('Creator','Series')->FindOrFail($id);
		
		return view('AssignedSeries.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$creator = User::pluck('Name','id')->all();
		$series  = SeriesModel::where('isactive','=','YES')->pluck('Prefix','id')->all();
		
        $result = AssignedSeriesModel::with('Creator','Series')->FindOrFail($id);
		
		return view('AssignedSeries.edit',compact('result','creator','series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignedSeriesFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = AssignedSeriesModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('AssignedSeries.Mast.index')->with('success','Record successfully Updated...');
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
			$result = AssignedSeriesModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('AssignedSeries.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
