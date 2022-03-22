
<div class="form-group {{ $errors->has('BranchID') ? 'has-error' : '' }}">
    {!! Form::label('BranchID','Branch Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('BranchID',$branch,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Branch Name','title' => 'Branch Name']) !!}
        {!! $errors->first('BranchID', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('Prefix') ? 'has-error' : '' }}">
    {!! Form::label('Prefix','Prefix',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('Prefix',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '5', 'required' => true, 'placeholder' =>'Enter Prefix','title' => 'Prefix']) !!}
        {!! $errors->first('Prefix', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('Length') ? 'has-error' : '' }}">
    {!! Form::label('Length','Length',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('Length',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '10', 'required' => true, 'placeholder' =>'Enter Length','title' => 'Length']) !!}
        {!! $errors->first('Length', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('SeriesFrom') ? 'has-error' : '' }}">
    {!! Form::label('SeriesFrom','Series From',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('SeriesFrom',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' =>'Enter Series From','title' => 'Series From']) !!}
        {!! $errors->first('SeriesFrom', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('SeriesTo') ? 'has-error' : '' }}">
    {!! Form::label('SeriesTo','Series To',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('SeriesTo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' =>'Enter Series To','title' => 'Series To']) !!}
        {!! $errors->first('SeriesTo', '<p class="help-block">:message</p>') !!}
	</div>
</div>
