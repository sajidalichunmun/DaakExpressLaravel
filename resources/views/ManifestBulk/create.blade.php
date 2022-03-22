@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Manifest Bulk</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('ManifestBulk.TranMenu.index') }}" class="btn btn-primary" title="Show All Manifest Bulk">
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
            <form name="frmEntryID" id="frmEntryID" method="post" action="{{ route('ManifestBulk.TranMenu.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('scandate') ? 'has-error' : '' }}">
                        {!! Form::label('scandate','MANIFEST DATE',) !!}
                            {!! Form::text('scandate',date('Y-m-d'), ['class' => 'form-control',  'readonly' => true, 'required' => true, 'placeholder' =>'Enter City Name','title' => 'City Name']) !!}
                            {!! $errors->first('scandate', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group {{ $errors->has('FranID') ? 'has-error' : '' }}">
                        {!! Form::label('FranID','FRANCHISEE',) !!}
                            {!! Form::select('FranID',$franchisee, null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Selrct Franchisee','title' => 'Franchisee']) !!}
                            {!! $errors->first('FranID', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="select_file">BROWSE EXCEL FILE</label>
                                <input type="file" required="" name="select_file" id="select_file" class="form-control" accept=".xls,.xlsx">
                            </div>
                        </div>
                    </div>
                    <div class="row pull-right">
                        <button name="btnResetID" id="btnResetID" type="reset" class="btn btn-info" style="margin-top: 25px;">Reset</button>                                            
                        <button name="btnSaveID" id="btnSaveID" type="submit" class="btn btn-primary" style="margin-top: 25px;" onclick="return ValidateControls();">UPLOAD DATA</button>
                    </div>
                </div>
        </form>

        </div>
    </div>

@endsection


