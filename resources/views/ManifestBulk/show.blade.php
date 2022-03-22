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
                'route'  => ['ManifestBulk.TranMenu.destroy', $result->AwbNo]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('ManifestBulk.TranMenu.index') }}" class="btn btn-primary" title="Show All Manifest Bulk">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('ManifestBulk.TranMenu.create') }}" class="btn btn-success" title="Create New Manifest Bulk">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('ManifestBulk.TranMenu.edit', $result->AwbNo ) }}" class="btn btn-primary" title="Edit Manifest Bulk">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Manifest Bulk',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Manifest Bulk.' . '")'
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
            <dd>{{ $result->ClientCode->MajorResult->Name }}</dd>
			<dt>Client Code</dt>
            <dd>{{ $result->ClientCode->Name }}</dd>
			<dt>Customer Name</dt>
            <dd>{{ $result->CustomerName }}</dd>
			<dt>Mobile No</dt>
            <dd>{{ $result->MobileNo }}</dd>
			<dt>Address</dt>
            <dd>{{ $result->Address1 .','. $result->Address2 }}</dd>
			<dt>Pin Code</dt>
            <dd>{{ $result->Pincode }}</dd>
			<dt>Main Area Name</dt>
            <dd>{{ $result->SubCityName->MainAreaName }}</dd>
			<dt>Sub Area Name</dt>
            <dd>{{ $result->SubCityName->Name }}</dd>
			<dt>City Name</dt>
            <dd>{{ $result->SubCityName->City->Name }}</dd>
			<dt>State Name</dt>
            <dd>{{ $result->SubCityName->City->State->Name }}</dd>
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