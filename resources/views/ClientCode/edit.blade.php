@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($result->Name) ? $result->Name : 'result' }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('ClientCode.Mast.index') }}" class="btn btn-primary" title="Show All Client Code">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('ClientCode.Mast.create') }}" class="btn btn-primary" title="Create New Client Code">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
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

            {!! Form::model($result, [
                'method' => 'PUT',
                'route' => ['ClientCode.Mast.update', $result->ID],
                'class' => 'form-horizontal',
                'name' => 'edit_ClientCode_form',
                'id' => 'edit_ClientCode_form',
                
            ]) !!}

            @include ('ClientCode.form', ['result' => $result,])

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection