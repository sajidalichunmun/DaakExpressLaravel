
<div class="form-group {{ $errors->has('proforma_invoice_number') ? 'has-error' : '' }}">
    {!! Form::label('proforma_invoice_number','Proforma Invoice Number',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('proforma_invoice_number',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => true, 'placeholder' => 'Enter proforma invoice number here...', ]) !!}
        {!! $errors->first('proforma_invoice_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('invoice_category_id') ? 'has-error' : '' }}">
    {!! Form::label('invoice_category_id','Invoice Category',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('invoice_category_id',$invoiceCategories,null, ['class' => 'form-control', 'placeholder' => 'Select invoice category', ]) !!}
        {!! $errors->first('invoice_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('terminal_invoice_detail_id') ? 'has-error' : '' }}">
    {!! Form::label('terminal_invoice_detail_id','Terminal Invoice Detail',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('terminal_invoice_detail_id',$terminalInvoiceDetails,null, ['class' => 'form-control', 'placeholder' => 'Select terminal invoice detail', ]) !!}
        {!! $errors->first('terminal_invoice_detail_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('billing_of_lading_id') ? 'has-error' : '' }}">
    {!! Form::label('billing_of_lading_id','Billing Of Lading',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('billing_of_lading_id',$billOfLadings,null, ['class' => 'form-control', 'placeholder' => 'Select billing of lading', ]) !!}
        {!! $errors->first('billing_of_lading_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('container_id') ? 'has-error' : '' }}">
    {!! Form::label('container_id','Container',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('container_id',$containers,null, ['class' => 'form-control', 'placeholder' => 'Select container', ]) !!}
        {!! $errors->first('container_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('usd_vat_exclusive') ? 'has-error' : '' }}">
    {!! Form::label('usd_vat_exclusive','Usd Vat Exclusive',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('usd_vat_exclusive',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter usd vat exclusive here...','step' => "any", ]) !!}
        {!! $errors->first('usd_vat_exclusive', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('usd_vat') ? 'has-error' : '' }}">
    {!! Form::label('usd_vat','Usd Vat',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('usd_vat',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter usd vat here...','step' => "any", ]) !!}
        {!! $errors->first('usd_vat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('usd_grand_total') ? 'has-error' : '' }}">
    {!! Form::label('usd_grand_total','Usd Grand Total',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('usd_grand_total',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter usd grand total here...','step' => "any", ]) !!}
        {!! $errors->first('usd_grand_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tzs_vat_exclusive') ? 'has-error' : '' }}">
    {!! Form::label('tzs_vat_exclusive','Tzs Vat Exclusive',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tzs_vat_exclusive',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tzs vat exclusive here...','step' => "any", ]) !!}
        {!! $errors->first('tzs_vat_exclusive', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tzs_vat') ? 'has-error' : '' }}">
    {!! Form::label('tzs_vat','Tzs Vat',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tzs_vat',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tzs vat here...','step' => "any", ]) !!}
        {!! $errors->first('tzs_vat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tzs_grand_total') ? 'has-error' : '' }}">
    {!! Form::label('tzs_grand_total','Tzs Grand Total',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tzs_grand_total',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tzs grand total here...','step' => "any", ]) !!}
        {!! $errors->first('tzs_grand_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('charges_from') ? 'has-error' : '' }}">
    {!! Form::label('charges_from','Charges From',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('charges_from',null, ['class' => 'form-control', 'placeholder' => 'Enter charges from here...', ]) !!}
        {!! $errors->first('charges_from', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('charges_to') ? 'has-error' : '' }}">
    {!! Form::label('charges_to','Charges To',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('charges_to',null, ['class' => 'form-control', 'placeholder' => 'Enter charges to here...', ]) !!}
        {!! $errors->first('charges_to', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
    {!! Form::label('created_by','Created By',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('created_by',$creators,null, ['class' => 'form-control', 'placeholder' => 'Select created by', ]) !!}
        {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('updated_by') ? 'has-error' : '' }}">
    {!! Form::label('updated_by','Updated By',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('updated_by',$updaters,null, ['class' => 'form-control', 'placeholder' => 'Select updated by', ]) !!}
        {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
    {!! Form::label('isActive','Is Active',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='isActive_1'>
                {!! Form::checkbox('isActive', '1',  (old('isActive', isset($proformaInvoice->isActive) ? $proformaInvoice->isActive : null) == '1' ? true : null) , ['id' => 'isActive_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('isActive', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('payment_mode_id') ? 'has-error' : '' }}">
    {!! Form::label('payment_mode_id','Payment Mode',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('payment_mode_id',$paymentModes,null, ['class' => 'form-control', 'placeholder' => 'Select payment mode', ]) !!}
        {!! $errors->first('payment_mode_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('usd_rate') ? 'has-error' : '' }}">
    {!! Form::label('usd_rate','Usd Rate',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('usd_rate',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter usd rate here...','step' => "any", ]) !!}
        {!! $errors->first('usd_rate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('invoice_date') ? 'has-error' : '' }}">
    {!! Form::label('invoice_date','Invoice Date',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('invoice_date',null, ['class' => 'form-control', 'placeholder' => 'Enter invoice date here...', ]) !!}
        {!! $errors->first('invoice_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('clearing_agent_id') ? 'has-error' : '' }}">
    {!! Form::label('clearing_agent_id','Clearing Agent',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('clearing_agent_id',$clearingAgents,null, ['class' => 'form-control', 'placeholder' => 'Enter clearing agent here...', ]) !!}
        {!! $errors->first('clearing_agent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tpa_ticts_proforma_invoice_number') ? 'has-error' : '' }}">
    {!! Form::label('tpa_ticts_proforma_invoice_number','Tpa Ticts Proforma Invoice Number',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('tpa_ticts_proforma_invoice_number',null, ['class' => 'form-control', 'min' => '0', 'max' => '100', 'placeholder' => 'Enter tpa ticts proforma invoice number here...', ]) !!}
        {!! $errors->first('tpa_ticts_proforma_invoice_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tpa_ticts_sequence_no') ? 'has-error' : '' }}">
    {!! Form::label('tpa_ticts_sequence_no','Tpa Ticts Sequence No',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tpa_ticts_sequence_no',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tpa ticts sequence no here...', ]) !!}
        {!! $errors->first('tpa_ticts_sequence_no', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tpa_ticts_reciept_no') ? 'has-error' : '' }}">
    {!! Form::label('tpa_ticts_reciept_no','Tpa Ticts Reciept No',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tpa_ticts_reciept_no',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tpa ticts reciept no here...', ]) !!}
        {!! $errors->first('tpa_ticts_reciept_no', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('vessel_id') ? 'has-error' : '' }}">
    {!! Form::label('vessel_id','Vessel',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('vessel_id',$vessels,null, ['class' => 'form-control', 'placeholder' => 'Select vessel', ]) !!}
        {!! $errors->first('vessel_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('corridor_levy') ? 'has-error' : '' }}">
    {!! Form::label('corridor_levy','Corridor Levy',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='corridor_levy_1'>
                {!! Form::checkbox('corridor_levy', '1',  (old('corridor_levy', isset($proformaInvoice->corridor_levy) ? $proformaInvoice->corridor_levy : null) == '1' ? true : null) , ['id' => 'corridor_levy_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('corridor_levy', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('amount_in_words') ? 'has-error' : '' }}">
    {!! Form::label('amount_in_words','Amount In Words',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('amount_in_words', null, ['class' => 'form-control', 'placeholder' => 'Enter amount in words here...', ]) !!}
        {!! $errors->first('amount_in_words', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tzs_sub_total') ? 'has-error' : '' }}">
    {!! Form::label('tzs_sub_total','Tzs Sub Total',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tzs_sub_total',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tzs sub total here...','step' => "any", ]) !!}
        {!! $errors->first('tzs_sub_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tpa_ticts_reciept_date') ? 'has-error' : '' }}">
    {!! Form::label('tpa_ticts_reciept_date','Tpa Ticts Reciept Date',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('tpa_ticts_reciept_date',null, ['class' => 'form-control', 'placeholder' => 'Enter tpa ticts reciept date here...', ]) !!}
        {!! $errors->first('tpa_ticts_reciept_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tax_id') ? 'has-error' : '' }}">
    {!! Form::label('tax_id','Tax',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('tax_id',$taxes,null, ['class' => 'form-control', 'placeholder' => 'Select tax', ]) !!}
        {!! $errors->first('tax_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('charge_to') ? 'has-error' : '' }}">
    {!! Form::label('charge_to','Charge To',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('charge_to',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter charge to here...', ]) !!}
        {!! $errors->first('charge_to', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('free_control') ? 'has-error' : '' }}">
    {!! Form::label('free_control','Free Control',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <div class="checkbox">
            <label for='free_control_1'>
                {!! Form::checkbox('free_control', '1',  (old('free_control', isset($proformaInvoice->free_control) ? $proformaInvoice->free_control : null) == '1' ? true : null) , ['id' => 'free_control_1', 'class' => '', ]) !!}
                Yes
            </label>
        </div>

        {!! $errors->first('free_control', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tpa_ticts_removal_charges') ? 'has-error' : '' }}">
    {!! Form::label('tpa_ticts_removal_charges','Tpa Ticts Removal Charges',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tpa_ticts_removal_charges',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tpa ticts removal charges here...','step' => "any", ]) !!}
        {!! $errors->first('tpa_ticts_removal_charges', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tpa_ticts_storage_charges') ? 'has-error' : '' }}">
    {!! Form::label('tpa_ticts_storage_charges','Tpa Ticts Storage Charges',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::number('tpa_ticts_storage_charges',null, ['class' => 'form-control', 'min' => '-2147483648', 'max' => '2147483647', 'placeholder' => 'Enter tpa ticts storage charges here...','step' => "any", ]) !!}
        {!! $errors->first('tpa_ticts_storage_charges', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('vessel_arrival_information_id') ? 'has-error' : '' }}">
    {!! Form::label('vessel_arrival_information_id','Vessel Arrival Information',['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::select('vessel_arrival_information_id',$vesselArrivalInformations,null, ['class' => 'form-control', 'placeholder' => 'Select vessel arrival information', ]) !!}
        {!! $errors->first('vessel_arrival_information_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

