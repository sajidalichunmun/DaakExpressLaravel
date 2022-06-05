@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($result->Name) ? $result->Name : 'result' }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('SubArea.Mast.index') }}" class="btn btn-primary" title="Show All Sub Area">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('SubArea.Mast.create') }}" class="btn btn-primary" title="Create New Sub Area">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
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

            {!! Form::model($result, [
                'method' => 'PUT',
                'route' => ['SubArea.Mast.update', $result->ID],
                'class' => 'form-horizontal',
                'name' => 'edit_result_form',
                'id' => 'edit_result_form',
                
            ]) !!}

            @include ('SubArea.form', ['result' => $result,])

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                </div>
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
                $("#CityID").append('<option value="">Select city name ...</option>');
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

