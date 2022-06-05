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
                'route'  => ['MajorCode.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('MajorCode.Mast.index') }}" class="btn btn-primary" title="Show All Major Code">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('MajorCode.Mast.create') }}" class="btn btn-success" title="Create New Major Code">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('MajorCode.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Major Code">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Major Code',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Major Code.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Major Code ID</dt>
            <dd>{{ $result->ID }}</dd>
            <dt>Major Name</dt>
            <dd>{{ $result->Name }}</dd>
            <dt>Short Code</dt>
            <dd>{{ $result->MajorCode }}</dd>
			<dt>Mobile No</dt>
            <dd>{{ $result->MobileNo }}</dd>
			<dt>Address1</dt>
            <dd>{{ $result->Address1 }}</dd>
			<dt>Address2</dt>
            <dd>{{ $result->Address2 }}</dd>
			<dt>Description</dt>
            <dd>{{ $result->Descriptio }}</dd>
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