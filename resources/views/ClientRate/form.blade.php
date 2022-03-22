<div class="form-group {{ $errors->has('ClientID') ? 'has-error' : '' }}">
    {!! Form::label('ClientID','Client Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('ClientID',$client,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Client Name..','title' => 'Client']) !!}
        {!! $errors->first('ClientID', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{ $errors->has('Rate') ? 'has-error' : '' }}">
    {!! Form::label('Rate','Client Rate',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('Rate',null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Enter Rate','title' => 'Rate']) !!}
        {!! $errors->first('Rate', '<p class="help-block">:message</p>') !!}
	</div>
</div>
