@extends('layouts.app')

@section('content')

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">UPLOAD PRE ASSIGNED POD DATA FROM EXCEL FILE</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('UploadPreAssignedPod.TranMenu.index') }}" class="btn btn-primary" title="Show All Client Data">
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

            <form name="frmEntryID" id="frmEntryID" method="post" action="{{ route('UploadPreAssignedPod.TranMenu.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="txtMajorNameID">CLIENT MAJOR NAME</label>
									<input type="text" class="form-control"  name="txtMajorNameID" id="txtMajorNameID" readonly="">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="txtClientCode">CLIENT NAME</label>
									{!! Form::select('ClientCodeID',['' => 'Select Client Name'] + $client,null, ['id' => 'ClientCodeID', 'class' => 'form-control',  'required' => true, 'title' => 'Client']) !!}
									{!! $errors->first('ClientCodeID', '<p class="help-block">:message</p>') !!}
								</div>
							</div>
						</div>
						 <div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="select_file">BROWSE EXCEL FILE</label>
									<input type="file" required="" name="select_file" id="select_file" class="form-control" accept=".xls,.xlsx">
								</div>
							</div>
						</div>
						<div class="row pull-right">
							<button name="btnResetID" id="btnResetID" type="reset" class="btn btn-info" style="margin-top: 25px;">Reset</button>                                            
							<button name="btnSaveID" id="btnSaveID" type="submit" class="btn btn-primary" style="margin-top: 25px;" onclick="return ValidateControls();">UPLOAD DATA</button>
						</div>
					</div>
 				</form>
        </div>
    </div>

@endsection



@section('script')

<!--link rel="stylesheet" href="http://www.expertphp.in/css/bootstrap.css">    
<script src="http://demo.expertphp.in/js/jquery.js"></script-->
	
<script type="text/javascript">
    $('#ClientCodeID').change(function(){
		
    var ClientID = $(this).val();    

    if(ClientID){
        $.ajax({
           type:"GET",
           url:"{{ url('api/get-major-name')}}?ClientID="+ClientID,
           success:function(res){               
            if(res){
                $("#txtMajorNameID").empty();
                $.each(res,function(key,value){

                    $("#txtMajorNameID").val(key);
                });
           
            }else{
               $("#txtMajorNameID").empty();
            }
           }
        });
    }else{
        $("#txtMajorNameID").empty();
    }      
   });
  
</script>

@endsection
