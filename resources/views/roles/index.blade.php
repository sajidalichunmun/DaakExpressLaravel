@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Roles</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('roles.role.create') }}" class="btn btn-success" title="Create New Role">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a>

            </div>

        </div>
        
        @if(count($roles) == 0)
            <div class="panel-body text-center">
                <h4>No Roles Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Created By</th>
                            <th>Updated By</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->role_name }}</td>
                            <td>{{ isset($role->creator->name) ? $role->creator->name : '' }}</td>
                            <td>{{ isset($role->updater->name) ? $role->updater->name : '' }}</td>

                            <td>

                                {!! Form::open([
                                    'method' =>'DELETE',
                                    'route'  => ['roles.role.destroy', $role->id],
                                    'style'  => 'display: inline;',
                                ]) !!}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('roles.role.show', $role->id ) }}" class="btn btn-success" title="Show Role">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="panel-footer">
            {!! $roles->render() !!}
        </div>

        @endif

    </div>
@endsection