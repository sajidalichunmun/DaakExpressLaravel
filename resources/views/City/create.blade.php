@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create City</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('City.Mast.index') }}" class="btn btn-primary" title="Show All City">
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
                'route' => 'City.Mast.store',
                'class'=>'form-horizontal',
                'name' => 'create_City_form',
                'id' => 'create_City_form',
                
                ])
            !!}

            @include ('City.form', ['result' => null,])
            <div class="form-group" align="center">
              
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection


@section('script')

<!--link rel="stylesheet" href="http://www.expertphp.in/css/bootstrap.css">    
<script src="http://demo.expertphp.in/js/jquery.js"></script-->
	
<script type="text/javascript">
    $('#CountryID').change(function(){
		
    var countryID = $(this).val();    
	
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{ url('api/get-state-list')}}?CountryID="+countryID,
           success:function(res){               
            if(res){
                $("#StateID").empty();
                $("#StateID").append('<option>Select</option>');
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
    }      
   });
  
</script>

@endsection
