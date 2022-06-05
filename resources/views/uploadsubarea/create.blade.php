@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">UPDATE SUBAREA FROM EXCEL FILE</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('uploadsubarea.TranMenu.index') }}" class="btn btn-primary" title="Show All Client Data">
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

            <form name="frmEntryID" id="frmEntryID" method="post" action="{{ route('uploadsubarea.TranMenu.store') }}" enctype="multipart/form-data">
					@csrf
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
    
</script>

@endsection
