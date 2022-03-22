
<div class="form-group {{ $errors->has('FranID') ? 'has-error' : '' }}">
    {!! Form::label('FranID','Franchisee Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('FranID',$franchisee,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Franchisee...','title' => 'Franchisee']) !!}
        {!! $errors->first('FranID', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('RATE') ? 'has-error' : '' }}">
    {!! Form::label('RATE','Franchisee Rate',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('RATE',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '100', 'required' => true, 'placeholder' =>'Enter Franchisee Rate','title' => 'Franchisee Rate']) !!}
        {!! $errors->first('RATE', '<p class="help-block">:message</p>') !!}
	</div>
</div>
