@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($menu->name) ? $menu->name : 'Menu' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['menus.menu.destroy', $menu->id]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('menus.menu.index') }}" class="btn btn-primary" title="Show All Menu">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('menus.menu.create') }}" class="btn btn-success" title="Create New Menu">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('menus.menu.edit', $menu->id ) }}" class="btn btn-primary" title="Edit Menu">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Menu',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Menu.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Menu</dt>
            <dd>{{ isset($menu->menu->id) ? $menu->menu->id : '' }}</dd>
            <dt>Name</dt>
            <dd>{{ $menu->name }}</dd>
            <dt>Controller</dt>
            <dd>{{ $menu->controller }}</dd>
            <dt>Icon</dt>
            <dd>{{ $menu->icon }}</dd>
            <dt>Url</dt>
            <dd>{{ $menu->url }}</dd>
            <dt>Sort Order</dt>
            <dd>{{ $menu->sort_order }}</dd>
            <dt>Created At</dt>
            <dd>{{ $menu->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $menu->updated_at }}</dd>
            <dt>Created By</dt>
            <dd>{{ isset($menu->creator->name) ? $menu->creator->name : '' }}</dd>
            <dt>Updated By</dt>
            <dd>{{ isset($menu->updater->name) ? $menu->updater->name : '' }}</dd>
            <dt>Mega</dt>
            <dd>{{ $menu->mega }}</dd>

        </dl>

    </div>
</div>

@endsection