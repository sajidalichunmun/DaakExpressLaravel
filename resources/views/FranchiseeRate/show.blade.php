@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($result->Name) ? $result->Name : 'result' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['FranchiseeRate.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('FranchiseeRate.Mast.index') }}" class="btn btn-primary" title="Show All Franchisee Rate">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('FranchiseeRate.Mast.create') }}" class="btn btn-success" title="Create New Franchisee Rate">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('FranchiseeRate.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit Franchisee Rate">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Franchisee Rate',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Franchisee Rate.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd>{{ $result->ID }}</dd>
            <dt>Franchisee Name</dt>
            <dd>{{ $result->Franchisee->Name }}</dd>
            <dt>Franchisee Rate</dt>
            <dd>{{ $result->RATE }}</dd>
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