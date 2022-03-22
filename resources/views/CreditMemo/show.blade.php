@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($result->CRN_NO) ? $result->CRN_NO : 'CreditMemo' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['CreditMemo.TranMenu.destroy', $result->CRN_NO]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('CreditMemo.TranMenu.index') }}" class="btn btn-primary" title="Show All Receipt">
                        <span class="fa fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('CreditMemo.TranMenu.create') }}" class="btn btn-success" title="Create New Receipt">
                        <!--span class="fa fa-plus" aria-hidden="true"></span-->
						Create
                    </a>

                    <a href="{{ route('CreditMemo.TranMenu.edit', $result->CRN_NO ) }}" class="btn btn-primary" title="Edit Receipt">
                        <span class="fa fa-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="fa fa-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete CreditMemo',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Receipt.' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Credit No</dt>
            <dd>{{ $result->CRN_NO }}</dd>
			<dt>Tenant Name</dt>
            <dd>{{ $result->tenant->TENT_NAME }}</dd>
			<dt>Flat/Shop</dt>
            <dd>{{ $result->tenant->FlatName->FlatName }}</dd>
			<dt>Status</dt>
            <dd>{{ $result->tenant->TENT_STATUS }}</dd>
			<dt>Credit Date</dt>
            <dd>{{ $result->CRN_DATE }}</dd>
			<dt>Payment Mode</dt>
            <dd>{{ $result->paymode->payment_mode }}</dd>
			<dt>Currency</dt>
            <dd>{{ $result->Currency->name }}</dd>
			<dt>Amount</dt>
            <dd>{{ $result->CRN_AMOUNT }}</dd>
			<dt>Cheque No</dt>
            <dd>{{ $result->CRN_CHQNO }}</dd>
			<dt>Approved By</dt>
            <dd>{{ $result->CRN_APPBY }}</dd>
			<dt>Narration</dt>
            <dd>{{ $result->CRN_NARRATION }}</dd>
            <dt>Created By</dt>
            <dd>{{ $result->CreatedBy }}</dd>
			<dt>Created On</dt>
            <dd>{{ ($result->CreatedOn) }}</dd>
        </dl>

    </div>
</div>

@endsection