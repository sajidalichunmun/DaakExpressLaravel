@extends('layouts.app')

@section('content')
         
    <div class="panel-body">
        <div id="print">
            <div class="row">
                @forelse($result as $key => $v)
                    <div class="div col-lg-4 col-md-4 col-sm-12 mt-3">
                        <div class="panel-body">
                            <div class="col-lg-6">Pod Date : {{\Carbon\Carbon::parse($v->PodDate)->format('d/m/Y')}}</div>
                            <div class="col-lg-6">Awb No : {{$v->AwbNo}}</div>
                            <div class="col-lg-12">{!! $v->awbbarcode !!}</div>
                            <div class="col-lg-12">{{$v->shipmentno}}</div>
                            <div class="col-lg-12">CI Code : {{ $v->ClientCode }}</div>
                            <div class="col-lg-12"> CI Name : {{ $v->MajorName }} </div>
                            <div class="col-lg-12"> Name : {{ $v->CustomerName }} </div>
                            <div class="col-lg-12"> Area : {{ $v->Address1 }}&nbsp;{{ $v->Address2 }}&nbsp;{{ $v->SubCity }}&nbsp;{{ $v->Pincode }} </div>
                            <div class="col-lg-12"> Ref No : {{ $v->RefNo }} </div>
                            <div class="col-lg-12"> Receiver Name:___________________ </div>
                            <div class="col-lg-12"> Sign & Phone:____________________ </div>
                        </div>
                    </div>
                @empty
                    <h2 class="text-center"> No Data </h2>
                @endforelse
            </div>
        </div>
    </div>
                    
       
    @endsection
