<div class="form-group {{ $errors->has('ClientMajorID') ? 'has-error' : '' }}">
    {!! Form::label('ClientMajorID','Major Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('ClientMajorID',$MajorCode,null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'select major code..', 'title' => 'Major Code']) !!}
        {!! $errors->first('ClientMajorID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Client Code',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Client Code','title' => 'Client Code']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Description') ? 'has-error' : '' }}">
    {!! Form::label('Description','Description',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Description',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '250', 'required' => true, 'placeholder' =>'Enter Description','title' => 'Description']) !!}
        {!! $errors->first('Description', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('ContactPerson') ? 'has-error' : '' }}">
    {!! Form::label('ContactPerson','Contact Person',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('ContactPerson',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Contact Person','title' => 'Contact Person']) !!}
        {!! $errors->first('ContactPerson', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('ContactMNo') ? 'has-error' : '' }}">
    {!! Form::label('ContactMNo','Mobile No',[ 'class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('ContactMNo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Mobile No','title' => 'Mobile No']) !!}
        {!! $errors->first('ContactMNo', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('ContactPhNo') ? 'has-error' : '' }}">
    {!! Form::label('ContactPhNo','Phone No',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('ContactPhNo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100',  'placeholder' =>'Enter Phone No','title' => 'Phone No']) !!}
        {!! $errors->first('ContactPhNo', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('PacketTypeID') ? 'has-error' : '' }}">
    {!! Form::label('PacketTypeID','Packet Type',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('PacketTypeID',$PacketType,null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Select Packet Type','title' => 'Packet Type']) !!}
        {!! $errors->first('PacketTypeID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('GSTNO') ? 'has-error' : '' }}">
    {!! Form::label('GSTNO','GST NO',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('GSTNO',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Gst No','title' => 'Gst No']) !!}
        {!! $errors->first('GSTNO', '<p class="help-block">:message</p>') !!}
	</div>
</div>
