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

<!-- SEARCH BUTTON PANEL END -->

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Pickup Summary</h4>
            </div>
        </div>
		<div class="panel-heading clearfix">
			<form name="frmEntryID" id="frmEntryID" method="get" action="{{ route('pickupsummary.reports.index') }}" enctype="multipart/form-data">
				@csrf
				<div class="col-sm-5 col-xs-offset-0">
					<div class="form-group">
					{!! Form::label('clients[]', 'Clinet') !!}
    				{!! Form::select('clients[]',$client, null, ['class' => 'form-control', 'multiple']) !!}
					</div>
					<div id="search_result"></div>
				</div>
				<div class="col-sm-3 col-xs-offset-0">
					<div class="form-group">
						<label for="fromdate">FROM DATE</label>
						<input type="date" class="form-control"  name="fromdate" id="fromdate">
					</div>
				</div>
				<div class="col-sm-3 col-xs-offset-0">
					<div class="form-group">
						<label for="todate">TO DATE</label>
						<input type="date" class="form-control" name="todate" id="todate">
					</div>
				</div>
				<div class="form-group">
					<button type="submit"  name="btnSearch" id="btnSearchID" class="btn btn-info" style="margin-top: 25px;"  title="Search">
					<span class="fa fa-search" aria-hidden="true"></span></button>
				</div>
			</form>
            <div class="btn-group btn-group-sm pull-left" role="group">
                <button type="button" onclick="ExportToExcel('tbExport','Export');" name="btnExport" id="btnExportID" class="btn btn-info btn-sm mt-3"  title="Export Data"> <span class="fa fa-download" aria-hidden="true"></span> Export in Excel</button>
            </div>
		</div>
		
        @if(count($result) == 0)
            <div class="panel-body text-center">
                <h4>No Data Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
			<div class="row">
				<div class="table-responsive" id="employee_table">
					<table class="table table-striped" id="tbExport">
						<thead class="thead-dark">
							<tr>
								<th>Sr. No</th>
								<th>TOTAL</th>
								<th>CLIENT CODE</th>
								<th>MAJOR NAME</th>
								<th>MAJOR CODE</th>
								<th>POD DATE</th>
								<th>FRANCHISEE</th>
								<th>COUNTRY NAME</th>
								<th>STATE NAME</th>
								<th>CITY NAME</th>
								<th>MAIN AREA</th>
								<th>SUB AREA</th>
								<th>PIN CODE</th>
							</tr>
						</thead>
						<tbody>
						@foreach($result as $key => $v)
							<tr>
								<td> {{ $key + 1 }} </td>
								<td> {{ $v->TOTAL }} </td>
								<td> {{ $v->CLIENTCODE }} </td>
								<td> {{ $v->MajorName }} </td>
								<td> {{ $v->MajorCode }} </td>
								<td> {{ $v->PodDate }} </td>
								<td> {{ $v->FRANNAME }} </td>
								<td> {{ $v->COUNTRYNAME }} </td>
								<td> {{ $v->STATENAME }} </td>
								<td> {{ $v->CITYNAME }} </td>
								<td> {{ $v->MAINAREANAME }} </td>
								<td> {{ $v->SUBCITY }} </td>
								<td> {{ $v->Pincode }} </td>
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

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

$('#ClientCodeID').keyup(function(){
	$( "#ClientCodeID" ).autocomplete({
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
		   $('#ClientCodeID').val(ui.item.label); // display the selected text	
		   $('#ClientCodeID').focus();
           return false;
        }
      });
});

});

</script>

@endsection

