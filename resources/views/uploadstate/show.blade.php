@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($result->RefNo1) ? $result->RefNo1 : 'result' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['uploadstate.TranMenu.destroy', $result->id]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('uploadstate.TranMenu.index') }}" class="btn btn-primary" title="Show All Client Data">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('uploadstate.TranMenu.create') }}" class="btn btn-success" title="Create New Client Data">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <!--a href="{{ route('uploadstate.TranMenu.edit', $result->id ) }}" class="btn btn-primary" title="Edit Client Data">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a-->

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Client Data',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Client Data.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>ID</dt>
            <dd>{{ $result->id }}</dd>
            <dt>Pod No</dt>
            <dd>{{ $result->Name }}</dd>
            <dt>Ref No</dt>
            <dd>{{ $result->RefNo1 }}</dd>
			<dt>Barcode No</dt>
            <dd>{{ $result->BarcodeNo }}</dd>
            <dt>Customer Name</dt>
            <dd>{{ $result->CustomerName }}</dd>
            <dt>Mobile No</dt>
            <dd>{{ $result->MobileNo }}</dd>
            <dt>Address</dt>
            <dd>{{ $result->Address1 .','. $result->Address2 .','. $result->Address3 }}</dd>
            <dt>City Name</dt>
            <dd>{{ $result->CityName }}</dd>
            <dt>State Name</dt>
            <dd>{{ $result->StateName }}</dd>
            <dt>Pin Code</dt>
            <dd>{{ $result->Pincode }}</dd>
            <dt>State</dt>
            <dd>{{ $result->Status }}</dd>
            <dt>Data Type</dt>
            <dd>{{ $result->DataType }}</dd>
            <dt>Upload Date</dt>
            <dd>{{ $result->UploadDT }}</dd>
            
            <dt>Created By</dt>
            <dd>{{ $result->CreatedBy }}</dd>
            <dt>Created On</dt>
            <dd>{{ $result->CreatedOn }}</dd>
            <dt>Updated By</dt>
            <dd>{{ $result->UpdatedBy }}</dd>
            <dt>Updated On</dt>
            <dd>{{ $result->UpdatedOn }}</dd>

        </dl>

    </div>
</div>

@endsection