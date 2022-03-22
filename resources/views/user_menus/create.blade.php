@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create New User Menu</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('user_menus.user_menu.index') }}" class="btn btn-primary" title="Show All User Menu">
                    <span class="fa fa-th-list" aria-hidden="true"></span>
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

            {!! Form::open([
                'route' => 'user_menus.user_menu.store',
                'class'=>'form-horizontal',
                'name' => 'create_user_menu_form',
                'id' => 'create_user_menu_form',
                
                ])
            !!}

            @include ('user_menus.form', ['userMenu' => null,])
            <div class="form-group">
              
                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


