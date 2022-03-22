<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Packet Type',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Packet Type','title' => 'Packet Type']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{ $errors->has('PacketTypeShortCode') ? 'has-error' : '' }}">
    {!! Form::label('PacketTypeShortCode','Packet Code',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('PacketTypeShortCode',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '20', 'required' => true, 'placeholder' =>'Enter Packet Code','title' => 'Packet Code']) !!}
        {!! $errors->first('PacketTypeShortCode', '<p class="help-block">:message</p>') !!}
	</div>
</div>
