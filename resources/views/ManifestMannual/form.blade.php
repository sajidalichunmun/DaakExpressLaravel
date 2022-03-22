<div class="row">
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('txtPrevPodNo') ? 'has-error' : '' }}">
		{!! Form::label('txtPrevPodNo','PREVIOUS AWB NO',) !!}
			{!! Form::text('txtPrevPodNo', $prevpodno, ['class' => 'form-control',  'readonly' => true,'required' => true, 'placeholder' =>'Previous Pod No','title' => 'Previous Pod']) !!}
			{!! $errors->first('txtPrevPodNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('txtPrevCustName') ? 'has-error' : '' }}">
			{!! Form::label('txtPrevCustName','PREVIOUS CUSTOMER NAME',) !!}
			{!! Form::text('txtPrevCustName',$customername, ['class' => 'form-control',  'readonly' => true, 'required' => true, 'placeholder' =>'Previous Customer Name','title' => 'Customer']) !!}
			{!! $errors->first('txtPrevCustName', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="form-group {{ $errors->has('scandate') ? 'has-error' : '' }}">
		{!! Form::label('scandate','MANIFEST DATE',) !!}
			{!! Form::text('scandate',date('Y-m-d'), ['class' => 'form-control',  'readonly' => true, 'required' => true, 'placeholder' =>'Enter City Name','title' => 'City Name']) !!}
			{!! $errors->first('scandate', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('FranID') ? 'has-error' : '' }}">
		{!! Form::label('FranID','FRANCHISEE',) !!}
			{!! Form::select('FranID',['' => 'Selrct Franchisee'] + $franchisee, $prevfranid, ['id' => 'FranID', 'class' => 'form-control', 'required' => true, 'title' => 'Franchisee']) !!}
			{!! $errors->first('FranID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('AwbNo') ? 'has-error' : '' }}">
			{!! Form::label('AwbNo','POD NUMBER',) !!}
			{!! Form::text('AwbNo',null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Enter Pod No','title' => 'Pod No']) !!}
			{!! $errors->first('AwbNo', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	
</div>
