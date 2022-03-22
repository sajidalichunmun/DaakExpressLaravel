<div class="form-group {{ $errors->has('SeriesID') ? 'has-error' : '' }}">
    {!! Form::label('SeriesID','Series',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('SeriesID',$series,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select Series','title' => 'Prefix']) !!}
        {!! $errors->first('SeriesID', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group {{ $errors->has('UserID') ? 'has-error' : '' }}">
    {!! Form::label('UserID','User Name',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::select('UserID',$creator,null, ['class' => 'form-control', 'required' => true, 'placeholder' =>'Select User Name','title' => 'User Name']) !!}
        {!! $errors->first('UserID', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('SeriesFrom') ? 'has-error' : '' }}">
    {!! Form::label('SeriesFrom','Start Series',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('SeriesFrom',null, ['class' => 'form-control', 'readonly' => true, 'required' => true, 'placeholder' =>'Start Series','title' => 'Series']) !!}
        {!! $errors->first('SeriesFrom', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('balSeries') ? 'has-error' : '' }}">
    {!! Form::label('balSeries','Balance Series',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::text('balSeries',null, ['class' => 'form-control', 'readonly' => true, 'required' => true, 'placeholder' =>'Bal Series','title' => 'Balance']) !!}
        {!! $errors->first('balSeries', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('SeriesTo') ? 'has-error' : '' }}">
    {!! Form::label('SeriesTo','End Series',['class' => 'col-md-2 control-label',]) !!}
	<div class="col-md-8">
        {!! Form::number('SeriesTo',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '150', 'required' => true, 'placeholder' =>'Enter end series','title' => 'end series']) !!}
        {!! $errors->first('SeriesTo', '<p class="help-block">:message</p>') !!}
	</div>
</div>
