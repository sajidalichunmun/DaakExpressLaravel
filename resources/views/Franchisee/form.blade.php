<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Franchisee',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Franchisee','title' => 'Franchisee']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{ $errors->has('GSTNO') ? 'has-error' : '' }}">
    {!! Form::label('GSTNO','GST NO',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('GSTNO',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '30', 'required' => true, 'placeholder' =>'Enter GST NO','title' => 'GST NO']) !!}
        {!! $errors->first('GSTNO', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('PANNO') ? 'has-error' : '' }}">
    {!! Form::label('PANNO','PAN NO',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('PANNO',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '15', 'required' => true, 'placeholder' =>'Enter PAN NO','title' => 'PAN NO']) !!}
        {!! $errors->first('PANNO', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('CONTACT1') ? 'has-error' : '' }}">
    {!! Form::label('CONTACT1','CONTACT NO',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('CONTACT1',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '10', 'required' => true, 'placeholder' =>'Enter First Contact No','title' => 'Contact No']) !!}
        {!! $errors->first('CONTACT1', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('CONTACT2') ? 'has-error' : '' }}">
    {!! Form::label('CONTACT2','CONTACT NO',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('CONTACT2',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '10', 'required' => true, 'placeholder' =>'Enter Second Contact No','title' => 'Contact No']) !!}
        {!! $errors->first('CONTACT2', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('EMAILID') ? 'has-error' : '' }}">
    {!! Form::label('EMAILID','EMAIL ID',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::email('EMAILID',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '200', 'required' => true, 'placeholder' =>'Enter Email ID','title' => 'Email']) !!}
        {!! $errors->first('EMAILID', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('Pincode') ? 'has-error' : '' }}">
    {!! Form::label('Pincode','PIN CODE',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('Pincode',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '6', 'required' => true, 'placeholder' =>'Enter Pin Code','title' => 'Pincode']) !!}
        {!! $errors->first('Pincode', '<p class="help-block">:message</p>') !!}
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
        {!! Form::text('Address2',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '250', 'placeholder' =>'Enter Address2','title' => 'Address2']) !!}
        {!! $errors->first('Address2', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('SubCityID') ? 'has-error' : '' }}">
    {!! Form::label('SubCityID','CITY NAME',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('SubCityID',$city,null, ['class' => 'form-control','required' => true, 'placeholder' =>'Select City Name..','title' => 'City']) !!}
        {!! $errors->first('SubCityID', '<p class="help-block">:message</p>') !!}
	</div>
</div>
