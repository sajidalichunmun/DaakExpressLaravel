<div class="form-group {{ $errors->has('CountryID') ? 'has-error' : '' }}">
    {!! Form::label('CountryID','Country Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('CountryID',$Country,$result->City->State->Country->id ?? null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select country name ...','title' => 'Country']) !!}
        {!! $errors->first('CountryID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('StateID') ? 'has-error' : '' }}">
    {!! Form::label('StateID','State Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
                @if($result !== null)
                        {!! Form::select('StateID',$State,$result->City->State->id ?? null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select state name ...','title' => 'Country']) !!}
                @else
                        <select name="StateID" id="StateID" class="form-control" style="width:100%"  required=true;>
                        </select>
                @endif
                {!! $errors->first('StateID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('CityID') ? 'has-error' : '' }}">
    {!! Form::label('CityID','City Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        
                @if($result !== null)
                        {!! Form::select('CityID',$City,$result->City->id ?? null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select city name ...','title' => 'Country']) !!}
                @else
                        <select name="CityID" id="CityID" class="form-control" style="width:100%" required=true;>
                        </select>
                @endif
                {!! $errors->first('CityID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Sub Area',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Sub Area','title' => 'Sub Area']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{ $errors->has('MainAreaName') ? 'has-error' : '' }}">
    {!! Form::label('MainAreaName','Main Area Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('MainAreaName',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Main Area Name','title' => 'Main Area']) !!}
        {!! $errors->first('MainAreaName', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Pincode') ? 'has-error' : '' }}">
    {!! Form::label('Pincode','Pin Code',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('Pincode',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '6', 'required' => true, 'placeholder' =>'Enter Pin Code','title' => 'Pin code']) !!}
        {!! $errors->first('Pincode', '<p class="help-block">:message</p>') !!}
	</div>
</div>
