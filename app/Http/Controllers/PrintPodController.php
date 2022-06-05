<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Models\AwbMasterModel;
use PDF;

class PrintPodController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('Print.print');
    }
    
    public function awbprint()
    {
		return view('Print.printpod');
    }

    public function printpod()
    {
		return view('Print.printpod');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_input = $request->input('barcode');
        return view('Print.create');
    }

    public function showBarcode(Request $request)
    {
        // $this->PrintPdf();
        // return;


        $result = AwbMasterModel::join('ClientCodeMaster','AwbMaster.ClientCodeID','ClientCodeMaster.id')
                ->join('ClientMajorMaster','ClientCodeMaster.ClientMajorID','ClientMajorMaster.id')
                ->join('SubCityMaster','AwbMaster.SubCityID','SubCityMaster.id')
                ->leftjoin('FranchiseeMaster','AwbMaster.FranID','FranchiseeMaster.id')
                ->where('AwbMaster.AwbNo',">=",$request->from)
                ->where('AwbMaster.AwbNo',"<=",$request->to)
                ->select('AwbNo','AwbMaster.RefNo','AwbMaster.barcode_src','PodDate','ClientCodeMaster.Name as ClientCode','ClientMajorMaster.Name as MajorName','AwbMaster.shipmentno','AwbMaster.awbbarcode',
                            'AwbMaster.Address1','AwbMaster.Address2','SubCityMaster.Name as ','AwbMaster.Pincode','CustomerName','FranchiseeMaster.id as FranID')
                ->orderBy('AwbMaster.id')
                ->get();
                //->paginate(5);

        return view('/Print.show_barcode',compact('result'));
        //  $html = view('/Print.show_barcode',compact('result'));
         //$pdf = PDF::loadView('/Print.show_barcode', compact('result'))->setPaper('letter', 'landscape');
         //PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //  $pdf = PDF::loadView('/Print.show_barcode', compact('result'));
        //  return $pdf->download('itsolutionstuff.pdf');
        
    }

    public function showBarcode11(Request $request)
    {
        // $this->PrintPdf();
        // return;
        $result = AwbMasterModel::join('ClientCodeMaster','AwbMaster.ClientCodeID','ClientCodeMaster.id')
                ->join('ClientMajorMaster','ClientCodeMaster.ClientMajorID','ClientMajorMaster.id')
                ->join('SubCityMaster','AwbMaster.SubCityID','SubCityMaster.id')
                ->leftjoin('FranchiseeMaster','AwbMaster.FranID','FranchiseeMaster.id')
                //->where('AwbMaster.AwbNo',$request->from)
                ->select('AwbNo','AwbMaster.RefNo','AwbMaster.barcode_src','PodDate','ClientCodeMaster.Name as ClientCode','ClientMajorMaster.Name as MajorName','AwbMaster.shipmentno','AwbMaster.awbbarcode',
                            'AwbMaster.Address1','AwbMaster.Address2','SubCityMaster.Name as ','AwbMaster.Pincode','CustomerName','FranchiseeMaster.id as FranID')
                ->orderBy('AwbMaster.id')
                //->get();
                ->paginate(5);
        
        $html = view("/Print.show_barcode", compact("result"));

        $pdf = \App::make('dompdf.wrapper');
    
        $pdf->loadHTML($html);
    
    
        $output = $pdf->output();
    
        $name = public_path("/pdf/ILA_PIF_NL".rand(0,10000).".pdf");
    
        file_put_contents($name,$output);
    
        return response()->download($name)->deleteFileAfterSend();
                // $pdf = PDF::loadView('/Print.show_barcode', compact('result'))->setPaper('letter', 'landscape');

                // return response()->streamDownload(fn () => print($pdf->output()), 'Employess.pdf');

         $pdf = PDF::loadView('/Print.show_barcode', compact('result'))->setPaper('letter', 'landscape');
         PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //  return response()->streamDownload(fn () => print($pdf->output()), 'Employess.pdf');
         //$pdf->loadHTML('<h1>Test</h1>');
         return $pdf->download('itsolutionstuff.pdf');
        return view('/Print.show_barcode',compact('result'));
    }

    public function downloadPdf()
    {
        dd('hi');
        $pdf = PDF::loadView('/Print.show_barcode')->setPaper('letter', 'landscape');
        return response()->streamDownload(fn () => print($pdf->output()), 'Employess.pdf');
    }
    public function PrintPdf()
    {
        $result = AwbMasterModel::join('ClientCodeMaster','AwbMaster.ClientCodeID','ClientCodeMaster.id')
                ->join('ClientMajorMaster','ClientCodeMaster.ClientMajorID','ClientMajorMaster.id')
                ->join('SubCityMaster','AwbMaster.SubCityID','SubCityMaster.id')
                ->leftjoin('FranchiseeMaster','AwbMaster.FranID','FranchiseeMaster.id')
                ->select('AwbNo','AwbMaster.RefNo','AwbMaster.barcode_src','PodDate','ClientCodeMaster.Name as ClientCode','ClientMajorMaster.Name as MajorName','AwbMaster.shipmentno','AwbMaster.awbbarcode',
                            'AwbMaster.Address1','AwbMaster.Address2','SubCityMaster.Name as ','AwbMaster.Pincode','CustomerName','FranchiseeMaster.id as FranID')
                ->orderBy('AwbMaster.id')
                ->get();
        $output ='
                    <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading clearfix">
                                        <div class="pull-left">
                                        </div>
                                        <div class="btn-group btn-group-sm pull-right" role="group">
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div id="print">
                                            <div class="row">';
                                                foreach($result as $key => $v)
                                                {
                                                    $output .= '<div class="div col-lg-4 col-md-4 col-sm-12 mt-3">
                                                        <div class="panel-body">
                                                            <div class="col-lg-6">Pod Date :'. \Carbon\Carbon::parse($v->PodDate)->format('d/m/Y') .'</div>
                                                            <div class="col-lg-6">Awb No : '. $v->AwbNo .'</div>
                                                            <div class="col-lg-12">'. $v->awbbarcode .'</div>
                                                            <div class="col-lg-12"><h4 class="text-center">'. $v->shipmentno .'</h4></div>
                                                            <div class="col-lg-12">CI Code : '. $v->ClientCode .'</div>
                                                            <div class="col-lg-12"> CI Name : '. $v->MajorName .' </div>
                                                            <div class="col-lg-12"> Name : '. $v->CustomerName .' </div>
                                                            <div class="col-lg-12"> Area : '. $v->Address1 .' '. $v->Address2 .' '. $v->SubCity .' '. $v->Pincode .' </div>
                                                            <div class="col-lg-12"> Ref No : '. $v->RefNo .' </div>
                                                            <div class="col-lg-12"> Receiver Name:___________________ </div>
                                                            <div class="col-lg-12"> Sign & Phone:____________________ </div>
                                                        </div>
                                                    </div>';
                                                }
                                            $output .='</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';


        $pdf = PDF::loadView('/Print.show_barcode', compact('output'));
        $pdf->loadHTML($output);
        return $pdf->download('itsolutionstuff.pdf');

        $html = view("templates.pdf", compact("details", "projects", "staffs"));

    $pdf = \App::make('dompdf.wrapper');

    $pdf->loadHTML($html);


    $output = $pdf->output();

    $name = public_path("/pdf/ILA_PIF_NL".rand(0,10000).".pdf");

    file_put_contents($name,$output);

    return response()->download($name)->deleteFileAfterSend();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
