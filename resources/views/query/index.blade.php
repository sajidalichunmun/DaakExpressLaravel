@extends('layouts.app')

@section('css')
<style>
    .custom-control-input:checked~.custom-control-label::before {
  color: #fff;
  border-color: #7B1FA2;
}

.custom-control-input:checked~.custom-control-label.red::before {
  background-color: red;
}

.custom-control-input:checked~.custom-control-label.green::before {
  background-color: green;
}
</style>
@endsection
@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
<div class="panel panel-primary">   
    <div class="panel-heading clearfix">
        <h4 class="mt-3">Filter Parameter</h4>
    </div>
    
    <div class="panel-body panel-body-with-table">
        <div class="row">
            <form name="frmSearch" action="{{route('query')}}" method="get" id="frmSearch" class="group-button">
                {{ csrf_field() }}
                <div class="col-sm-11 col-xs-offset-0">
                    <div class="form-check-inline custom-control custom-radio custom-control-inline"> 
                        <label for="rd_1" class="customradio mt-checkbox custom-control-label green" onclick="sendGaEvent('banner_trackform', 'radio_btn_awb', 'track_order');">
                        <span class="radiotextsty">Awb No</span> 
                            <input type="radio" id="rd_1" {{ ($rdochecked=="track_id")? "checked" : "" }} name="radio" class="trackradio trackRadioAWB mt-3 custom-control-input" value="track_id"> 
                            <span class="checkmark"></span> 
                        </label> 
                        <label for="rd_2" class="customradio mt-checkbox custom-control-label green" onclick="sendGaEvent('banner_trackform', 'radio_btn_orderid', 'track_order');">
                            <span class="radiotextsty">Ref No</span> 
                            <input type="radio" id="rd_2" {{ ($rdochecked=="orderId")? "checked" : "" }} name="radio" class="trackradio trackRadioOrder mt-3 custom-control-input" value="orderId"> 
                            <span class="checkmark"></span> 
                        </label> 
                        <label for="rd_3" class="customradio mt-checkbox custom-control-label green" onclick="sendGaEvent('banner_trackform', 'radio_btn_awb', 'track_order');">
                        <span class="radiotextsty">LTL Shipment (LRN)</span> 
                            <input type="radio" id="rd_3" {{ ($rdochecked=="lrnumber")? "checked" : "" }} name="radio" class="trackradio trackRadioAWB mt-3 custom-control-input" value="lrnumber"> 
                            <span class="checkmark"></span> 
                        </label>
                    </div>
                        
                    <input type="text" name="podno" id="podno" required="" value="{{ $podno ?? ''}}" placeholder="Enter awb no" class="form-control text-capitalize text-justify">
                    <div id="search_result"></div>
                </div>
                <div>
                    <div class="form-group">
                        <button type="submit"  name="btnSearch" id="btnSearchID" class="btn btn-info" style="margin-top: 25px;">FIND</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="panel panel-primary">   
    <div class="panel-heading clearfix">
        <h4>INFORMATION OF QUERY DETAILS</h4>
    </div>
    
    <div class="panel-body panel-body-with-table">
        <div class="col-md-12 text-left"> 
            <div class="panel-body panel-body-with-table">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">POD DETAILS</a></li>
                        <li><a data-toggle="tab" href="#menu1">CLIENT DATA</a></li>
                        <li><a data-toggle="tab" href="#menu2">IN SCAN</a></li>
                        <li><a data-toggle="tab" href="#menu3">OUT SCAN</a></li>
                        <li><a data-toggle="tab" href="#menu4">HISTORY</a></li>
                    </ul>
                    @if (count($result) <= 0)
                        <h2 align="center">No Data </h2>
                    @else
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>POD NUMBER</label>
                                        <input type="text" name="podno" id="podno" class="form-control" value="{{ $result[0]->AwbNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>POD DATE</label>
                                        <input type="text" name="poddate" id="poddate" class="form-control" value="{{ \Carbon\Carbon::parse($result[0]->PodDate)->format('d/m/Y') ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CLIENT CODE</label>
                                        <input type="text" name="clientcode" id="clientcode" class="form-control" value="{{ $result[0]->ClientCode->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>MAJOR NAME</label>
                                        <input type="text" name="majorname" id="majorname" class="form-control" value="{{ $result[0]->ClientCode->MajorResult->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>MAJOR CODE</label>
                                        <input type="text" name="majorcode" id="majorcode" class="form-control" value="{{ $result[0]->ClientCode->MajorResult->MajorCode ?? ''}}" readonly="">
                                    </div>
                                </div>
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>FRANCHISEE</label>
                                        <input type="text" name="franname" id="franname" class="form-control" value="{{ $result[0]->Franchisee->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CUSTOMER NAME</label>
                                        <input type="text" name="customer" id="customer" class="form-control" value="{{ $result[0]->CustomerName ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>MOBILE NO</label>
                                        <input type="text" name="mobileno" id="mobileno" class="form-control" value="{{ $result[0]->MobileNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>ADDRESS1</label>
                                        <input type="text" name="address1" id="address1" class="form-control" value="{{ $result[0]->Address1 ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>ADDRESS2</label>
                                        <input type="text" name="address2" id="address2" class="form-control" value="{{ $result[0]->Address2 ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>PIN CODE</label>
                                        <input type="text" name="pincode" id="pincode" class="form-control" value="{{ $result[0]->Pincode ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>MAIN AREA NAME</label>
                                        <input type="text" name="mainarea" id="mainarea" class="form-control" value="{{ $result[0]->SubCityName->MainAreaName ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>SUB AREA NAME</label>
                                        <input type="text" name="subcity" id="subcity" class="form-control" value="{{ $result[0]->SubCityName->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CITY NAME</label>
                                        <input type="text" name="cityname" id="cityname" class="form-control" value="{{ $result[0]->SubCityName->City->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>STATE NAME</label>
                                        <input type="text" name="statename" id="statename" class="form-control" value="{{ $result[0]->SubCityName->City->State->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CURRENT STATUS</label>
                                        <input type="text" name="status" id="status" class="form-control" value="{{ $result[0]->AwbNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>IN SCAN DATE</label>
                                        <input type="text" name="inscan" id="inscan" class="form-control" value="{{ ($result[0]->scanin != null ) ? \Carbon\Carbon::parse($result[0]->scanin->ScanIndt)->format('d/m/Y') : ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>OUT SCAN DATE</label>
                                        <input type="text" name="outscan" id="outscan" class="form-control" value="{{ ($result[0]->scanout != null ) ? \Carbon\Carbon::parse($result[0]->scanout->ScanOutdt)->format('d/m/Y') : ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Delivery Boy</label>
                                        <input type="text" name="outscan" id="outscan" class="form-control" value="{{ $result[0]->scanout->Delivery->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <hr style="border: 2px solid green;">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>REF NO</label>
                                        <input type="text" name="refno" id="refno" class="form-control" value="{{ $result[0]->RefNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>BARCODE NO</label>
                                        <input type="text" name="barcode" id="barcode" class="form-control" value="{{ $result[0]->shipmentno ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>DELIVERY DATE</label>
                                        <input type="text" name="dlvdt" id="dlvdt" class="form-control" value="{{ ($result[0]->delivered != null ) ? \Carbon\Carbon::parse($result[0]->delivered->dlvdt)->format('d/m/Y') : ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>RECIVER NAME</label>
                                        <input type="text" name="recname" id="recname" class="form-control" value="{{ $result[0]->delivered->RecName ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>RELATION</label>
                                        <input type="text" name="relation" id="relation" class="form-control" value="{{ $result[0]->delivered->relation->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>REC PHONE</label>
                                        <input type="text" name="recphone" id="recphone" class="form-control" value="{{ $result[0]->delivered->DPhoneNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>RTO REASON</label>
                                        <input type="text" name="rtoreason" id="rtoreason" class="form-control" value="{{ $result[0]->rto->rtoreason->Name ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>RTO DATE</label>
                                        <input type="text" name="rtodt" id="rtodt" class="form-control" value="{{ $result[0]->rto->RTODT ?? ''}}" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>REF NO</label>
                                        <input type="text" name="refno1" id="refno1" class="form-control" value="{{ $result[0]->ClientData->RefNo1 ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>BARCODE NO</label>
                                        <input type="text" name="barcode1" id="barcode1" class="form-control" value="{{ $result[0]->ClientData->BarcodeNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CUSTOMER NAME</label>
                                        <input type="text" name="custname" id="custname" class="form-control" value="{{ $result[0]->ClientData->CustomerName ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>MOBILE NO</label>
                                        <input type="text" name="cmobileno" id="cmobileno" class="form-control" value="{{ $result[0]->ClientData->MobileNo ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>ADDRESS1</label>
                                        <input type="text" name="cadd1" id="cadd1" class="form-control" value="{{ $result[0]->ClientData->Address1 ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>ADDRESS2</label>
                                        <input type="text" name="cadd2" id="cadd2" class="form-control" value="{{ $result[0]->ClientData->Address2 ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>ADDRESS3</label>
                                        <input type="text" name="cadd3" id="cadd3" class="form-control" value="{{ $result[0]->ClientData->Address3 ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>CITY</label>
                                        <input type="text" name="ccity" id="ccity" class="form-control" value="{{ $result[0]->ClientData->CityName ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>STATE</label>
                                        <input type="text" name="cstate" id="cstate" class="form-control" value="{{ $result[0]->ClientData->StateName ?? ''}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>PIN CODE</label>
                                        <input type="text" name="cpincode" id="cpincode" class="form-control" value="{{ $result[0]->ClientData->Pincode ?? ''}}" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                        <div class="col-sm-12">
                                <div class="table-responsive" id="employee_table">
                                    <table id="tbExport" class="table table-dark table-bordered table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Awb No</th>
                                            <th>Date</th>
                                            <th>Created By</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @Forelse($scanin as $key => $row)
                                                <tr>
                                                    <td> {{ $key + 1 }} </td>
                                                    <td> {{ $row->AwbNo ?? ''}} </td>
                                                    <td> {{ $row->scanin->ScanIndt ?? ''}} </td>
                                                    <td> {{ $row->scanin->CreatedBy ?? ''}} </td>
                                                    <td> {{ $row->scanin->CreatedOn ?? ''}} </td>
                                                </tr>
                                            @empty
                                                <h4 align="center"> No Data </h4> 
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                        <div class="col-sm-12">
                                <div class="table-responsive" id="employee_table">
                                    <table id="tbExport" class="table table-dark table-bordered table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Awb No</th>
                                            <th>Date</th>
                                            <th>Delivery Boy</th>
                                            <th>Created By</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @Forelse($scanout as $key => $row)
                                                <tr>
                                                    <td> {{ $key + 1}} </td>
                                                    <td> {{ $row->AwbNo ?? ''}} </td>
                                                    <td> {{ $row->scanout->ScanOutdt ?? ''}} </td>
                                                    <td> {{ $row->scanout->Delivery->Name ?? ''}} </td>
                                                    <td> {{ $row->scanout->CreatedBy ?? ''}} </td>
                                                    <td> {{ $row->scanout->CreatedOn ?? ''}} </td>
                                                </tr>
                                            @empty
                                                <h4 align="center"> No Data </h4> 
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <div class="col-sm-12">
                                <div class="table-responsive" id="employee_table">
                                    <table id="tbExport" class="table table-dark table-bordered table-hover">
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
                                            @Forelse($history as $key => $row)
                                                <tr>
                                                    <td> {{ $row->PodSlNo ?? ''}} </td>
                                                    <td> {{ $row->AwbNo ?? ''}} </td>
                                                    <td> {{ $row->HistDate ?? ''}} </td>
                                                    <td> {{ $row->HistStatus ?? ''}} </td>
                                                    <td> {{ $row->CreatedBy ?? ''}} </td>
                                                    <td> {{ $row->CreatedOn ?? ''}} </td>
                                                </tr>
                                            @empty
                                                <h4 align="center"> No Data </h4> 
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- CREATE BUTTON PANEL END -->
            <div class="row" style="border: 2px solid #0000FF;margin-top: 5px;">
                <div class="col-sm-12">
            
                </div>
            </div>
            <!-- end center  column-->
        </div>
    </div>
</div>
@endsection