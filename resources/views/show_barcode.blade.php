@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="mb-4 mt-4">1D Barcodes</h1>
        <div class="row mt-2">
            {!! DNS1D::getBarcodeHTML('4445645656', 'IMB') !!}
        </div>
        <div class="row mt-2">
            {!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}
        </div>
        <div class="row mt-2">
            {!! DNS1D::getBarcodeHTML('4445645656', 'CODE11') !!}
        </div>
        <div class="row mt-2">
            {!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}
        </div>
        <h1 class="mb-4 mt-4">2D Barcodes</h1>
        <div class="row">
            <label>QR Code</label>
            {!! DNS2D::getBarcodeHTML($user_input, 'QRCODE')!!}
        </div>
        <div class="row">
            <label>Data Matrix Barcode</label>
            {!! DNS2D::getBarcodeSVG('4445645656', 'DATAMATRIX') !!}
        </div>
    </div>
@endsection