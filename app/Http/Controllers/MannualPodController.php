<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\MannualPodFormRequest;
use App\Models\AwbMasterModel;
use App\Models\AssignedSeriesModel;
use App\Models\AwbMasterHistModel;
use Picqer;

class MannualPodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$find = '';
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->paginate(25);
		
        return view('MannualPod.index',compact('result','find'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(request $request)
    {
		$find = $request->txtSearchID;
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->where('AwbNo','like' , $request->txtSearchID .'%')->paginate(25);
		
        return view('MannualPod.index',compact('result','find'));
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rr = AssignedSeriesModel::where('UserID','=',Auth::user()->id)->pluck('CurrentNo','id')->First();
		$result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->where('CreatedBy','=',Auth::user()->name)->orderBy('id', 'DESC')->limit(1)->first();;
		
        //dd($result);
		
		$prevclientid = '';
		$prevmajorname = '';
		$prevclientname = '';
		$prevpodno = '';
		if( $result != null){
			$prevclientid = $result->ClientCode->id;
			$prevmajorname = $result->ClientCode->MajorResult->Name;
			$prevclientname = $result->ClientCode->Name;
			$prevpodno = $result->AwbNo;
		}
		
        return view('MannualPod.create',compact('rr','prevclientid','prevmajorname','prevclientname','prevpodno'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MannualPodFormRequest $request)
    {
		try
		{
			$result =DB::select('select um.id,UM.SeriesTo,CurrentNo,Length,Prefix,um.SeriesID,
                   CurrentNo,UM.SeriesTo NoOfSeries
                   from seriesmaster SM
                   INNER JOIN userseriesmaster UM ON SM.ID=UM.SeriesID
                   where UM.UserID = ? AND UM.ISACTIVE = ?',[Auth::user()->id,'YES']);

			if($result)
			{
				foreach($result as $key => $row)
				{
					$id = $row->id;
					$SeriesID = $row->SeriesID;
					$SeriesTo = $row->SeriesTo;
					$CurrentNo = $row->CurrentNo;
					$prefix = $row->Prefix;
					$NoOfSeries = str_replace($row->Prefix,'',$row->SeriesTo);
					$length = $row->Length;
					$CurrentPodNo = str_replace($row->Prefix,'',$row->CurrentNo);
				}
                $balance = $NoOfSeries - ($CurrentPodNo + 1);
            }
			else 
			{
				return back()->withInput()->withErrors(['error' => 'No Balance Series for Allocation!!!!']);
			}
			
			if($balance<=0)
			{
				return back()->withInput()->withErrors(['error' => 'No Balance Series for Allocation!!!!']);
			}
			
			$CurrentPodNo = ($CurrentPodNo + 1);
			$length1 = $length - (strlen($CurrentPodNo));

			$series = str_pad($prefix, $length1, '0', STR_PAD_RIGHT) . $CurrentPodNo;
			
						
			$data = $request->getData();
			
			$shipmentno = rand(106890122,100000000);
			$redColor = '255,0,0';
			$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
			
			$barcodes = $generator->getBarcode($shipmentno,
				$generator::TYPE_STANDARD_2_5,2,60);
			
			$jpg_barcode = new Picqer\Barcode\BarcodeGeneratorJPG();
			file_put_contents("barcode/barcode/". $shipmentno .'.jpg',
				 $jpg_barcode->getBarcode($shipmentno,
				$jpg_barcode::TYPE_CODE_128,3,50));

			$data['barcode_src'] = $shipmentno .'.jpg';
			$data['shipmentno'] = $shipmentno;
			$data['awbbarcode'] = $barcodes;
			$data['CreatedBy'] = Auth::user()->name;
			
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['CreatedOn'] = $created_at;
			
			
			AwbMasterModel::create($data);
			
			$PodSlNo = 1;
			$result = DB::select('SELECT CASE WHEN MAX(PodSlNo) IS NULL THEN 1 ELSE MAX(PodSlNo)+1 END as PodSlNo FROM AWBMASTER_HIST WHERE AWBNO = ?',[$data['AwbNo']]);
			
			foreach($result as $key => $row)
			{
				$PodSlNo = $row->PodSlNo;
			}
			
			$data1['PodSlNo'] = $PodSlNo;
			$data1['AwbNo'] = $data['AwbNo'];
			$data1['HistDate'] = $data['PodDate'];
			$data1['HistStatus'] = 'POD ASSIGNED';
			$data1['CreatedBy'] = Auth::user()->name;
			$data1['CreatedOn'] = $created_at;
			
			AwbMasterHistModel::create($data1);
			
			
			if($balance<0)
			{
				$data2['IsActive'] = 'No';
				
				DB::update('UPDATE userseriesmaster SET
				 IsActive = ?,
				 UpdatedBy = ?,
				 UpdatedOn = ?
				 WHERE ID = ?',['YES',Auth::user()->name,$created_at,$id]);
			}
			else
			{
				$data2['CurrentNo'] = $series;
				DB::update('UPDATE userseriesmaster SET
				 CurrentNo = ?
				 WHERE ID = ?',[$series,$id]);
			}
			//$result = AssignedSeriesModel::FindOrFail($id);
			
			//$result->update($data2);
			
			
			
			//return redirect()->route('MannualPod.TranMenu.index')->with('success','Record successfully Saved..');
			return redirect()->route('MannualPod.TranMenu.create')->with('success','Record successfully Saved..');
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
		
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->FindOrFail($id);
		
		return view('MannualPod.show',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = AwbMasterModel::with('Franchisee','ClientCode','SubCityName')->FindOrFail($id);
		
		return view('MannualPod.edit',compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MannualPodFormRequest $request, $id)
    {
		try
		{
			$data = $request->getData();
			
			$data['UpdatedBy'] = Auth::user()->name;
				
			$curTime = new \DateTime();
			$created_at = $curTime->format("Y-m-d H:i:s");
			$data['UpdatedOn'] = $created_at;
			
			$result = AwbMasterModel::FindOrFail($id);
			
			$result->update($data);
			
			return redirect()->route('MannualPod.TranMenu.index')->with('success','Record successfully Updated...');
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
			$result = AwbMasterModel::findorfail($id);
			
			$result->delete();
			
			return redirect()->route('MannualPod.index')->with('success','Record successfully deleted..');
		}
		catch(Exception $ex)
		{
			return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
		}
    }
}
