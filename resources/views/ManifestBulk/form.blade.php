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
