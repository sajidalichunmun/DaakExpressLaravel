

<div class="form-group {{ $errors->has('role_name') ? 'has-error' : '' }}">
    {!! Form::label('role_name','Role Name',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('role_name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' => 'Enter role name here...', ]) !!}
        {!! $errors->first('role_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    {!! Form::label('created_by','Created By',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('created_by',$creators,null, ['class' => 'form-control', 'placeholder' => 'Select created by', ]) !!}
        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('updated_by') ? 'has-error' : '' }}">
    {!! Form::label('updated_by','Updated By',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('updated_by',$updaters,null, ['class' => 'form-control', 'placeholder' => 'Select updated by', ]) !!}
        {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

