@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                Create Pod With Data
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('PodWithClientData.TranMenu.index') }}" class="btn btn-primary" title="Show All Mannual Pod">
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
                'route' => 'PodWithClientData.TranMenu.store',
                'class'=>'form-horizontal',
                'name' => 'create_MannualPod_form',
                'id' => 'create_MannualPod_form',
                
                ])
            !!}

            @include ('PodWithClientData.form', ['result' => null,])

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

<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script-->


<!-- Autocomplete Ajax Query -->

<link rel="stylesheet" type="text/css" href="{{ asset('Autocomplete/UI/1.11.4/themes/smoothness/jquery-ui.css')}}">
<script src="{{ asset('Autocomplete/UI/1.11.4/jquery-ui.js') }}"></script>
<script src="{{ asset('Autocomplete/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script src="{{ asset('ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>


<script src="{{ asset('ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
<script src="{{ asset('ui/1.12.1/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

<script src="{{ asset('ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>

<!-- Autocomplete Ajax Query End-->

<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<!--link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
<script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
-->
<script type="text/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

$('#ClientCodeName').keyup(function(){
	if($('#ClientCodeID').val() != '')
	{
		$('#ClientCodeID').val('');
	    $('#majorname').val('');
	}
	$( "#ClientCodeName" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('searchAjax/searchClientCode1')}}",
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
		   $('#RefNo').focus();
           return false;
        }
      });
});

$('#Pincode').keydown(function(){
		if($('#SubCityID').val() != '')
		{
           $('#MainAreaName').val('');
		   $('#StateName').val('');
		   $('#CityName').val('');
		   $('#SubAreaName').val('');
		   $('#StateID').val('');
		   $('#CityID').val('');
		   $('#SubCityID').val('');
		}
		$("#Pincode" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
		//alert(request.term);
          $.ajax({
            url:"{{ route('searchAjax/searchAreaName') }}",
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
		   $('#SubCityID').val(ui.item.SubCityID);
		   $('.btn').focus();
           return false;
        }
      });
});
});

</script>

<script type="text/javascript">

document.getElementById('RefNo').addEventListener('keydown', function(event) {
    $('#CustomerName').val('');
	$('#BarcodeNo').val('');
	$('#Address1').val('');
	$('#Address2').val('');
	$('#Pincode').val('');
	$('#MainAreaName').val('');
	$('#StateName').val('');
	$('#CityName').val('');
	$('#SubAreaName').val('');
	$('#StateID').val('');
	$('#CityID').val('');
	$('#SubCityID').val('');
	$('#clientexceldataid').val('');
	$('#MobileNo').val('');
    var pincode='';
    if (event.keyCode == 13) 
    {
        //onChangeRefNo();
        event.preventDefault();
        var id=$('#RefNo').val();
        
        $.ajax({
            type: 'post',
            url: '{{ route("searchAjax/searchClientDataRefNo") }}',
            data: {
				_token: CSRF_TOKEN,
               search: id
			},
            dataType: 'json',
            beforeSend: function(){
                $("#RefNo").css("background","#FFF url({{ asset('Images/LoaderIcon.gif') }}) no-repeat 165px");
            },
            success: function(response){
                /*$("#suggesstion-box").show();
                $("#suggesstion-box").html(response);*/
                $("#RefNo").css("background","#FFF");
                var len = response.length;

                if (len > 0)
                {
                    for (var i = 0; i < len; i++)
                    {
                        pincode=response[i]['Pincode'];
                        var podno=response[i]["AwbNo"];
                        if(response[i]['Status']=='Record not found')
                        {
							$('#RefNo').focus();
                            Swal.fire({
                                'icon':'error',
                                'title':'Message',
                                'text':response[i]['Status']
                                
                            })
                            $('#RefNo').val('');
                            break;
                        }
                        if(response[i]['Status']=='DONE')
                        {
							$('#RefNo').focus();
                            Swal.fire({
                                'icon':'success',
                                'title':'Successful',
                                'text':'Record already exist! '+ podno
                                
                            })
                            $('#RefNo').val('');
                            break;
                        }
                        //alert(pincode);
                        $('#CustomerName').val(response[i]['CustomerName']);
                        //$('#txtCountryNameID').val(response[i]['CountryName']);
                        $('#BarcodeNo').val(response[i]['BarcodeNo']);
                        $('#Address1').val(response[i]['Address1']);
                        $('#Address2').val(response[i]['Address2']);
                        //$('#txtAddress3ID').val(response[i]['Address3']);
                        $('#Pincode').val(response[i]['Pincode']);
                        $('#MainAreaName').val(response[i]['MainAreaName']); // save selected id to input
					    $('#StateName').val(response[i]['StateName']);
					    $('#CityName').val(response[i]['CityName']);
					    $('#SubAreaName').val(response[i]['SubAreaName']);
					    $('#StateID').val(response[i]['StateID']);
					    $('#CityID').val(response[i]['CityID']);
					    $('#SubCityID').val(response[i]['SubCityID']);
                        $('#clientexceldataid').val(response[i]['id']);
                        $('#MobileNo').val(response[i]['MobileNo']);
                        
                    }
                    if($('#Pincode').val() === '')
					{
						$('#Pincode').focus();
					}
					else
					{
						$('.btn').focus();
					}
                }
            },
            error:function(response){
                $("#RefNo").css("background","#FFF");
            }
        });
    }
});

