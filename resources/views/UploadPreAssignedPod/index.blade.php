@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

<!-- SEARCH PANEL -->
<div class="row">
	<form name="frmSearch" action="{{ route('pre-assigned-pod-search') }}" method="get" enctype="mulitpart/form" id="frmSearch">
		<div class="col-sm-11 col-xs-offset-0">
			<div class="form-group">
				<label for="txtSearchID">SEARCH</label>
				<input type="text" name="txtSearchID" value="{{ $find ?? '' }}" placeholder="Enter Awb no" id="txtSearchID" required="true" class="form-control text-capitalize text-justify">
			</div>
			<div id="search_result"></div>
		</div>
		<div>
		   <div class="form-group">
			   <button type="submit"  name="btnSearch" id="btnSearchID" class="btn btn-info" style="margin-top: 25px;"  title="Search">
			   <span class="fa fa-search" aria-hidden="true"></span></button>
		   </div>
	   </div>
	</form>
</div>
<!-- SEARCH BUTTON PANEL END -->
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">UPLOAD PRE ASSIGNED POD DATA FROM EXCEL FILE</h4>
            </div>
			
            <div class="btn-group btn-group-sm pull-right" role="group">
				<button style="margin-bottom: 10px" class="btn btn-danger pull-right delete_all" data-url="{{ url('tran-upload-pre-assigned-pod/deleteAll') }}"><span class="fa fa-trash" aria-hidden="true"></span> Delete All Selected</button>
				<button type="button" onclick="ExportToExcel('tbExport','Export');" name="btnExport" id="btnExportID" class="btn btn-info btn-sm mt-3"  title="Export Data"> <span class="fa fa-download" aria-hidden="true"></span> Export in Excel</button>
                <a href="{{ route('UploadPreAssignedPod.TranMenu.create') }}" class="btn btn-success btn-sm" title="Create New Upload">
                    <span class="fa fa-plus" aria-hidden="true"></span> Create
                </a> 

            </div>

        </div>
	
        @if(count($result) == 0)
            <div class="panel-body text-center">
                <h4>No Upload Client Data Available.</h4>
            </div>
        @else
		
			<div class="panel-body panel-body-with-table">
				<div class="row">
					<div class="table-responsive" id="employee_table">
						<table class="table table-striped" id="tbExport">
							<thead class="thead-dark">
								<tr>
									<th><input type='checkbox' id='checkAll' ></th>
									<th>Pod No</th>
									<th>Ref. No</th>
									<th>Barcode No</th>
									<th>Customer Name</th>
									<th>Mobile No</th>
									<th>Address</th>
									<th>Route Date</th>
									<th>Status</th>
									<th>Franchisee Name</th>
									<th>CREATED BY</th>
									<th>CREATED ON</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($result as $v)
								<tr>
									<td><input type="checkbox" class="sub_chk" data-id="{{ $v->ID }}"></td>
									<td>{{ $v->AwbNo }}</td>
									<td>{{ $v->RefNo1 }}</td>
									<td>{{ $v->BarcodeNo }}</td>
									<td>{{ $v->CustomerName }}</td>
									<td>{{ $v->MobileNo }}</td>
									<td>{{ $v->Address1 .','. $v->address2 .','. $v->address3 }}</td>
									<td></td>
									<td>{{ $v->Status }}</td>
									<td></td>
									<td>{{ $v->CreatedBy }}</td>
									<td>{{ $v->CreatedOn }}</td>
									
									<td>

										{!! Form::open([
											'method' =>'DELETE',
											'route'  => ['UploadPreAssignedPod.TranMenu.destroy', $v->ID],
											'style'  => 'display: inline;',
										]) !!}
											<div class="btn-group btn-group-xs pull-right" role="group">
												<a href="{{ route('UploadPreAssignedPod.TranMenu.show', $v->ID ) }}" class="btn btn-success" title="Show Upload Data">
													<span class="fa fa-eye" aria-hidden="true"></span>
												</a>
												<!--a href="{{ route('UploadPreAssignedPod.TranMenu.edit', $v->ID ) }}" class="btn btn-primary" title="Edit Upload Data">
													<span class="fa fa-pencil" aria-hidden="true"></span>
												</a-->

												{!! Form::button('<span class="fa fa-trash" aria-hidden="true"></span>', 
													[   
														'type'    => 'submit',
														'class'   => 'btn btn-danger',
														'title'   => 'Delete Upload Data',
														'onclick' => 'return confirm("' . 'Click Ok to delete Upload Data.' . '")'
													])
												!!}
											</div>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>

					</div>
				</div>
			</div>
        <div class="panel-footer">
            {!! $result->render() !!}
        </div>

        @endif

    </div>

@endsection


@section('script')

<script src="{{ asset('/ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
<script src="{{ asset('/ui/1.12.1/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

<script src="{{ asset('DataTables/1.10.20/js/jquery.dataTables.min.js') }}"></script>

<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script-->
<!--meta name="csrf-token" content="{{ csrf_token() }}"-->

<script type="text/javascript">

$(document).ready(function(){
    $(".table").DataTable();
	
	$(".table").DataTable();
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });
});


function ExportToExcel(tbExport,filename=''){
                
    var downloadurl;
    var dataFileType='application/vnd.ms-excel';
    var tableSelect=document.getElementById(tbExport);
    // specifiy file name
    var tableHTMLData=tableSelect.outerHTML.replace(/ /g,"%20");

    //create download link element
    filename=filename?filename+'.xls':'export_excel_data.xls';
    //filename=filename?filename+'.xlsx':'export_excel_data.xlsx';
    downloadurl=document.createElement("a");

    document.body.appendChild(downloadurl);

    if(navigator.msSaveOrOpenBlob){
        var blob=new Blob(['\ufeff',tableHTMLData],{
            type:dataFileType
        });
        navigator.msSaveOrOpenBlob(blob,filename);
    }else{
        //create a link to the file
        downloadurl.href='data:'+ dataFileType +','+ tableHTMLData;
        // Setting the file name
        downloadurl.download =filename;
        // trigger the fuction download
        downloadurl.click();
    }
}

</script>


<script type="text/javascript">


$(document).ready(function(){

  // Check/Uncheck ALl
  
  $('#checkAll').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


  $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
	
</script>


@endsection
