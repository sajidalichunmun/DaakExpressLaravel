@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Sub Area</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('SubArea.Mast.index') }}" class="btn btn-primary" title="Show All Sub Area">
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
                'route' => 'SubArea.Mast.store',
                'class'=>'form-horizontal',
                'name' => 'create_SubArea_form',
                'id' => 'create_SubArea_form',
                
                ])
            !!}

            @include ('SubArea.form', ['result' => null,])
            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


@section('script');

<script type="text/javascript">
    $('#CountryID').change(function(){
    var CountryID = $(this).val();    
    if(CountryID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-state-list')}}?CountryID="+CountryID,
           success:function(res){               
            if(res){
                $("#StateID").empty();
                $("#StateID").append('<option value="">Select state name ...</option>');
                $.each(res,function(key,value){
                    $("#StateID").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#StateID").empty();
            }
           }
        });
    }else{
        $("#StateID").empty();
        $("#CityID").empty();
    }      
   });
    $('#StateID').on('change',function(){
    var StateID = $(this).val();    
    if(StateID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-city-list')}}?StateID="+StateID,
           success:function(res){               
            if(res){
                $("#CityID").empty();
                $("#CityID").append('<option value="">Select state name ...</option>');
                $.each(res,function(key,value){
                    $("#CityID").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#CityID").empty();
            }
           }
        });
    }else{
        $("#CityID").empty();
    }
        
   });
</script>

@endsection