document.getElementById('BarcodeNo').addEventListener('keydown', function(event) {
    
    var pincode='';
	$('#CustomerName').val('');
	$('#RefNo').val('');
	$('#Address1').val('');
	$('#Address2').val('');
	$('#Pincode').val('');
	$('#MainAreaName').val('');
	$('#StateName').val('');
	$('#CityName').val('');
	$('#SubAreaName').val('');
	$('#StateID').val('');
	$('#CityID').val('');
	$('#SubCityID').val('');
	$('#clientexceldataid').val('');
	$('#MobileNo').val('');
    if (event.keyCode == 13) 
    {
        //onChangeRefNo();
        event.preventDefault();
        var id=$('#BarcodeNo').val();
        
        $.ajax({
            type: 'post',
            url: '{{ route("searchAjax/searchClientDataBarcodeNo") }}',
            data: {
				_token: CSRF_TOKEN,
               search: id
			},
            dataType: 'json',
            beforeSend: function(){
                $("#BarcodeNo").css("background","#FFF url({{ asset('Images/LoaderIcon.gif') }}) no-repeat 165px");
            },
            success: function(response){
                /*$("#suggesstion-box").show();
                $("#suggesstion-box").html(response);*/
                $("#BarcodeNo").css("background","#FFF");
                var len = response.length;

                if (len > 0)
                {
                    for (var i = 0; i < len; i++)
                    {
                        pincode=response[i]['Pincode'];
                        var podno=response[i]["AwbNo"];
                        if(response[i]['Status']=='Record not found')
                        {
							$('#BarcodeNo').focus();
                            Swal.fire({
                                'icon':'error',
                                'title':'Message',
                                'text':response[i]['Status']
                                
                            })
                            $('#BarcodeNo').val('');
                            break;
                        }
                        if(response[i]['Status']=='DONE')
                        {
							$('#BarcodeNo').focus();
                            Swal.fire({
                                'icon':'success',
                                'title':'Successful',
                                'text':'Record already exist! '+ podno
                                
                            })
                            $('#BarcodeNo').val('');
                            break;
                        }
                        //alert(pincode);
                        $('#CustomerName').val(response[i]['CustomerName']);
                        //$('#txtCountryNameID').val(response[i]['CountryName']);
                        $('#RefNo').val(response[i]['RefNo']);
                        $('#Address1').val(response[i]['Address1']);
                        $('#Address2').val(response[i]['Address2']);
                        //$('#txtAddress3ID').val(response[i]['Address3']);
                        $('#Pincode').val(response[i]['Pincode']);
                        $('#MainAreaName').val(response[i]['MainAreaName']); // save selected id to input
					    $('#StateName').val(response[i]['StateName']);
					    $('#CityName').val(response[i]['CityName']);
					    $('#SubAreaName').val(response[i]['SubAreaName']);
					    $('#StateID').val(response[i]['StateID']);
					    $('#CityID').val(response[i]['CityID']);
					    $('#SubCityID').val(response[i]['SubCityID']);
                        $('#clientexceldataid').val(response[i]['id']);
                        $('#MobileNo').val(response[i]['MobileNo']);
                        
                    }
                    if($('#Pincode').val() === '')
					{
						$('#Pincode').focus();
					}
					else
					{
						$('.btn').focus();
					}
                }
            },
            error:function(response){
                $("#BarcodeNo").css("background","#FFF");
            }
        });
    }
});

</script>
@endsection
