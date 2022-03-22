<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\ClientCodeFormRequest;
use App\Models\ClientCodeModel;
use App\Models\MajorCodeModel;
use App\Models\PacketTypeModel;

class ClientCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $find = '';
        $result = ClientCodeModel::with('MajorResult','PacketResult')->paginate(25);
		
				
        return view('ClientCode.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
        $find = $request->txtSearchID;
        $result = ClientCodeModel::where('name','like' , $request->txtSearchID .'%')->
		with('MajorResult','PacketResult')->paginate(25);
		
        return view('ClientCode.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MajorCode = MajorCodeModel::pluck('Name','id')->all();
		$PacketType = ClientCodeModel::pluck('Name','id')->all();
        
        return view('ClientCode.create',compact('MajorCode','PacketType'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCodeFormRequest $request)
    {
		try
		{
			$data = $request->getData();
			
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			$data['IsActive'] = 'YES';
			
			ClientCodeModel::create($data);
			
			return redirect()->route('ClientCode.Mast.index')->with('success','Record successfully Saved..');
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
        $result = ClientCodeModel::with('MajorResult','PacketResult')->FindOrFail($id);
		
		
		return view('ClientCode.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$MajorCode = MajorCodeModel::pluck('Name','id')->all();
		$PacketType = PacketTypeModel::pluck('Name','id')->all();
		
        $result = ClientCodeModel::FindOrFail($id);
		
		return view('ClientCode.edit',compact('result','MajorCode','PacketType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientCodeFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = ClientCodeModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('ClientCode.Mast.index')->with('success','Record successfully Updated...');
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
			$result = ClientCodeModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('ClientCode.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
	
	public function getMajorNameList(Request $request)
    {
		/*$states = DB::select('select m.id,m.name from clientmajormaster m
			inner join clientcodemaster c on c.ClientMajorID=m.id
			WHERE C.id = ?',[$request->ClientID]);
			*/
		$states = DB::table('clientmajormaster')
		->join('clientcodemaster','clientcodemaster.ClientMajorID','=','clientmajormaster.id')
			->where('clientcodemaster.id','=',$request->ClientID)
			->pluck('clientmajormaster.id','clientmajormaster.name');
			//->get();
			
		//$states = ClientCodeModel::with('MajorResult')
		//->findorfail($request->ClientID);
		
		
        return response()->json($states);
    }
}
