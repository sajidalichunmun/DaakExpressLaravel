@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'User Menu' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['user_menus.user_menu.destroy', $userMenu->id]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('user_menus.user_menu.index') }}" class="btn btn-primary" title="Show All User Menu">
                        <span class="fa fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('user_menus.user_menu.create') }}" class="btn btn-success" title="Create New User Menu">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('user_menus.user_menu.edit', $userMenu->id ) }}" class="btn btn-primary" title="Edit User Menu">
                        <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="fa fa-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete User Menu',
                            'onclick' => 'return confirm("' . 'Click Ok to delete User Menu.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>User</dt>
            <dd>{{ isset($userMenu->User->name) ? $userMenu->User->name : '' }}</dd>
            <dt>Menu</dt>
            <dd>{{ isset($userMenu->Menu->name) ? $userMenu->Menu->name : '' }}</dd>
            <dt>View Menu</dt>
            <dd>{{ ($userMenu->view_menu) ? 'Yes' : 'No' }}</dd>
            <dt>Create</dt>
            <dd>{{ ($userMenu->create) ? 'Yes' : 'No' }}</dd>
            <dt>View</dt>
            <dd>{{ ($userMenu->view) ? 'Yes' : 'No' }}</dd>
            <dt>Update</dt>
            <dd>{{ ($userMenu->update) ? 'Yes' : 'No' }}</dd>
            <dt>Delete</dt>
            <dd>{{ ($userMenu->delete) ? 'Yes' : 'No' }}</dd>
            <dt>Print</dt>
            <dd>{{ ($userMenu->print) ? 'Yes' : 'No' }}</dd>
            <dt>Excel</dt>
            <dd>{{ ($userMenu->excel) ? 'Yes' : 'No' }}</dd>
            <dt>Created At</dt>
            <dd>{{ $userMenu->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $userMenu->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection