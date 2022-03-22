@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Delivery Boy</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('DeliveryBoy.Mast.index') }}" class="btn btn-primary" title="Show All Delivery Boy">
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
                'route' => 'DeliveryBoy.Mast.store',
                'class'=>'form-horizontal',
                'name' => 'create_DeliveryBoy_form',
                'id' => 'create_DeliveryBoy_form',
                
                ])
            !!}

            @include ('DeliveryBoy.form', ['result' => null,])
            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


