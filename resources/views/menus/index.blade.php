@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
    <div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Menus</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('menus.menu.create') }}" class="btn btn-success" title="Create New Menu">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </a> 

            </div>

        </div>
        
        @if(count($menus) == 0)
            <div class="panel-body text-center">
                <h4>No Menus Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Name</th>
                            <th>Controller</th>
                            <th>Icon</th>
                            <th>Url</th>
                            <th>Sort Order</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Mega</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{ isset($menu->menu->id) ? $menu->menu->id : '' }}</td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->controller }}</td>
                            <td>{{ $menu->icon }}</td>
                            <td>{{ $menu->url }}</td>
                            <td>{{ $menu->sort_order }}</td>
                            <td>{{ isset($menu->creator->name) ? $menu->creator->name : '' }}</td>
                            <td>{{ isset($menu->updater->name) ? $menu->updater->name : '' }}</td>
                            <td>{{ $menu->mega }}</td>
    <td>

                                {!! Form::open([
                                    'method' =>'DELETE',
                                    'route'  => ['menus.menu.destroy', $menu->id],
                                    'style'  => 'display: inline;',
                                ]) !!}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('menus.menu.show', $menu->id ) }}" class="btn btn-info" title="Show Menu">
                                            <span class="fa fa-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('menus.menu.edit', $menu->id ) }}" class="btn btn-primary" title="Edit Menu">
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                        </a>

                                        {!! Form::button('<span class="fa fa-trash" aria-hidden="true"></span>', 
                                            [   
                                                'type'    => 'submit',
                                                'class'   => 'btn btn-danger',
                                                'title'   => 'Delete Menu',
                                                'onclick' => 'return confirm("' . 'Click Ok to delete Menu.' . '")'
                                            ])
                                        !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="panel-footer">
            {!! $menus->render() !!}
        </div>

        @endif

    </div>
@endsection