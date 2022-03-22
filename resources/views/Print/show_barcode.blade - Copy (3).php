@extends('layouts.app')

@section('css')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
@endsection

@section('content')
     <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Products Barcodes</h4>
                        </div>
                        <div class="panel-body">
                            <div id="print">
                                <div class="row">
                                    @forelse($result as $key => $v)
                                        <div class="div collg-3 col-md-4 col-sm-12 mt-3">
                                            <div class="panel-body">
                                                <p>Pod Date : {{$v->PodDate}}
                                                {!! $v->awbbarcode !!}
                                                <h4 class="text-center">{{$v->shipmentno}}</h4>
                                                CI Code : {{ $v->ClientCode }}
                                                <br/>CI Name : {{ $v->MajorName }} 
                                                <br/>Name : {{ $v->CustomerName }} 
                                                <br/>Area : {{ $v->Address1 }}&nbsp;{{ $v->Address2 }}&nbsp;{{ $v->SubCity }}&nbsp;{{ $v->Pincode }} 
                                                <br/>Ref No : {{ $v->RefNo }}
                                                <br/>Receiver Name:___________________ 
                                                <br/>Sign & Phone:____________________ 
                                               
                                            </div>
                                        </div>
                                        <!-- <hr style="border:1px solid green;"> -->
                                    @empty
                                        <h2 class="text-center"> No Data </h2>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    @endsection