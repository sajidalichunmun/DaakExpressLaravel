@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Packet Status</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('PacketStatus.Mast.index') }}" class="btn btn-primary" title="Show All Packet Status">
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
                'route' => 'PacketStatus.Mast.store',
                'class'=>'form-horizontal',
                'name' => 'create_PacketStatus_form',
                'id' => 'create_PacketStatus_form',
                
                ])
            !!}

            @include ('PacketStatus.form', ['result' => null,])
            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


