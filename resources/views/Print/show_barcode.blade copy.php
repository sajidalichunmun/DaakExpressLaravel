@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
     <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <div class="pull-left">
                                <h4 class="mt-5 mb-5">Products Barcodes</h4>
                            </div>
                            <div class="btn-group btn-group-sm pull-right" role="group">
                                <form action="{{url('/downloadPdf')}}" method="post">
                                    <button type="button" name="btnExport" id="btnExportID" class="btn btn-sm btn-success"  title="Print"><span class="fa fa-print" aria-hidden="true"></span>  Print PDF</button>
                                </form>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="print">
                                <div class="row">
                                    @forelse($result as $key => $v)
                                        <div class="div col-lg-4 col-md-4 col-sm-12 mt-3">
                                            <div class="panel-body">
                                                <div class="col-lg-6">Pod Date : {{\Carbon\Carbon::parse($v->PodDate)->format('d/m/Y')}}</div>
                                                <div class="col-lg-6">Awb No : {{$v->AwbNo}}</div>
                                                <div class="col-lg-12">{!! $v->awbbarcode !!}</div>
                                                <div class="col-lg-12"><h4 class="text-center">{{$v->shipmentno}}</h4></div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    @endsection

    @section('script')
        <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function(){
            $('#btnExportID').click(function() {
                window.print();
            });
        });
    </script>
    @endsection