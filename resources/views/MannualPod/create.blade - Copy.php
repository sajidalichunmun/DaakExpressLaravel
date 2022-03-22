@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                Create Mannual Pod
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('MannualPod.TranMenu.index') }}" class="btn btn-primary" title="Show All Mannual Pod">
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
                'route' => 'MannualPod.TranMenu.store',
                'class'=>'form-horizontal',
                'name' => 'create_MannualPod_form',
                'id' => 'create_MannualPod_form',
                
                ])
            !!}

            @include ('MannualPod.form', ['result' => null,])

            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')

<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
-->
<!-- CSS -->
<!--link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}"-->

<!-- Script -->
<!--script src="{{asset('jquery-3.3.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script-->
<!--
<script src="{{ asset('/ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
<script src="{{ asset('/ui/1.12.1/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
-->
<link rel="stylesheet" type="text/css" href="{{ asset('Autocomplete/UI/1.11.4/themes/smoothness/jquery-ui.css')}}">
<script src="{{ asset('Autocomplete/UI/1.11.4/jquery-ui.js') }}"></script>
<script src="{{ asset('Autocomplete/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script src="{{ asset('ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>


<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<!-- Autocomplete Ajax Query
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
-->
<script type="text/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

$('#ClientCodeName').keyup(function(){
	$( "#ClientCodeName" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('searchFlatTypeAjax/searchClientCode1')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           // Set selection
		   $('#ClientCodeName').val(ui.item.label); // display the selected text	
           $('#ClientCodeID').val(ui.item.id); // display the selected text
           $('#majorname').val(ui.item.majorname); // save selected id to input
		   $('#CustomerName').focus();
           return false;
        }
      });
});

$('#Pincode').keydown(function(){
		$("#Pincode" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
		//alert(request.term);
          $.ajax({
            url:"{{ route('searchFlatTypeAjax/searchAreaName') }}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           // Set selection
			
           $('#Pincode').val(ui.item.Pincode); // display the selected text
           $('#MainAreaName').val(ui.item.MainAreaName); // save selected id to input
		   $('#StateName').val(ui.item.StateName);
		   $('#CityName').val(ui.item.CityName);
		   $('#SubAreaName').val(ui.item.SubAreaName);
		   $('#StateID').val(ui.item.StateID);
		   $('#CityID').val(ui.item.CityID);
		   $('#SubCityID').val(ui.item.id);
		   $('.btn').focus();
           return false;
        }
      });
});
});

</script>

@endsection
