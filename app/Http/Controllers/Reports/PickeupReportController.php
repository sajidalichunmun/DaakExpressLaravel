<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Http\Requests\PickeupFormRequest;
use App\Models\PickeupModel;
use App\Models\ClientCodeModel;
use App\Models\UploadExcelDataModel;
use App\Models\AwbMasterModel;
use App\Interfaces\IDownload;
use App\Interfaces\IReportData;

class PickeupReportController extends Controller
{

    private IDownload $download;
    private IReportData $report;
    
    public function __construct(IDownload $download,IReportData $report)
    {
      $this->download = $download;
      $this->report = $report;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pickupsummary(Request $request)
    {
        $this->report->getData();

        //$this->download->download('data');
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $filterDate = false;
            $fromdt = '';
            $todt = '';
        }
        $client = ClientCodeModel::pluck('name','id')->all();

        $result = AwbMasterModel::join('CLIENTCODEMASTER', function($join) {
            $join->on('CLIENTCODEMASTER.id', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.id');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->leftjoin('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.id');
          })
          ->leftjoin('clientexceldata', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'clientexceldata.AwbNo');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                  'FRANCHISEEMASTER.Name as FRANNAME','COUNTRYMASTER.Name as COUNTRYNAME',
                  'STATEMASTER.Name as STATENAME','CITYMASTER.Name as CITYNAME','SUBCITYMASTER.Name as SUBCITY','MAINAREANAME',
                  'SUBCITYMASTER.Pincode','AwbMaster.PodDate',DB::raw('COUNT(*) as TOTAL'))
          ->groupby(['CLIENTCODEMASTER.Name','ClientMajorMaster.Name','MajorCode',
                      'FRANCHISEEMASTER.Name','COUNTRYMASTER.Name',
                      'STATEMASTER.Name','CITYMASTER.Name','SUBCITYMASTER.Name','MAINAREANAME',
                      'SUBCITYMASTER.Pincode','AwbMaster.PodDate'])
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.PickeupSummary.index',compact('result','client','fromdt','todt'));
    }
    public function pickupdetails(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $filterDate = false;
            $fromdt = '';
            $todt = '';
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->leftjoin('clientexceldata', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'clientexceldata.AwbNo');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', [$request->clients]);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('FRANCHISEEMASTER.Name as FRANNAME','COUNTRYMASTER.Name as COUNTRYNAME',
                    'STATEMASTER.Name as STATENAME','CITYMASTER.Name as CITYNAME','SUBCITYMASTER.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                    'clientexceldata.RefNo1','clientexceldata.BarcodeNo','clientexceldata.CustomerName as cCustomerName',
                    'clientexceldata.MobileNo as cMobileNo','clientexceldata.Address1 as cAddress1','clientexceldata.Address2 as cAddress2',
                    'clientexceldata.Address3 as cAddress3','clientexceldata.CityName as cCityName','clientexceldata.StateName as cStateName',
                    'clientexceldata.Pincode as cPincode','AWB_SCAN_IN.ScanIndt','awb_scan_out.ScanOutdt',
                    'AwbMaster.*')
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.PickeupDetails.index',compact('result','client','fromdt','todt'));
    }
    public function deliverysummary(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $fromdt = '';
            $todt = '';
            $filterDate = false;
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->join('delivery', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'delivery.AwbNo');
          })
          ->join('relationmaster', function($join) {
            $join->on('delivery.RelationID', '=', 'relationmaster.id');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('franchiseemaster.Name as FRANNAME','countrymaster.Name as COUNTRYNAME','statemaster.Name as STATENAME',
                    'citymaster.Name as CITYNAME','subcitymaster.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                    'SUBCITYMASTER.Pincode','AwbMaster.PodDate','dlvdt',DB::raw('Count(*) as TOTAL')
                    )
          ->groupby(['CLIENTCODEMASTER.Name','ClientMajorMaster.Name','MajorCode',
                    'FRANCHISEEMASTER.Name','COUNTRYMASTER.Name',
                    'STATEMASTER.Name','CITYMASTER.Name','SUBCITYMASTER.Name','MAINAREANAME',
                    'SUBCITYMASTER.Pincode','AwbMaster.PodDate','dlvdt'])
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.DeliverySummary.index',compact('result','client','fromdt','todt'));
    }
    public function deliverydetails(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $fromdt = '';
            $todt = '';
            $filterDate = false;
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->join('delivery', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'delivery.AwbNo');
          })
          ->join('relationmaster', function($join) {
            $join->on('delivery.RelationID', '=', 'relationmaster.id');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('franchiseemaster.Name as FRANNAME','countrymaster.Name as COUNTRYNAME','statemaster.Name as STATENAME',
                    'citymaster.Name as CITYNAME','subcitymaster.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                    'AWB_SCAN_IN.ScanIndt','awb_scan_out.ScanOutdt','dlvdt','RecName','relationmaster.Name as DRelation','DPhoneNo',
                    'AwbMaster.*')
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.DeliveryDetails.index',compact('result','client','fromdt','todt'));
    }
    public function rtosummary(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $filterDate = false;
            $fromdt = '';
            $todt = '';
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->join('RTO', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'RTO.AwbNo');
          })
          ->join('ReasonMaster', function($join) {
            $join->on('RTO.ReasonID', '=', 'ReasonMaster.id');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('franchiseemaster.Name as FRANNAME','countrymaster.Name as COUNTRYNAME','statemaster.Name as STATENAME',
                    'citymaster.Name as CITYNAME','subcitymaster.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                    'AWB_SCAN_IN.ScanIndt','awb_scan_out.ScanOutdt','RTODT','ReasonMaster.Name as R_Name',
                    'SUBCITYMASTER.Pincode',DB::raw('Count(*) as TOTAL'))
          ->groupby([
                    'franchiseemaster.Name','countrymaster.Name','statemaster.Name',
                    'citymaster.Name','subcitymaster.Name','MAINAREANAME',
                    'CLIENTCODEMASTER.Name','ClientMajorMaster.Name','MajorCode',
                    'AWB_SCAN_IN.ScanIndt','awb_scan_out.ScanOutdt','RTODT','ReasonMaster.Name',
                    'SUBCITYMASTER.Pincode'
          ])
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.RtoSummary.index',compact('result','client','fromdt','todt'));
    }
    public function rtodetails(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $filterDate = false;
            $fromdt = '';
            $todt = '';
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->join('RTO', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'RTO.AwbNo');
          })
          ->join('ReasonMaster', function($join) {
            $join->on('RTO.ReasonID', '=', 'ReasonMaster.id');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('franchiseemaster.Name as FRANNAME','countrymaster.Name as COUNTRYNAME','statemaster.Name as STATENAME',
                    'citymaster.Name as CITYNAME','subcitymaster.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                    'AWB_SCAN_IN.ScanIndt','awb_scan_out.ScanOutdt','RTODT','ReasonMaster.Name as R_Name',
                    'AwbMaster.*')
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.RtoDetails.index',compact('result','client','fromdt','todt'));
    }
    public function consolidatedsummary(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $fromdt = '';
            $todt = '';
            $filterDate = false;
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->leftjoin('delivery', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'delivery.AwbNo');
          })
          ->leftjoin('relationmaster', function($join) {
            $join->on('delivery.RelationID', '=', 'relationmaster.id');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('franchiseemaster.Name as FRANNAME','countrymaster.Name as COUNTRYNAME','statemaster.Name as STATENAME',
                    'citymaster.Name as CITYNAME','subcitymaster.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode','SUBCITYMASTER.Pincode',
                    'AwbMaster.PodDate','AwbMaster.Status','dlvdt',DB::raw('Count(*) as TOTAL'))
          ->groupby([
                    'franchiseemaster.Name','countrymaster.Name','statemaster.Name',
                    'citymaster.Name','subcitymaster.Name','MAINAREANAME',
                    'CLIENTCODEMASTER.Name','ClientMajorMaster.Name','MajorCode','SUBCITYMASTER.Pincode',
                    'AwbMaster.PodDate','AwbMaster.Status','dlvdt'
          ])
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.ConsolidatedSummary.index',compact('result','client','fromdt','todt'));
    }
    public function consolidateddetails(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
            $fromdt = '';
            $todt = '';
            $filterDate = false;
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = AwbMasterModel::join('clientcodemaster', function($join) {
            $join->on('clientcodemaster.ID', '=', 'AwbMaster.ClientCodeID');
          })
          ->join('ClientMajorMaster', function($join) {
            $join->on('CLIENTCODEMASTER.ClientMajorID', '=', 'ClientMajorMaster.id');
          })
          ->join('SUBCITYMASTER', function($join) {
            $join->on('AwbMaster.SUBCITYID', '=', 'SUBCITYMASTER.ID');
          })
          ->join('CITYMASTER', function($join) {
            $join->on('SUBCITYMASTER.CITYID', '=', 'CITYMASTER.id');
          })
          ->join('STATEMASTER', function($join) {
            $join->on('CITYMASTER.STATEID', '=', 'STATEMASTER.id');
          })
          ->join('COUNTRYMASTER', function($join) {
            $join->on('STATEMASTER.COUNTRYID', '=', 'COUNTRYMASTER.id');
          })
          ->join('FRANCHISEEMASTER', function($join) {
            $join->on('AwbMaster.FRANID', '=', 'FRANCHISEEMASTER.ID');
          })
          ->leftjoin('delivery', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'delivery.AwbNo');
          })
          ->leftjoin('relationmaster', function($join) {
            $join->on('delivery.RelationID', '=', 'relationmaster.id');
          })
          ->leftjoin('AWB_SCAN_IN', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'AWB_SCAN_IN.AwbNo');
          })
          ->leftjoin('awb_scan_out', function($join) {
            $join->on('AwbMaster.AwbNo', '=', 'awb_scan_out.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('CLIENTCODEMASTER.id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('AwbMaster.PodDate','>=', $fromdt)
                    ->where('AwbMaster.PodDate','<=', $todt);
            })
          ->select('franchiseemaster.Name as FRANNAME','countrymaster.Name as COUNTRYNAME','statemaster.Name as STATENAME',
                    'citymaster.Name as CITYNAME','subcitymaster.Name as SUBCITY','MAINAREANAME',
                    'CLIENTCODEMASTER.Name as CLIENTCODE','ClientMajorMaster.Name as MajorName','MajorCode',
                    'AWB_SCAN_IN.ScanIndt','awb_scan_out.ScanOutdt','dlvdt','RecName','relationmaster.Name as DRelation','DPhoneNo',
                    'AwbMaster.*')
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
		
        return view('reports.ConsolidatedDetails.index',compact('result','client','fromdt','todt'));
    }
    public function exportexcelawbpending(Request $request)
    {
        //dd($request);
        // DB::select(DB::raw("SELECT * FROM `users` WHERE `name` = :username"), array('username' => $name))
        $searchClient = false;
        $searchDate = false;
        $filterDate = true;
        $fromdt = '';
        $todt = '';
        $clients = '';

        if ($request->has('fromdate') &&  $request->has('todate'))
        {
            if($request->fromdate !== null && $request->todate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
                $todt = $request->todate;
            }
            else if($request->fromdate !== null){
                $searchDate = true;
                $fromdt = $request->fromdate;
            }
        }
        else if ($request->has('fromdate')) {
            if($request->fromdate !== null){
                $searchDate = true;
                $filterDate = false;
                $fromdt = $request->fromdate;
            }
        }
        else{
            $fromdt = Carbon::now()->format('Y-m-d');
            $todt = Carbon::now()->format('Y-m-d');
        }
        if (is_array($request->clients) && count($request->clients)>0){
            $searchClient = true;
            $clients = $request->clients;
        }
        $client = ClientCodeModel::pluck('name','id')->all();
        $result = UploadExcelDataModel::leftJoin('AwbMaster', function($join) {
            $join->on('ClientExcelData.AwbNo', '=', 'AwbMaster.AwbNo');
          })
          //->whereNull('orders.customer_id')
          ->when($searchClient,function($query) use($request) {
                return $query->whereIn('AwbMaster.Id', $request->clients);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('ClientExcelData.UploadDT','>=', $fromdt)
                    ->where('ClientExcelData.UploadDT','<=', $todt);
            })
            ->when($searchDate,function($query) use($fromdt,$todt) {
                return $query->where('ClientExcelData.UploadDT','>=', $fromdt);
            })
            ->when($filterDate,function($query) use($fromdt,$todt) {
                return $query->where('ClientExcelData.UploadDT','>=', $fromdt)
                    ->where('ClientExcelData.UploadDT','<=', $todt);
            })
          ->select('ClientExcelData.*')
          ->paginate(25);

        if(!$searchDate){
            $fromdt='';
            $todt='';
        }
        return view('reports.ExportExcelAwbPending.index',compact('result','client','fromdt','todt'));
    }
}
