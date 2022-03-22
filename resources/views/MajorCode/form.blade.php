<div class="form-group {{ $errors->has('MajorCode') ? 'has-error' : '' }}">
    {!! Form::label('MajorCode','Major Code',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('MajorCode',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' =>'Enter Major Code','title' => 'Major Code']) !!}
        {!! $errors->first('MajorCode', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Major Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'required' => true, 'placeholder' =>'Enter Major Name','title' => 'Major Name']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('MobileNo') ? 'has-error' : '' }}">
    {!! Form::label('MobileNo','Mobile No',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('MobileNo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' =>'Enter Mobile No','title' => 'Mobile No']) !!}
        {!! $errors->first('MobileNo', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Address1') ? 'has-error' : '' }}">
    {!! Form::label('Address1','Address1',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Address1',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '250', 'required' => true, 'placeholder' =>'Enter Address1','title' => 'Address1']) !!}
        {!! $errors->first('Address1', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Address2') ? 'has-error' : '' }}">
    {!! Form::label('Address2','Address2',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Address2',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '250', 'required' => true, 'placeholder' =>'Enter Address2','title' => 'Address2']) !!}
        {!! $errors->first('Address2', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Description') ? 'has-error' : '' }}">
    {!! Form::label('Description','Description',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Description',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '250', 'required' => true, 'placeholder' =>'Enter Description','title' => 'Description']) !!}
        {!! $errors->first('Description', '<p class="help-block">:message</p>') !!}
	</div>
</div>
