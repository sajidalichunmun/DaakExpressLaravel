@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create New Menu</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('menus.menu.index') }}" class="btn btn-primary" title="Show All Menu">
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
                'route' => 'menus.menu.store',
                //'class' => 'form-horizontal',
                'name' => 'create_menu_form',
                'id' => 'create_menu_form',
                
                ])
            !!}

            @include ('menus.form', ['menu' => null,])
            <div class="form-group">
                
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
              
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


