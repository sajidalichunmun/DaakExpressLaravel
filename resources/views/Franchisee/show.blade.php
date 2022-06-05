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
                'route'  => ['Franchisee.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('Franchisee.Mast.index') }}" class="btn btn-primary" title="Show All Franchisee">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('Franchisee.Mast.create') }}" class="btn btn-success" title="Create New Franchisee">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('Franchisee.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Franchisee">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Franchisee',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Franchisee.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Franchisee ID</dt>
            <dd>{{ $result->ID }}</dd>
            <dt>Franchisee</dt>
            <dd>{{ $result->Name }}</dd>
            <dt>GST NO</dt>
            <dd>{{ $result->GSTNO }}</dd>
			<dt>PAN NO</dt>
            <dd>{{ $result->PANNO }}</dd>
			<dt>CONTACT NO</dt>
            <dd>{{ $result->CONTACT1 .','. $result->CONTACT2 }}</dd>
			<dt>EMAIL</dt>
            <dd>{{ $result->EMAILID }}</dd>
			<dt>PIN CODE</dt>
            <dd>{{ $result->Pincode }}</dd>
			<dt>ADDRESS</dt>
            <dd>{{ $result->Address1 .','. $result->Address2 }}</dd>
			<dt>CITY NAME</dt>
            <dd>{{ $result->City->Name }}</dd>
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