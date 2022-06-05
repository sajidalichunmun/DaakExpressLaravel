
<div class="form-group {{ $errors->has('ClientID') ? 'has-error' : '' }}">
    {!! Form::label('ClientID','Client Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('ClientID',$client,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Client Name','title' => 'Client']) !!}
        {!! $errors->first('ClientID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('BranchID') ? 'has-error' : '' }}">
    {!! Form::label('BranchID','Branch Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('BranchID',$branch,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Branch Name','title' => 'Branch']) !!}
        {!! $errors->first('BranchID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('RefNo') ? 'has-error' : '' }}">
    {!! Form::label('RefNo','Reference No',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('RefNo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' =>'Enter Reference No','title' => 'Reference']) !!}
        {!! $errors->first('RefNo', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Quantity') ? 'has-error' : '' }}">
    {!! Form::label('Quantity','Quantity',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('Quantity',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Quantity','title' => 'Quantity']) !!}
        {!! $errors->first('Quantity', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('PickUpdate') ? 'has-error' : '' }}">
    {!! Form::label('PickUpdate','Pickeup Date',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::date('PickUpdate',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '12', 'required' => true, 'placeholder' =>'select Pickeup','title' => 'Pickeup']) !!}
        {!! $errors->first('PickUpdate', '<p class="help-block">:message</p>') !!}
	</div>
</div>