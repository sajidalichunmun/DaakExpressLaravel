@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Proforma Invoice' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['proforma_invoices.proforma_invoice.destroy', $proformaInvoice->id]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('proforma_invoices.proforma_invoice.index') }}" class="btn btn-primary" title="Show All Proforma Invoice">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('proforma_invoices.proforma_invoice.create') }}" class="btn btn-success" title="Create New Proforma Invoice">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('proforma_invoices.proforma_invoice.edit', $proformaInvoice->id ) }}" class="btn btn-primary" title="Edit Proforma Invoice">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Proforma Invoice',
                            'onclick' => 'return confirm("' . 'Delete Proforma Invoice?' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Proforma Invoice Number</dt>
            <dd>{{ $proformaInvoice->proforma_invoice_number }}</dd>
            <dt>Invoice Category</dt>
            <dd>{{  isset($proformaInvoice->invoiceCategory->invoice_category) ? $proformaInvoice->invoiceCategory->invoice_category : ''  }}</dd>
            <dt>Terminal Invoice Detail</dt>
            <dd>{{  isset($proformaInvoice->terminalInvoiceDetail->id) ? $proformaInvoice->terminalInvoiceDetail->id : ''  }}</dd>
            <dt>Billing Of Lading</dt>
            <dd>{{  isset($proformaInvoice->billOfLading->m_bl_no) ? $proformaInvoice->billOfLading->m_bl_no : ''  }}</dd>
            <dt>Container</dt>
            <dd>{{  isset($proformaInvoice->container->m_bl_no) ? $proformaInvoice->container->m_bl_no : ''  }}</dd>
            <dt>Usd Vat Exclusive</dt>
            <dd>{{ $proformaInvoice->usd_vat_exclusive }}</dd>
            <dt>Usd Vat</dt>
            <dd>{{ $proformaInvoice->usd_vat }}</dd>
            <dt>Usd Grand Total</dt>
            <dd>{{ $proformaInvoice->usd_grand_total }}</dd>
            <dt>Tzs Vat Exclusive</dt>
            <dd>{{ $proformaInvoice->tzs_vat_exclusive }}</dd>
            <dt>Tzs Vat</dt>
            <dd>{{ $proformaInvoice->tzs_vat }}</dd>
            <dt>Tzs Grand Total</dt>
            <dd>{{ $proformaInvoice->tzs_grand_total }}</dd>
            <dt>Charges From</dt>
            <dd>{{ $proformaInvoice->charges_from }}</dd>
            <dt>Charges To</dt>
            <dd>{{ $proformaInvoice->charges_to }}</dd>
            <dt>Created At</dt>
            <dd>{{ $proformaInvoice->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $proformaInvoice->updated_at }}</dd>
            <dt>Created By</dt>
            <dd>{{  isset($proformaInvoice->creator->name) ? $proformaInvoice->creator->name : ''  }}</dd>
            <dt>Updated By</dt>
            <dd>{{  isset($proformaInvoice->updater->name) ? $proformaInvoice->updater->name : ''  }}</dd>
            <dt>Is Active</dt>
            <dd>{{ ($proformaInvoice->isActive) ? 'Yes' : 'No' }}</dd>
            <dt>Payment Mode</dt>
            <dd>{{  isset($proformaInvoice->paymentMode->payment_mode) ? $proformaInvoice->paymentMode->payment_mode : ''  }}</dd>
            <dt>Usd Rate</dt>
            <dd>{{ $proformaInvoice->usd_rate }}</dd>
            <dt>Invoice Date</dt>
            <dd>{{ $proformaInvoice->invoice_date }}</dd>
            <dt>Clearing Agent</dt>
            <dd>{{  isset($proformaInvoice->clearingAgent->agent_name) ? $proformaInvoice->clearingAgent->agent_name : ''  }}</dd>
            <dt>Tpa Ticts Proforma Invoice Number</dt>
            <dd>{{ $proformaInvoice->tpa_ticts_proforma_invoice_number }}</dd>
            <dt>Tpa Ticts Sequence No</dt>
            <dd>{{ $proformaInvoice->tpa_ticts_sequence_no }}</dd>
            <dt>Tpa Ticts Reciept No</dt>
            <dd>{{ $proformaInvoice->tpa_ticts_reciept_no }}</dd>
            <dt>Vessel</dt>
            <dd>{{  isset($proformaInvoice->vessel->id) ? $proformaInvoice->vessel->id : ''  }}</dd>
            <dt>Corridor Levy</dt>
            <dd>{{ ($proformaInvoice->corridor_levy) ? 'Yes' : 'No' }}</dd>
            <dt>Amount In Words</dt>
            <dd>{{ $proformaInvoice->amount_in_words }}</dd>
            <dt>Tzs Sub Total</dt>
            <dd>{{ $proformaInvoice->tzs_sub_total }}</dd>
            <dt>Tpa Ticts Reciept Date</dt>
            <dd>{{ $proformaInvoice->tpa_ticts_reciept_date }}</dd>
            <dt>Tax</dt>
            <dd>{{  isset($proformaInvoice->tax->id) ? $proformaInvoice->tax->id : ''  }}</dd>
            <dt>Charge To</dt>
            <dd>{{ $proformaInvoice->charge_to }}</dd>
            <dt>Free Control</dt>
            <dd>{{ ($proformaInvoice->free_control) ? 'Yes' : 'No' }}</dd>
            <dt>Tpa Ticts Removal Charges</dt>
            <dd>{{ $proformaInvoice->tpa_ticts_removal_charges }}</dd>
            <dt>Tpa Ticts Storage Charges</dt>
            <dd>{{ $proformaInvoice->tpa_ticts_storage_charges }}</dd>
            <dt>Vessel Arrival Information</dt>
            <dd>{{  isset($proformaInvoice->vesselArrivalInformation->id) ? $proformaInvoice->vesselArrivalInformation->id : ''  }}</dd>

        </dl>

    </div>
</div>

@endsection