

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
    {!! Form::label('user_id','User',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('user_id',$Users,null, ['class' => 'form-control', 'placeholder' => 'Select user', ]) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('menu_id') ? 'has-error' : '' }}">
    {!! Form::label('menu_id','Menu',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('menu_id',$Menus,null, ['class' => 'form-control', 'placeholder' => 'Select menu', ]) !!}
        {!! $errors->first('menu_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('view_menu') ? 'has-error' : '' }}">
    {!! Form::label('view_menu','View Menu',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='view_menu_1'>
                {!! Form::checkbox('view_menu', '1',  (old('view_menu', isset($userMenu->view_menu) ? $userMenu->view_menu : null) == '1' ? true : null) , ['id' => 'view_menu_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('view_menu', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('create') ? 'has-error' : '' }}">
    {!! Form::label('create','Create',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='create_1'>
                {!! Form::checkbox('create', '1',  (old('create', isset($userMenu->create) ? $userMenu->create : null) == '1' ? true : null) , ['id' => 'create_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('create', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('view') ? 'has-error' : '' }}">
    {!! Form::label('view','View',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='view_1'>
                {!! Form::checkbox('view', '1',  (old('view', isset($userMenu->view) ? $userMenu->view : null) == '1' ? true : null) , ['id' => 'view_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('view', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('update') ? 'has-error' : '' }}">
    {!! Form::label('update','Update',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='update_1'>
                {!! Form::checkbox('update', '1',  (old('update', isset($userMenu->update) ? $userMenu->update : null) == '1' ? true : null) , ['id' => 'update_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('update', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('delete') ? 'has-error' : '' }}">
    {!! Form::label('delete','Delete',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='delete_1'>
                {!! Form::checkbox('delete', '1',  (old('delete', isset($userMenu->delete) ? $userMenu->delete : null) == '1' ? true : null) , ['id' => 'delete_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('delete', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('print') ? 'has-error' : '' }}">
    {!! Form::label('print','Print',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='print_1'>
                {!! Form::checkbox('print', '1',  (old('print', isset($userMenu->print) ? $userMenu->print : null) == '1' ? true : null) , ['id' => 'print_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('print', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('excel') ? 'has-error' : '' }}">
    {!! Form::label('excel','Excel',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='excel_1'>
                {!! Form::checkbox('excel', '1',  (old('excel', isset($userMenu->excel) ? $userMenu->excel : null) == '1' ? true : null) , ['id' => 'excel_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('excel', '<p class="help-block">:message</p>') !!}
    </div>
</div>

