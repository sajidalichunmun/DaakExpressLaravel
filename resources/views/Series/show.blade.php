@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($result->BranchName->Name) ? $result->BranchName->Name : 'result' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['Series.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('Series.Mast.index') }}" class="btn btn-primary" title="Show All Series">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('Series.Mast.create') }}" class="btn btn-success" title="Create New Series">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('Series.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Series">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Series',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Series.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Series ID</dt>
            <dd>{{ $result->ID }}</dd>
            <dt>Branch Name</dt>
            <dd>{{ $result->BranchName->Name }}</dd>
            <dt>Series From</dt>
            <dd>{{ $result->SeriesFrom }}</dd>
			<dt>Series To</dt>
            <dd>{{ $result->SeriesTo }}</dd>
			<dt>Prefix</dt>
            <dd>{{ $result->Prefix }}</dd>
			<dt>Allocation Qty</dt>
            <dd>{{ $result->AllocationQty }}</dd>
			<dt>Allocated Series</dt>
            <dd>{{ $result->AllocatedSeries }}</dd>
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