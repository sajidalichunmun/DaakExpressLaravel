@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($result->CRN_NO) ? $result->CRN_NO : 'CreditMemo' }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('CreditMemo.TranMenu.index') }}" class="btn btn-primary" title="Show All Credit Note">
                    <span class="fa fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('CreditMemo.TranMenu.create') }}" class="btn btn-success" title="Create New Credit Note">
                    <!--span class="fa fa-plus" aria-hidden="true"></span-->
					Create
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
                'route' => ['CreditMemo.TranMenu.update', $result->CRN_NO],
                 'class'=>'form-horizontal',
                'name' => 'edit_CreditMemo_form',
                'id' => 'edit_CreditMemo_form',
                
            ]) !!}

            @include ('CreditMemo.form', ['v' => $result,])

            <div class="form-group"  align="center">
              
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
              
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection