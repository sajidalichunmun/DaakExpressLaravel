@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Assigned Series</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('AssignedSeries.Mast.index') }}" class="btn btn-primary" title="Show All Assigned Series">
                    <span class="fa fa-th-list" aria-hidden="true"></span>
                </a>

            </div>

        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open([
                'route' => 'AssignedSeries.Mast.store',
                'class'=>'form-horizontal',
                'name' => 'create_AssignedSeries_form',
                'id' => 'create_AssignedSeries_form',
                
                ])
            !!}

            @include ('AssignedSeries.form', ['result' => null,])
            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


@section('script')
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$('#SeriesID').change(function(event)
{
	var id = document.getElementById('SeriesID').value;
		$.ajax({
		    type: 'get',
		    url: '{{ route("searchAjax/searchUserSeriesAllocation") }}',
            data: {
				_token: CSRF_TOKEN,
				search: id
			},
			dataType: 'json',
			success: function (response) {
				var len = response.length;
				if (len > 0)
				{
					for (var i = 0; i < len; i++)
					{
						$('#SeriesFrom').val(response[i]['id']);
						$('#balSeries').val(response[i]['Balance']);
					}
				}
			}
		});
});
</script>
@endsection