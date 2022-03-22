<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('prevpodno') ? 'has-error' : '' }}">
		{!! Form::label('prevpodno','PREVIOUS AWB NO',) !!}
			{!! Form::text('prevpodno', $prevpodno, ['class' => 'form-control',  'readonly' => true,'required' => true, 'placeholder' =>'Enter Client Code ID','title' => 'Client Code ID']) !!}
			{!! $errors->first('prevpodno', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('prevcustname') ? 'has-error' : '' }}">
			{!! Form::label('prevcustname','PREVIOUS CUSTOMER NAME',) !!}
			{!! Form::text('prevcustname', $customername, ['class' => 'form-control',  'readonly' => true, 'required' => true, 'placeholder' =>'Enter Sub Area Name','title' => 'Sub Area']) !!}
			{!! $errors->first('prevcustname', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('scandate') ? 'has-error' : '' }}">
		{!! Form::label('scandate','UPDATE DATE',) !!}
			{!! Form::text('scandate',date('Y-m-d'), ['class' => 'form-control',  'readonly' => true, 'required' => true, 'placeholder' =>'Enter City Name','title' => 'City Name']) !!}
			{!! $errors->first('scandate', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('FranID') ? 'has-error' : '' }}">
		{!! Form::label('FranID','FRANCHISEE',) !!}
			{!! Form::select('FranID',$franchisee, $prevfranid, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Franchisee','title' => 'Franchisee']) !!}
			{!! $errors->first('FranID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
		{!! Form::label('status','STATUS OF AWB',) !!}
			{!! Form::select('status',$status, null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Status','title' => 'Status']) !!}
			{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('AwbNo') ? 'has-error' : '' }}">
			{!! Form::label('AwbNo','POD NUMBER',) !!}
			{!! Form::text('AwbNo',null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Enter Pod No','title' => 'Pod No']) !!}
			{!! $errors->first('AwbNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('RecName') ? 'has-error' : '' }}">
			{!! Form::label('RecName','RECIVER NAME',) !!}
			{!! Form::text('RecName',null, ['class' => 'form-control', 'disabled' => true, 'minlength' => '1', 'maxlength' => '150', 'placeholder' =>'Enter Receiver Name','title' => 'Receiver']) !!}
			{!! $errors->first('RecName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('Relation') ? 'has-error' : '' }}">
			{!! Form::label('Relation','RELATION',) !!}
			{!! Form::select('Relation',$relation, null, ['class' => 'form-control', 'disabled' => true, 'minlength' => '4', 'maxlength' => '150', 'placeholder' =>'Select Relation','title' => 'Relation']) !!}
			{!! $errors->first('Relation', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('PhoneNo') ? 'has-error' : '' }}">
			{!! Form::label('PhoneNo','PHONE NO',) !!}
			{!! Form::number('PhoneNo',null, ['class' => 'form-control', 'disabled' => true, 'minlength' => '10', 'maxlength' => '10', 'placeholder' =>'Enter Mobile No','title' => 'Mobile No']) !!}
			{!! $errors->first('PhoneNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group {{ $errors->has('Reason') ? 'has-error' : '' }}">
		{!! Form::label('Reason','REASON',) !!}
			{!! Form::select('Reason',$reason, null, ['class' => 'form-control', 'disabled' => true, 'required' => true, 'placeholder' =>'Select Reason','title' => 'Reason']) !!}
			{!! $errors->first('Reason', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>
