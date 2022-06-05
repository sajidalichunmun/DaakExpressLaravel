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
                'route'  => ['SubArea.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('SubArea.Mast.index') }}" class="btn btn-primary" title="Show All Sub Area">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('SubArea.Mast.create') }}" class="btn btn-success" title="Create New Sub Area">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('SubArea.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Sub Area">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Sub Area',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Sub Area.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Sub Area ID</dt>
            <dd>{{ $result->ID }}</dd>
			<dt>Sub Area</dt>
            <dd>{{ $result->Name }}</dd>
            <dt>Pin Code</dt>
            <dd>{{ $result->Pincode }}</dd>
            <dt>Main Area Name</dt>
            <dd>{{ $result->City->MainAreaName }}</dd>
			<dt>City Name</dt>
            <dd>{{ $result->City->Name }}</dd>
			<dt>State Name</dt>
            <dd>{{ $result->City->State->Name }}</dd>
			<dt>Country Name</dt>
            <dd>{{ $result->City->State->Country->Name }}</dd>
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