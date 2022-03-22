<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','City',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter City','title' => 'City']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('CountryID') ? 'has-error' : '' }}">
    {!! Form::label('CountryID','Country Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('CountryID',$Country,$result->State->CountryID ?? '', ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Country Name..','title' => 'Country']) !!}
        {!! $errors->first('CountryID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('StateID') ? 'has-error' : '' }}">
    {!! Form::label('StateID','State Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('StateID',null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select State Name..','title' => 'State']) !!}
        {!! $errors->first('StateID', '<p class="help-block">:message</p>') !!}
	</div>
</div>
