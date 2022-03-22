<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwbMasterModel;

class QueryController extends Controller
{
    public function index(Request $request)
    {
        $rdochecked='track_id';
        $podno='';
        if($request->radio==='track_id')
        {
            $rdochecked='track_id';
        }
        else if($request->radio==='orderId')
        {
            $rdochecked='orderId';
        }
        else if($request->radio==='lrnumber')
        {
            $rdochecked='lrnumber';
        }
        if(!empty($request->podno))
            $podno = $request->podno;

        if(empty($request->radio))
        {
            $request['podno']='';
            $request['radio'] = 'track_id';
        }
        $result = AwbMasterModel::with('ClientCode','SubCityName','Franchisee','scanin','scanout','delivered','rto','ClientData')
            ->when($request->radio==='track_id',function ($query) use($request){
                $query->Where('AwbNo', '=', $request->podno );
            })
            ->when($request->radio==='orderId',function ($query) use($request){
                $query->Where('RefNo', '=', $request->podno );
            })
            ->when($request->radio==='lrnumber',function ($query) use($request){
                $query->Where('shipmentno', '=', $request->podno );
            })
            ->get();
            //dd($result);

        $history = AwbMasterModel::join('awbmaster_hist','awbmaster.AwbNo','awbmaster_hist.AwbNo')
        ->when($request->radio==='track_id',function ($query) use($request){
            $query->Where('awbmaster.AwbNo', '=', $request->podno );
        })
        ->when($request->radio==='orderId',function ($query) use($request){
            $query->Where('awbmaster.RefNo', '=', $request->podno );
        })
        ->when($request->radio==='lrnumber',function ($query) use($request){
            $query->Where('awbmaster.shipmentno', '=', $request->podno );
        })
        ->select('awbmaster_hist.*')
        ->OrderBy('awbmaster_hist.PodSlNo')
        ->get();

        $scanin = AwbMasterModel::with('scanin')
        //join('awb_scan_in','awbmaster.AwbNo','awb_scan_in.AwbNo')
        ->when($request->radio==='track_id',function ($query) use($request){
            $query->Where('awbmaster.AwbNo', '=', $request->podno );
        })
        ->when($request->radio==='orderId',function ($query) use($request){
            $query->Where('awbmaster.RefNo', '=', $request->podno );
        })
        ->when($request->radio==='lrnumber',function ($query) use($request){
            $query->Where('awbmaster.shipmentno', '=', $request->podno );
        })
        // ->select('awb_scan_in.*')
        // ->OrderBy('awb_scan_in.CreatedOn')
        ->get();
        
        $scanout = AwbMasterModel::with('scanout')
        ->when($request->radio==='track_id',function ($query) use($request){
            $query->Where('awbmaster.AwbNo', '=', $request->podno );
        })
        ->when($request->radio==='orderId',function ($query) use($request){
            $query->Where('awbmaster.RefNo', '=', $request->podno );
        })
        ->when($request->radio==='lrnumber',function ($query) use($request){
            $query->Where('awbmaster.shipmentno', '=', $request->podno );
        })
        ->get();

        return view('query.index',compact('result','history','scanin','scanout','podno','rdochecked'));
    }
}
