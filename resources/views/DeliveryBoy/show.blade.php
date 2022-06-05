@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($result->Name) ? $result->Name : 'result' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['DeliveryBoy.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('DeliveryBoy.Mast.index') }}" class="btn btn-primary" title="Show All Delivery Boy">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('DeliveryBoy.Mast.create') }}" class="btn btn-success" title="Create New Delivery Boy">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('DeliveryBoy.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Delivery Boy">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Delivery Boy',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Delivery Boy.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Delivery Boy ID</dt>
            <dd>{{ $result->ID }}</dd>
            <dt>Delivery Boy</dt>
            <dd>{{ $result->Name }}</dd>
			<dt>Mobile No</dt>
            <dd>{{ $result->MobileNo }}</dd>
			<dt>Franchisee Name</dt>
            <dd>{{ $result->Franchisee->Name }}</dd>
            <dt>User Name</dt>
            <dd>{{ $result->Creator->name }}</dd>
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