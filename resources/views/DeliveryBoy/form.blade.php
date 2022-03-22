<div class="form-group {{ $errors->has('Name') ? 'has-error' : '' }}">
    {!! Form::label('Name','Delivery Boy',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Delivery Boy','title' => 'Delivery Boy']) !!}
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('FRANID') ? 'has-error' : '' }}">
    {!! Form::label('FRANID','Franchisee Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('FRANID',$franchisee,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Franchisee..','title' => 'Franchisee']) !!}
        {!! $errors->first('FRANID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('MobileNo') ? 'has-error' : '' }}">
    {!! Form::label('MobileNo','Delivery Boy',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('MobileNo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '10', 'required' => true, 'placeholder' =>'Enter Mobile No','title' => 'Mobile No']) !!}
        {!! $errors->first('MobileNo', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('USERID') ? 'has-error' : '' }}">
    {!! Form::label('USERID','User Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('USERID',$creator,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select User Name..','title' => 'User Name']) !!}
        {!! $errors->first('USERID', '<p class="help-block">:message</p>') !!}
	</div>
</div>
