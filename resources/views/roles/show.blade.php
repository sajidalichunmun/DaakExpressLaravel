@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Role' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['roles.role.destroy', $role->id]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('roles.role.index') }}" class="btn btn-primary" title="Show All Role">
                        <span class="fa fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('roles.role.create') }}" class="btn btn-success" title="Create New Role">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('roles.role.edit', $role->id ) }}" class="btn btn-primary" title="Edit Role">
                        <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="fa fa-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Role',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Role.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Role Name</dt>
            <dd>{{ $role->role_name }}</dd>
            <dt>Created At</dt>
            <dd>{{ $role->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $role->updated_at }}</dd>
            <dt>Created By</dt>
            <dd>{{ isset($role->creator->name) ? $role->creator->name : '' }}</dd>
            <dt>Updated By</dt>
            <dd>{{ isset($role->updater->name) ? $role->updater->name : '' }}</dd>

        </dl>

    </div>
</div>

@endsection