<?php
// dd($result->State->Country->id);
// dd($v->State->id);
?>
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
        {!! Form::select('CountryID',$Country,$result->State->Country->id ?? null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select country name ...','title' => 'Country']) !!}
        {!! $errors->first('CountryID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('StateID') ? 'has-error' : '' }}">
    {!! Form::label('StateID','State Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
                @if($result !== null)
                        {!! Form::select('StateID',$State,$result->State->id ?? null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select state name ...','title' => 'Country']) !!}
                @else
                        <select name="StateID" id="StateID" class="form-control" style="width:100%" required=true>
                        </select>
                @endif
                {!! $errors->first('StateID', '<p class="help-block">:message</p>') !!}
	</div>
</div>
