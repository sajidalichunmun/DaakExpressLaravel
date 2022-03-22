
<div class="form-group {{ $errors->has('TENT_ID') ? 'has-error' : '' }}">
	{!! Form::label('TENT_ID','TENANT NAME',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::select('TENT_ID',$tenant,null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' => 'Select Tenant here...', ]) !!}
		{!! $errors->first('TENT_ID', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>

<div class="form-group {{ $errors->has('CRN_DATE') ? 'has-error' : '' }}">
	{!! Form::label('CRN_DATE','RECEIPT DATE',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::date('CRN_DATE',date('Y-m-d'), ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' => 'Select Tenant here...', ]) !!}
		{!! $errors->first('CRN_DATE', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>

<div class="form-group {{ $errors->has('CRN_CURRENCY') ? 'has-error' : '' }}">
	{!! Form::label('CRN_CURRENCY','CURRENCY',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::select('CRN_CURRENCY',$currency,null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Currency here...', ]) !!}
		{!! $errors->first('CRN_CURRENCY', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>
<div class="form-group {{ $errors->has('CRN_PAYMODE') ? 'has-error' : '' }}">
	{!! Form::label('CRN_PAYMODE','PAYMENT MODE',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::select('CRN_PAYMODE',$PaymentMode,null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Select Payment Mode here...', ]) !!}
		{!! $errors->first('CRN_PAYMODE', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>

<div class="form-group {{ $errors->has('CRN_AMOUNT') ? 'has-error' : '' }}">
	{!! Form::label('CRN_AMOUNT','PAID AMOUNT',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::number('CRN_AMOUNT',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'required' => true, 'placeholder' => 'Enter Amount here...', ]) !!}
		{!! $errors->first('CRN_AMOUNT', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>

<div class="form-group {{ $errors->has('CRN_CHQNO') ? 'has-error' : '' }}">
	{!! Form::label('CRN_CHQNO','CHEQUE NO',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::text('CRN_CHQNO',null, ['class' => 'form-control', 'minlength' => '1', 'readonly' => 'true', 'placeholder' => 'Enter Cheque No here...', ]) !!}
		{!! $errors->first('CRN_CHQNO', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>


<div class="form-group {{ $errors->has('CRN_APPBY') ? 'has-error' : '' }}">
	{!! Form::label('CRN_APPBY','APPROVED BY',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::text('CRN_APPBY',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' => 'Approved By here...', ]) !!}
		{!! $errors->first('CRN_APPBY', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>

<div class="form-group {{ $errors->has('CRN_NARRATION') ? 'has-error' : '' }}">
	{!! Form::label('CRN_NARRATION','NARRATION',['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-10">
		{!! Form::text('CRN_NARRATION',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '250', ]) !!}
		{!! $errors->first('CRN_NARRATION', '<p class="help-block">:message</p>') !!}
	</div>
	
</div>