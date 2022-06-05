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
	<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
<!-- SEARCH PANEL -->
<div class="row">
	<form name="frmSearch" action="{{ route('city_search') }}" method="get" enctype="mulitpart/form" id="frmSearch">
		<div class="col-sm-11 col-xs-offset-0">
			<div class="form-group">
				<label for="txtSearchID">SEARCH</label>
				<input type="text" name="txtSearchID" value="{{ $find ?? '' }}" placeholder="Enter city name" id="txtSearchID" required="true" class="form-control text-capitalize text-justify">
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
                <h4 class="mt-5 mb-5">City</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
			<button type="button" onclick="ExportToExcel('tbExport','Export');" name="btnExport" id="btnExportID" class="btn btn-info btn-sm mt-3"  title="Export Data"> <span class="fa fa-download" aria-hidden="true"></span> Export in Excel</button>
				&nbsp;
                <a href="{{ route('City.Mast.create') }}" class="btn btn-success btn-sm" title="Create New City">
                    <span class="fa fa-plus" aria-hidden="true"></span> Create
                </a> 

            </div>

        </div>
        
        @if(count($result) == 0)
            <div class="panel-body text-center">
                <h4>No City Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
			<div class="row">
				<div class="table-responsive" id="employee_table">
					<table class="table table-striped" id="tbExport">
						<thead class="thead-dark">
							<tr>
								<th>City Name</th>
								<th>State Name</th>
								<th>Country Name</th>
								<th>CREATED BY</th>
								<th>CREATED ON</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($result as $v)
							<tr>
								<td>{{ $v->Name }}</td>
								<td>{{ $v->State->Name }}</td>
								<td>{{ $v->State->Country->Name }}</td>
								<td>{{ $v->CreatedBy }}</td>
								<td>{{ $v->CreatedOn }}</td>
								
								<td>

									{!! Form::open([
										'method' =>'DELETE',
										'route'  => ['City.Mast.destroy', $v->ID],
										'style'  => 'display: inline;',
									]) !!}
										<div class="btn-group btn-group-xs pull-right" role="group">
											<a href="{{ route('City.Mast.show', $v->ID ) }}" class="btn btn-success" title="Show SingleInvoice">
												<span class="fa fa-eye" aria-hidden="true"></span>
											</a>
											<a href="{{ route('City.Mast.edit', $v->ID ) }}" class="btn btn-primary" title="Edit SingleInvoice">
												<span class="fa fa-pencil" aria-hidden="true"></span>
											</a>

											{!! Form::button('<span class="fa fa-trash" aria-hidden="true"></span>', 
												[   
													'type'    => 'submit',
													'class'   => 'btn btn-danger',
													'title'   => 'Delete City',
													'onclick' => 'return confirm("' . 'Click Ok to delete City.' . '")'
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

@endsection
