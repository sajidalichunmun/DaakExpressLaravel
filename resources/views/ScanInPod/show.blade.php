@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($result->AwbNo) ? $result->AwbNo : 'result' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['ScanInPod.TranMenu.destroy', $result->AwbNo]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('ScanInPod.TranMenu.index') }}" class="btn btn-primary" title="Show All In Scanning">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('ScanInPod.TranMenu.create') }}" class="btn btn-success" title="Create New In Scanning">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('ScanInPod.TranMenu.edit', $result->AwbNo ) }}" class="btn btn-primary" title="Edit In Scanning">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete In Scanning',
                            'onclick' => 'return confirm("' . 'Click Ok to delete In Scanning.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd>{{ $result->id }}</dd>
            <dt>POD No</dt>
            <dd>{{ $result->AwbNo }}</dd>
			<dt>Franchisee Name</dt>
            <dd>{{ isset($result->Franchisee) ? $result->Franchisee->Name : '' }}</dd>
			<dt>Major Name</dt>
            <dd>{{ isset($result->ClientCode->MajorResult->Name) ? $result->ClientCode->MajorResult->Name : '' }}</dd>
			<dt>Client Code</dt>
            <dd>{{ isset($result->ClientCode->Name) ? $result->ClientCode->Name : '' }}</dd>
			<dt>Scan In Date</dt>
            <dd>{{ isset($result->scanin->ScanIndt) ? $result->scanin->ScanIndt : '' }}</dd>
			<dt>Customer Name</dt>
            <dd>{{ isset($result->CustomerName) ? $result->CustomerName : '' }}</dd>
			<dt>Mobile No</dt>
            <dd>{{ isset($result->MobileNo) ? $result->MobileNo : '' }}</dd>
			<dt>Address</dt>
            <dd>{{ (isset($result->Address1) ? $result->Address1 : '') .','. (isset($result->Address2) ? $result->Address2  : '') }}</dd>
			<dt>Pin Code</dt>
            <dd>{{ isset($result->Pincode) ? $result->Pincode : '' }}</dd>
			<dt>Main Area Name</dt>
            <dd>{{ isset($result->SubCityName->MainAreaName) ?$result->SubCityName->MainAreaName : '' }}</dd>
			<dt>Sub Area Name</dt>
            <dd>{{ isset($result->SubCityName->Name) ? $result->SubCityName->Name : '' }}</dd>
			<dt>City Name</dt>
            <dd>{{ isset($result->SubCityName->City->Name) ? $result->SubCityName->City->Name : '' }}</dd>
			<dt>State Name</dt>
            <dd>{{ isset($result->SubCityName->City->State->Name) ? $result->SubCityName->City->State->Name : '' }}</dd>
            <dt>Created By</dt>
            <dd>{{ $result->CreatedBy }}</dd>
            <dt>Created On</dt>
            <dd>{{ $result->CreatedOn }}</dd>
            <dt>Updated By</dt>
            <dd>{{ $result->UpdatedBy }}</dd>
            <dt>Updated On</dt>
            <dd>{{ $result->UpdatedOn }}</dd>

        </dl>

    </div>
</div>

@endsection