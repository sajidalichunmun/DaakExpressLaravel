
<div class="form-group {{ $errors->has('menu_id') ? 'has-error' : '' }}">
    {!! Form::label('menu_id','Menu') !!}

        {!! Form::select('menu_id',$menus,null, ['class' => 'form-control', 'placeholder' => 'Select menu', ]) !!}
        {!! $errors->first('menu_id', '<p class="help-block">:message</p>') !!}

</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name','Name') !!}

        {!! Form::text('name',null, ['class' => 'form-control', 'minlength' => '1', 'maxlength' => '50', 'required' => true, 'placeholder' => 'Enter name here...', ]) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}

</div>



<div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
    {!! Form::label('icon','Icon') !!}

        {!! Form::text('icon',null, ['class' => 'form-control', 'maxlength' => '50', 'placeholder' => 'Enter icon here...', ]) !!}
        {!! $errors->first('icon', '<p class="help-block">:message</p>') !!}

</div>

<div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
    {!! Form::label('url','Url') !!}

        {!! Form::text('url',null, ['class' => 'form-control', 'maxlength' => '50', 'placeholder' => 'Enter url here...', ]) !!}
        {!! $errors->first('url', '<p class="help-block">:message</p>') !!}

</div>

<div class="form-group {{ $errors->has('sort_order') ? 'has-error' : '' }}">
    {!! Form::label('sort_order','Sort Order') !!}

        {!! Form::number('sort_order',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter sort order here...', ]) !!}
        {!! $errors->first('sort_order', '<p class="help-block">:message</p>') !!}

</div>




