<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingPodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$output='';
		$cluse='';
		$output='';
		$PodNo='';
		if(isset($request->radio))
		{
			if($request->radio==="waybillId")
			{
				$cluse=" a.awbno='". $request->get("tracking-id") ."'";
			}
			else if($request->radio==="orderId")
			{
				$cluse=" RefNo1='". $request->get("id") ."'";
			}
			else if($request->radio==="lrnumber")
			{
				$cluse=" a.awbno='". $request->get("id") ."'";
			}
			
			$result = DB::select("select *from AwbMaster Where ". $cluse);
			if($result->count() > 0)
			{
				$output ='<div class="table-responsive">
						<table class="table table-borderd">';
				
				foreach($result as $key => $row)
				{
					$PodNo=$row->AwbNo;
					$output .='
						<tr>
							<td width="30%"><label>AWB No</label></td>
							<td width="70%">'. $row->AwbNo .'</td>
						</tr>
						<tr>
							<td width="30%"><label>Status</label></td>
							<td width="70%">'. $row->Status .'</td>
						</tr>
							';
				}
				$output .= '</table></div>';
			}
			
			$result1 = DB::select("select *from AwbMaster_Hist Where AwbNo = '". $PodNo ."' order by a.PodSlNo desc");
			if($result1->Count() > 0)
			{
				$output .= '<hr style="border:1px solid green;"><div class="table-responsive">
						<table class="table table-dark table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>Sr No</th>
								<th>Awb No</th>
								<th>Date</th>
								<th>Status</th>
								<th>Created By</th>
								<th>Created On</th>
							</tr>
						</thead>
						<tbody>
						';
				
				foreach($result1 as $key => $row)
				{
					$output .='
						<tr>
							<td>'. $row->PodSlNo .'</td>
							<td>'. $row->AwbNo .'</td>
							<td>'. $row->HistDate .'</td>
							<td>'. $row->HistStatus .'</td>
							<td>'. $row->CreatedBy .'</td>
							<td>'. $row->CreatedOn .'</td>
						</tr>
							';
				}
				$output .= '</tbody></table></div>';
			}
		}
		return $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
