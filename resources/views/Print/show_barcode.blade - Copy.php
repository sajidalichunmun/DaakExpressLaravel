@extends('layouts.app')

@section('css')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
@endsection

@section('content')
    <div class="container">
    @if(count($result) == 0)
            <div class="panel-body text-center">
                <h4>No Reason Available.</h4>
            </div>
        @else
            @foreach($result as $v)
                <!-- <h1 class="mb-4 mt-4">1D Barcodes</h1> -->
                <div class="row mt-2">
                    {!! DNS1D::getBarcodeHTML($v->id, 'IMB') !!}
                </div>
                <!-- <div class="row mt-2">
                    {!! DNS1D::getBarcodeHTML( $v->awbno , 'CODABAR') !!}
                </div> -->
                <!-- <div class="row mt-2">
                    {!! DNS1D::getBarcodeHTML('4445645656', 'CODE11') !!}
                </div> -->
                <!-- <div class="row mt-2">
                    {!! DNS1D::getBarcodeHTML($v->awbno, 'PHARMA') !!}
                </div> -->
                <!-- <h1 class="mb-4 mt-4">2D Barcodes</h1>
                <div class="row">
                    <label>QR Code</label>
                    {!! DNS2D::getBarcodeHTML('kkkkk', 'QRCODE')!!}
                </div>
                <div class="row">
                    <label>Data Matrix Barcode</label>
                    {!! DNS2D::getBarcodeSVG('4445s645656', 'DATAMATRIX') !!}
                </div> -->
            @endforeach
        @endif
    </div>
    @endsection