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
                'route'  => ['State.Mast.destroy', $result->ID]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('State.Mast.index') }}" class="btn btn-primary" title="Show All State">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('State.Mast.create') }}" class="btn btn-success" title="Create New State">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('State.Mast.edit', $result->ID ) }}" class="btn btn-primary" title="Edit State">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete State',
                            'onclick' => 'return confirm("' . 'Click Ok to delete State.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>State ID</dt>
            <dd>{{ $result->ID }}</dd>
            <dt>State Name</dt>
            <dd>{{ $result->Name }}</dd>
            <dt>Country Name</dt>
            <dd>{{ $result->Country->Name }}</dd>
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