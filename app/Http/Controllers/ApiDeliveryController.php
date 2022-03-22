<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Models\DeliveryModel;

class ApiDeliveryController extends Controller
{
    public function createDelivery(Request $request){
		$Delivery = Delivery::create($request->all());
		return response()->json($Delivery);
	}
	public function updateDelivery(Request $request, $id){
		$Delivery  = DB::table('Delivery')->where('id',$request->input('id'))->get();
		   $Delivery->AwbNo = $request->input('AwbNo');
		   //$Delivery->price = $request->input('price');
		   //$Delivery->description = $request->input('description');
		   $Delivery->save();
		   $response["Delivery"] = $Delivery;
		   $response["success"] = 1;
		return response()->json($response);
	}  
	public function deleteDelivery($id){
		$Delivery  = DB::table('Delivery')->where('id',$request->input('id'))->get();
		$Delivery->delete();
		return response()->json('Removed successfully.');
	}
	public function index(){
		$Delivery  = Delivery::all();
		   $response["Delivery"] = $Delivery;
		   $response["success"] = 1;
		return response()->json($response);
	}
}

