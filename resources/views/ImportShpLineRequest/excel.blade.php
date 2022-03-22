@extends('layouts.main')

@section('content')
<div class="container-fluid text-center">    
	<div class="row content">
		<!--div class="col-sm-2 sidenav">
			<p><a href="/home"><i class="fa fa-fw fa-home"></i>HOME</a></p>
			<p><a href="#"><i class="fa fa-fw fa-about"></i>ABOUT US</a></p>
			<p><a href="#">CONTACT US<i class="fa fa-fw fa-envelope"></i></a></p>
		</div-->
		<div class="col-sm-12 text-left"> 
			<!-- center column -->
			<!-- SEARCH PANEL -->
			<!--div class="row" style="border: 2px solid yellow;margin-top: 2px;">
				<form name="frmSearch" action="frmOwnerMast.php" method="post" enctype="mulitpart/form" id="frmSearch">
					<div class="col-sm-11 col-xs-offset-0">
						<div class="form-group">
							<label for="txtSearch">SEARCH CONTAINER</label>
							<input type="text" name="txtSearch" id="txtSearchID" required="true" class="form-control text-capitalize text-justify">
						</div>
						<div id="search_result"></div>
					</div>
					<div>
					   <div class="form-group">
						   <button type="submit"  name="btnSearch" id="btnSearchOwner_ID" class="btn btn-info" style="margin-top: 25px;">FIND</button>
					   </div>
				   </div>
				</form>
			</div-->
			<!-- SEARCH BUTTON PANEL END -->
			<div class="row"  style="border:  1px solid green;box-shadow: 0 8px 6px -6px black;">
			@if(Session::has('message'))
			  <p >{{ Session::get('message') }}</p>
			@endif
			@if(count($errors) > 0)
			<div class="alert alert-danger">
			 Upload Validation Error<br><br>
			 <ul>
			  @foreach($errors->all() as $error)
			  <li>{{ $error }}</li>
			  @endforeach
			 </ul>
			</div>
		   @endif

		   @if($message = Session::get('success'))
			   <div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
					   <strong>{{ $message }}</strong>
			   </div>
		   @endif
				<!--form name="frmEntryID" id="frmEntryID" method="post" action="/uploadReleaseCont" enctype="multipart/form-data"-->
				<form name="frmEntryID" id="frmEntryID" method="post" action="/importReqData" enctype="multipart/form-data">
					@csrf
					<div class="col-sm-12">
						<h3 style="text-align: center;">IMPORTS SHIPPING LINE REQUEST DATA</h3>
						
						 <div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="select_file">BROWSE EXCEL FILE</label>
									<!--input type="file" name="excel_file" id="excel_file" accept="*.xls|*.xlsx" class="form-control"-->
									<input type="file" required="" name="select_file" id="select_file" class="form-control">
									<!--input type="file" name="excel_file" id="excel_file" accept="xls.*" class="form-control" data-rule-required="true" data-msg-accept="Your message"-->
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
			<!-- end center  column-->
			<!--div class="row" style="border: 2px solid black;margin-top: 5px;">
				<div class="col-sm-12">
					<div class="form-group">
						<button type="button" onclick="ExportToExcel('tbExport','ContainerData');" name="btnExport" id="btnExportID" class="btn btn-success" style="margin-top: 2px;margin-bottom: 2px; float: left;">Export In Excel</button>
						<form name='frmView' id='frmView' method="post" action="">
							<button type="submit"  name="btnView" id="btnViewID" class="btn btn-success" style="margin-top: 2px;margin-bottom: 2px; float: right;">View Data</button>
						</form>
					</div>
				</div>
			</div>
			<div class="row"></div>
			<div class="row"></div>
			<div class="row"></div>
			<div class="row" style="border: 2px solid black;margin-top: 5px;">
				<div class="col-sm-12">
					<div class="table-responsive" id="employee_table">
						<table id="tbExport" class="table table-dark table-bordered table-hover">
							<thead class="thead-dark">
							<tr>
								<th>SR NO</th>
								<th>Container No</th>
								<th>Shipping Line</th>
								<th>Inst By</th>
								<th>Msg By</th>
								<th>Status</th>
								<th>Created By</th>
								<th>Created On</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div-->
		</div>
	</div>
</div>
        
          

@endsection

@section('script')

<!--link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script-->

