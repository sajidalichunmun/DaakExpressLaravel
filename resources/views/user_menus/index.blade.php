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
                <h4 class="mt-5 mb-5">User Menus</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('user_menus.user_menu.create') }}" class="btn btn-success btn-sm" title="Create New User Menu">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a>

            </div>

        </div>
        
        @if(count($userMenus) == 0)
            <div class="panel-body text-center">
                <h4>No User Menus Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Menu</th>
                            <th>View Menu</th>
                            <th>Create</th>
                            <th>View</th>
                            <th>Update</th>
                            <th>Delete</th>
                            <th>Print</th>
                            <th>Excel</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($userMenus as $userMenu)
                        <tr>
                            <td>{{ isset($userMenu->User->name) ? $userMenu->User->name : '' }}</td>
                            <td>{{ isset($userMenu->Menu->name) ? $userMenu->Menu->name : '' }}</td>
                            <td>{{ ($userMenu->view_menu) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($userMenu->create) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($userMenu->view) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($userMenu->update) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($userMenu->delete) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($userMenu->print) ? 'Yes' : 'No' }}</td>
                            <td>{{ ($userMenu->excel) ? 'Yes' : 'No' }}</td>

                            <td>

                                {!! Form::open([
                                    'method' =>'DELETE',
                                    'route'  => ['user_menus.user_menu.destroy', $userMenu->id],
                                    'style'  => 'display: inline;',
                                ]) !!}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('user_menus.user_menu.show', $userMenu->id ) }}" class="btn btn-success" title="Show User Menu">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="panel-footer">
            {!! $userMenus->render() !!}
        </div>

        @endif

    </div>
@endsection