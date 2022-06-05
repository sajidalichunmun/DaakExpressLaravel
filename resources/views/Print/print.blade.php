@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Print AWB NO</h4>
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

            <div class="row" style="margin-top: 10px; box-shadow: 10px 10px 10px red;border: 10px solid skyblue;width: 50%;align-content: center;margin-left:25%;">
				<div class="col-sm-12">
					<h2 class="text-center">PRINT AWB NO</h2>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<hr style="border: 1px solid green;width: 100%;">
					</div>
				</div>
				<div class="row">
					<!-- <form class="form-horizontal" method="get" action="{{ route('Print.TranMenu.create') }}">     -->
					<!--form class="form-horizontal" method="post" action="awbprint.php"-->    
					
					<form action="{{ route('Print.TranMenu.show') }}" method="post">
                	@csrf
						<div class="col-sm-12">
							<label for="from" class="form-control">POD NO FROM</label>
							<div class="col-sm-12">
								<input id="from" name="from" autocomplete="OFF" type="text" class="form-control" value="P000000016" required="">
							</div>
						</div>
						<div class="col-sm-12">
							<label for="to" class="form-control">POD NO TO</label>
							<div class="col-sm-12">
								<input id="to" name="to" autocomplete="OFF" type="text" class="form-control" value="P000000016" required="">
							</div>
						</div>
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary btn-group-lg">Print</button>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>

@endsection

