<div class="row">
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('ClientCodeID') ? 'has-error' : '' }}">
		{!! Form::label('ClientCodeID','Client ID',) !!}
			{!! Form::text('ClientCodeID', isset($result) ? $result->ClientCode->id : $prevclientid, ['class' => 'form-control', 'readonly' => true, 'required' => true, 'placeholder' =>'Enter Client Code ID','title' => 'Client Code ID']) !!}
			{!! $errors->first('ClientCodeID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('SubCityID') ? 'has-error' : '' }}">
			{!! Form::label('SubCityID','Sub City ID',) !!}
			{!! Form::text('SubCityID',isset($result) ? $result->SubCityName->id : null, ['class' => 'form-control', 'readonly' => true, 'required' => true, 'placeholder' =>'Enter Sub Area Name','title' => 'Sub Area']) !!}
			{!! $errors->first('SubCityID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('CityID') ? 'has-error' : '' }}">
		{!! Form::label('CityID','City ID',) !!}
			{!! Form::text('CityID',isset($result) ? $result->SubCityName->City->id : null, ['class' => 'form-control', 'readonly' => true, 'required' => true, 'placeholder' =>'Enter City Name','title' => 'City Name']) !!}
			{!! $errors->first('CityID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('StateID') ? 'has-error' : '' }}">
		{!! Form::label('StateID','State ID',) !!}
			{!! Form::text('StateID',isset($result) ? $result->SubCityName->City->State->id : null, ['class' => 'form-control', 'readonly' => true, 'required' => true, 'placeholder' =>'Enter State Name','title' => 'State']) !!}
			{!! $errors->first('StateID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('majorname') ? 'has-error' : '' }}">
		{!! Form::label('majorname','CLIENT MAJOR NAME',) !!}
		
			{!! Form::text('majorname',isset($result) ? $result->ClientCode->MajorResult->Name : $prevmajorname, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'readonly' => true, 'required' => true, 'placeholder' =>'Major Name','title' => 'Major Name']) !!}
			{!! $errors->first('majorname', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('CurrentNo') ? 'has-error' : '' }}">
		{!! Form::label('CurrentNo','PREVIOUS POD NO',) !!}
		
			{!! Form::text('CurrentNo',isset($result) ? $result->AwbNo : $prevpodno , ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'readonly' => true, 'required' => true, 'placeholder' =>'Previous Pod No','title' => 'Previous Pod No']) !!}
			{!! $errors->first('CurrentNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('AwbNo') ? 'has-error' : '' }}">
		{!! Form::label('AwbNo','POD NUMBER',) !!}
		
			{!! Form::text('AwbNo',isset($result) ? $result->AwbNo : $rr, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100',  'readonly' => true, 'required' => true, 'placeholder' =>'Pod No','title' => 'Pod No']) !!}
			{!! $errors->first('AwbNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group {{ $errors->has('PodDate') ? 'has-error' : '' }}">
		{!! Form::label('PodDate','POD DATE',) !!}
		
			{!! Form::text('PodDate',isset($result) ? $result->PodDate : date('Y-m-d'), ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'readonly' => true, 'required' => true, 'placeholder' =>'Pod Date','title' => 'Pod Date']) !!}
			{!! $errors->first('PodDate', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('ClientCodeName') ? 'has-error' : '' }}">
		{!! Form::label('ClientCodeName','CLIENT NAME',) !!}
			{!! Form::text('ClientCodeName', isset($result) ? $result->ClientCode->Name : $prevclientname, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'required' => true, 'placeholder' =>'Enter Client Name','title' => 'Client Name']) !!}
			{!! $errors->first('ClientCodeName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('CustomerName') ? 'has-error' : '' }}">
		{!! Form::label('CustomerName','CUSTOMER NAME',) !!}
		
			{!! Form::text('CustomerName',isset($result) ? $result->CustomerName : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'required' => true, 'placeholder' =>'Enter Customer Name','title' => 'Customer Name']) !!}
			{!! $errors->first('CustomerName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('MobileNo') ? 'has-error' : '' }}">
		{!! Form::label('MobileNo','MOBILE NUMBER',) !!}
		
			{!! Form::number('MobileNo',isset($result) ? $result->MobileNo : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '20', 'required' => true, 'placeholder' =>'Enter Mobile No','title' => 'Mobile No']) !!}
			{!! $errors->first('MobileNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>

<div class="row">
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('Address1') ? 'has-error' : '' }}">
		{!! Form::label('Address1','ADDRESS1',) !!}
		
			{!! Form::text('Address1',isset($result) ? $result->Address1 : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'required' => true, 'placeholder' =>'Enter Address1','title' => 'Address1']) !!}
			{!! $errors->first('Address1', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('Address2') ? 'has-error' : '' }}">
		{!! Form::label('Address2','ADDRESS2',) !!}
		
			{!! Form::text('Address2',isset($result) ? $result->Address2 : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'placeholder' =>'Enter Address2','title' => 'Address2']) !!}
			{!! $errors->first('Address2', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('Pincode') ? 'has-error' : '' }}">
		{!! Form::label('Pincode','PIN CODE',) !!}
		
			{!! Form::text('Pincode',isset($result) ? $result->Pincode : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '6', 'required' => true, 'placeholder' =>'Enter Pincode','title' => 'Pin code']) !!}
			{!! $errors->first('Pincode', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('MainAreaName') ? 'has-error' : '' }}">
		{!! Form::label('MainAreaName','MAIN AREA NAME',) !!}
		
			{!! Form::text('MainAreaName',isset($result) ? $result->SubCityName->MainAreaName : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '20', 'required' => true, 'placeholder' =>'Enter MainAreaName','title' => 'Main Area']) !!}
			{!! $errors->first('MainAreaName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>
<div class="row">

	<div class="col-md-4">
		<div class="form-group {{ $errors->has('SubAreaName') ? 'has-error' : '' }}">
		{!! Form::label('SubAreaName','SUB AREA NAME',) !!}
		
			{!! Form::text('SubAreaName',isset($result) ? $result->SubCityName->Name : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '20', 'required' => true, 'placeholder' =>'Enter Sub Area Name','title' => 'Sub Area']) !!}
			{!! $errors->first('SubAreaName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('CityName') ? 'has-error' : '' }}">
		{!! Form::label('CityName','CITY NAME',) !!}
		
			{!! Form::text('CityName',isset($result) ? $result->SubCityName->City->Name : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '20', 'required' => true, 'placeholder' =>'Enter City Name','title' => 'City Name']) !!}
			{!! $errors->first('CityName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('StateName') ? 'has-error' : '' }}">
		{!! Form::label('StateName','STATE NAME',) !!}
		
			{!! Form::text('StateName',isset($result) ? $result->SubCityName->City->State->Name : null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '20', 'required' => true, 'placeholder' =>'Enter State Name','title' => 'State']) !!}
			{!! $errors->first('StateName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>