<link rel="stylesheet" href=" {{ asset('Autocomplete/ui/1.11.4/themes/smoothness/jquery-ui.css') }}">
<script src="{{ asset('Autocomplete/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('Autocomplete/ui/1.11.4/jquery-ui.js') }}"}}></script>

<script src="{{ asset('ajax/libs/jquery-validate/1.19.0/jquery.validate.js') }}"></script>  
<script src="{{ asset('ajax/libs/jquery-validate/1.19.0/additional-methods.min.js') }}"></script>
<script src="{{ asset('npm/sweetalert2@9') }}"></script>

<script src="{{ asset('DataTables/1.10.20/js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
    $(".table").DataTable();
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });
</script>

<script  type="text/javascript">

$(document).ready(function(){
    //$(".table").DataTable();
});

$('#reqno').keydown(function(event){
    if($('#reqnoID').val()!="")
    {
        $('#shippinglineID').val("");
        $('#reqid').val("");
        $('#reqsize').val("");
        $('#client').val("");
        $('#total').val("");
        $('#release').val("");
        $('#balout').val("");
        $('#status').val("");
        $('#shippingline').val("");
        $('#contto').val("");
    }
$('#reqno').autocomplete({
  source: "{!! URL::route('tempContOutReq/searchOutReqNo') !!}",
  /*minlength:1,*/
  autoFocus:true,
  select:function(e,ui){
    $('#reqid').val(ui.item.id);
    $('#reqno').val(ui.item.name);
    $('#reqsize').val(ui.item.size);
    $('#client').val(ui.item.client);
    $('#total').val(ui.item.total);
    $('#release').val(ui.item.out);
    $('#balout').val(ui.item.balqty);
    $('#status').val(ui.item.status);
    $('#shippingline').val(ui.item.shpline);
    $('#shippinglineID').val(ui.item.shpline);
    $('#contto').val(ui.item.destination);
    $('#conttoid').val(ui.item.destination);
    $('#select_file').focus();
  },
  error:function(data){
    alert(data);
  }
});
});


if ($("#frmEntryID1").length > 0) {
    $("#frmEntryID").validate({
    
    rules: {
      cargofrom: {
        required: true,
        maxlength: 150
      }
    },
    messages: {
      cargofrom: {
        required: "Please enter empty field",
        maxlength: "Your last name maxlength should be 150 characters long."
      }
    },
    submitHandler: function(form) {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#btnSaveID').html('Sending..');
      if(ValidateControls()==false)
      {
        $('#btnSaveID').html('Submit');
        return false;
      }
      $.ajax({
        //url: 'http://localhost/laravel-example/save-form' ,
        url: '/import',
        type: "get",
        data: $('#frmEntryID').serialize(),
		beforeSend: function(){
		   $("#frmEntryID").css("background","#FFF url(../../Images/LoaderIcon.gif) no-repeat 165px");
	    },
        success: function( response ) {
          $("#frmEntryID").css("background","#FFF");    
		  Swal.fire({
						'icon':'success',
						'title':'Message',
						'text':response.msg
					})
            $('#btnSaveID').html('UPLOAD DATA');
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
            if($.trim(response.msg).substr(0,12)==='Successfully')
			{
				document.getElementById("frmEntryID").reset(); 
			}
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
        },
		error: function(response){
          $('#btnSaveID').html('UPLOAD DATA');
          alert(response.msg);
        }
      });
    }
  });
}


$('#shippingline').keydown(function(event)
{
	if($('#shippinglineID').val() != "")
	{
		$('#shippinglineID').val('');
	}
	$('#shippingline').autocomplete
	({
		//url : "{{ route('autocomplete') }}",
		source: "{!! URL::route('TEMP_CONTAINER/autocompleteShpLine') !!}",
		minlength:1,
		autoFocus:true,
		select:function(e,ui){
		$('#shippinglineID').val(ui.item.id);
		},
		error:function(data)
		{
			alert(data);
		}
	});
});

function ValidateControls() 
{
    if($('#reqid').val()==='')
	{
        $('#reqid').focus();
        Swal.fire({
                'icon':'error',
                'title':'Message',
                'text':'Select Request No'
            })
            return false;
    }
	var excel_file=document.getElementById("select_file").value;
	if($('#select_file').val()===''){
		$('#select_file').focus();
		Swal.fire({
				'icon':'error',
				'title':'Message',
				'text':'Select Excel File'
			})
			return false;
	}
    return true;
}

</script>

@endsection

@section('footer')
  <h2 align="center">Footer Page</h2>
@endsection


