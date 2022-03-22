<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Relation',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Relation','title' => 'Relation']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>

