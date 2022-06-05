@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'User Menu' }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('user_menus.user_menu.index') }}" class="btn btn-primary" title="Show All User Menu">
                    <span class="fa fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('user_menus.user_menu.create') }}" class="btn btn-primary" title="Create New User Menu">
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

            {!! Form::model($userMenu, [
                'method' => 'PUT',
                'route' => ['user_menus.user_menu.update', $userMenu->id],
                 'class'=>'form-horizontal',
                'name' => 'edit_user_menu_form',
                'id' => 'edit_user_menu_form',
                
            ]) !!}

            @include ('user_menus.form', ['userMenu' => $userMenu,])

            <div class="form-group">
              
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
              
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection