<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testPrintController extends Controller
{
    public function print($id,$tab)
    {
      
        $id=decrypt($id);


        $transitWaybill = TransitWaybill::with('consignmentnote','container','creator','updater')->findOrFail($id);

          // dd( $transitWaybill);

		$remarks=ConsignmentRemark::whereNull('way_bill_category_id')->get();

		$lastImportTrip=[];
		$lastExportTrip=[];

		$lastImportTrip=T1Document::where('horse_id',$transitWaybill->t1Document->horse_id)->where('way_bill_category_id',1)->latest()
		->skip(1)
		->first();


		$lastExportTrip=T1Document::where('horse_id',$transitWaybill->t1Document->horse_id)->where('way_bill_category_id',2)->latest()
		->skip(1)
		->first();

        return view('transit_waybills.'.$tab, compact('transitWaybill','tab','remarks','lastImportTrip','lastExportTrip'));
    }

}
