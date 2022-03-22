@extends('layouts.app')

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
				<form name="frmEntryID" id="frmEntryID" method="post" action="{{ route('UploadClientData.TranMenu.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="col-sm-12">
						<h3 style="text-align: center;">UPLOAD CLIENT DATA FROM EXCEL FILE</h3>
						
						 <div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="select_file">BROWSE EXCEL FILE</label>
									<!--input type="file" name="excel_file" id="excel_file" accept="*.xls|*.xlsx" class="form-control"-->
									<input type="file" required="" name="select_file" id="select_file" class="form-control" accept=".xls,.xlsx">
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

@endsection

@section('footer')
  <h2 align="center">Footer Page</h2>
@endsection


