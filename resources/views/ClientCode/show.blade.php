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
                'route'  => ['ClientCode.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('ClientCode.Mast.index') }}" class="btn btn-primary" title="Show All Client Code">
                        <span class="glyphicon glyphicon-th-list" aria-hIDden="true"></span>
                    </a>

                    <a href="{{ route('ClientCode.Mast.create') }}" class="btn btn-success" title="Create New Client Code">
                        <span class="glyphicon glyphicon-plus" aria-hIDden="true"></span>
                    </a>

                    <a href="{{ route('ClientCode.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Client Code">
                        <span class="glyphicon glyphicon-pencil" aria-hIDden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hIDden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Client Code',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Client Code.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Client Code ID</dt>
            <dd>{{ $result->ID }}</dd>
			<dt>Major Name</dt>
            <dd>{{ $result->MajorResult->Name }}</dd>
            <dt>Client Code</dt>
            <dd>{{ $result->Name }}</dd>
            <dt>Packet Type</dt>
            <dd>{{ $result->PacketResult->Name }}</dd>
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