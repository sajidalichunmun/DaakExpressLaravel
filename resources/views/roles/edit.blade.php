@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'Role' }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('roles.role.index') }}" class="btn btn-primary" title="Show All Role">
                    <span class="fa fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('roles.role.create') }}" class="btn btn-primary" title="Create New Role">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($role, [
                'method' => 'PUT',
                'route' => ['roles.role.update', $role->id],
                 'class'=>'form-horizontal',
                'name' => 'edit_role_form',
                'id' => 'edit_role_form',
                
            ]) !!}

            @include ('roles.form', ['role' => $role,])

            <div class="form-group">
              
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
              
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection