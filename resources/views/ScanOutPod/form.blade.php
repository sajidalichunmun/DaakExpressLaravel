<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('txtPrevPodNo') ? 'has-error' : '' }}">
		{!! Form::label('txtPrevPodNo','PREVIOUS AWB NO',) !!}
			{!! Form::text('txtPrevPodNo', isset($prevpodno) ? $prevpodno : '', ['class' => 'form-control',  'readonly' => true,'required' => true, 'placeholder' =>'Previous Pod No','title' => 'Previous Pod']) !!}
			{!! $errors->first('txtPrevPodNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('txtPrevCustName') ? 'has-error' : '' }}">
			{!! Form::label('txtPrevCustName','PREVIOUS CUSTOMER NAME',) !!}
			{!! Form::text('txtPrevCustName',isset($customername) ? $customername : '', ['class' => 'form-control',  'readonly' => true, 'required' => true, 'placeholder' =>'Previous Customer Name','title' => 'Customer']) !!}
			{!! $errors->first('txtPrevCustName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('ScanOutdt') ? 'has-error' : '' }}">
		{!! Form::label('ScanOutdt','MANIFEST DATE',) !!}
			{!! Form::text('ScanOutdt',date('Y-m-d'), ['class' => 'form-control',  'readonly' => true, 'required' => true, 'title' => 'Scan Date']) !!}
			{!! $errors->first('ScanOutdt', '<p class="help-block">:message</p>') !!}
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
		<div class="form-group {{ $errors->has('dlvBoyID') ? 'has-error' : '' }}">
		{!! Form::label('dlvBoyID','DELIVERY BOY',) !!}
			{!! Form::select('dlvBoyID',$deliverboy, $dlvboyid, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Delivery Boy','title' => 'Delivery Boy']) !!}
			{!! $errors->first('dlvBoyID', '<p class="help-block">:message</p>') !!}
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
