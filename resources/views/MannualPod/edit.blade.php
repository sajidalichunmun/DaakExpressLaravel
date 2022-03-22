@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                {{ !empty($result->AwbNo) ? $result->AwbNo : 'result' }}
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('MannualPod.TranMenu.index') }}" class="btn btn-primary" title="Show All Mannual Pod">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('MannualPod.TranMenu.create') }}" class="btn btn-primary" title="Create New Mannual Pod">
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
                'route' => ['MannualPod.TranMenu.update', $result->AwbNo],
                'class' => 'form-horizontal',
                'name' => 'edit_result_form',
                'id' => 'edit_result_form',
                
            ]) !!}

            @include ('MannualPod.form', ['result' => $result,])

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection