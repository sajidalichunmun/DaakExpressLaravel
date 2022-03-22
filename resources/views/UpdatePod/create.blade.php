@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Delivery</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('UpdatePod.TranMenu.index') }}" class="btn btn-primary" title="Show All Delivery">
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
                'route' => 'UpdatePod.TranMenu.store',
                'class'=>'form-horizontal',
                'name' => 'create_Updat Pod_form',
                'id' => 'create_Updat Pod_form',
                
                ])
            !!}

            @include ('UpdatePod.form', ['result' => null,])
            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


@section('script')


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

<script type="text/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

document.getElementById('AwbNo').addEventListener('keydown', function(event) {
    //alert(event.keyCode);
    var pincode='';
    if (event.keyCode == 13) 
    {
        $('#prevcustname').val('');
        event.preventDefault();
        var id=$('#AwbNo').val();
        if(id==='')
        {
            return;
        }
        $.ajax({
            type: 'POST',
            url: '{{ route("searchAjax/searchPodUpdation") }}',
           data: {
				_token: CSRF_TOKEN,
               search: id
			},
            dataType: 'json',
            beforeSend: function(){
                $("#AwbNo").css("background","#FFF url({{ asset('Images/LoaderIcon.gif') }} no-repeat 165px");
            },
            success: function(response){
                $("#AwbNo").css("background","#FFF");
                var len = response.length;
                if (len > 0)
                {
                    for (var i = 0; i < len; i++)
                    {
                        var podno=response[i]["AwbNo"];
                        if(response[i]['Status']=='Record not found')
                        {
                            Swal.fire({
                                'icon':'error',
                                'title':'Message',
                                'text':response[i]['Status']
                            })
                            $('#AwbNo').val('');
                            break;
                        }
                        if(response[i]['Status']=='DELIVERED')
                        {
                            Swal.fire({
                                'icon':'success',
                                'title':'Successful',
                                'text': podno +' already '+ response[i]['Status'] 
                            })
                            $('#txtRefnoID').val('');
                            break;
                        }
                        //alert(pincode);
                        $('#prevcustname').val(response[i]['CustomerName']);
                        if(i==(len-1))
                        {
                            $('#RecName').focus();
                        }
                    }
                }
            },
            error:function(response){
                $("#AwbNo").css("background","#FFF");
            }
        });
    }
    else if(event.keyCode==8) 
    {
        //clear control
        $('#prevcustname').val('');
    }
});


        $("#status").change(function () {
            
            $("#RecName").attr("disabled", "disabled");
            $("#Relation").attr("disabled", "disabled");
            $("#PhoneNo").attr("disabled", "disabled");
            $("#Reason").attr("disabled","disabled");

			$("#RecName").removeAttr("required");
            $("#Relation").removeAttr("required");
            $("#PhoneNo").removeAttr("required");
				
            if ($(this).val() == 1) {
                $("#RecName").removeAttr("disabled");
                $("#Relation").removeAttr("disabled");
                $("#PhoneNo").removeAttr("disabled");
				
				$("#RecName").attr("required","true");
                $("#Relation").attr("required","true");
                $("#PhoneNo").attr("required","true");
				
                $("#AwbNo").focus();
            } 
            else if ($(this).val() == 2) {
                $("#Reason").removeAttr("disabled");
				$("#Reason").attr("required","true");
                $("#Reason").focus();
            }
            else if ($(this).val() == 3) {
                $("#Reason").removeAttr("disabled");
				$("#Reason").attr("required","true");
                $("#Reason").focus();
            }
        });
</script>
@endsection

