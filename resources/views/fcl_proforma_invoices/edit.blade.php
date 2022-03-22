@extends('layouts.modals')

@section('content')



<div class="panel panel-primary">
    <div class="panel-body"> 
<div class="panel-body">

 {!! Form::model($proformaInvoice, [
                'method' => 'PUT',
                'route' => ['proforma_invoices.update', $proformaInvoice->id],
                //'class' => 'form-horizontal',
                'name' => 'edit_proforma_invoice_form',
                'id' => 'proforma_invoice_form',
                
            ]) !!}

       

    {!!Form::hidden('client_id',$proformaInvoice->client_id,['id'=>'client'])!!}

    {!!Form::hidden('bill_of_lading_id',$proformaInvoice->bill_of_lading_id)!!}

        {!!Form::hidden('no_of_containers',null,['id'=>'no_of_containers'])!!}
        {!!Form::hidden('storageDays',null,['id'=>'storageDays'])!!}
    
        {!!Form::hidden('container_info', $view,['id'=>'container_info'] ) !!}
        {!!Form::hidden('vessel_id',$proformaInvoice->billOfLading->vessel_id)!!}
    {!!Form::hidden('tzs_vat',null,['id'=>'tzs_vat'])!!}
    {!!Form::hidden('tzs_vat_exclusive',null,['id'=>'tzs_vat_exclusive'])!!}
    {!!Form::hidden('tzs_vat_inclusive',null,['id'=>'tzs_vat_inclusive'])!!}
    {!!Form::hidden('tzs_grand_total',null,['id'=>'tzs_grand_total'])!!}
    {!!Form::hidden('usd_vat_exclusive',null,['id'=>'usd_vat_exclusive'])!!}
    {!!Form::textArea('amount_in_words',null,['id'=>'amount_in_words','style'=>'display:none'])!!}

    
    <div class="row">


        <div class="col-md-3">
            
          
        <div class="form-group {{ $errors->has('usd_grand_total') ? 'has-error' : '' }}">
                {!! Form::label('usd_grand_total','Grand Total') !!}
            
                    {!! Form::text('usd_grand_total',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Invoice Grand total','readonly'=>'readonly' ]) !!}
                    {!! $errors->first('usd_grand_total', '<p class="help-block">:message</p>') !!}
            
            </div>
          


        </div>
        <div class="col-md-3">

        <div class="form-group {{ $errors->has('usd_vat') ? 'has-error' : '' }}">
                {!! Form::label('usd_vat','Total VAT') !!}
            
                    {!! Form::text('usd_vat',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Invoice VAT total','readonly'=>'readonly' ]) !!}
                    {!! $errors->first('usd_vat', '<p class="help-block">:message</p>') !!}
            
            </div>

     
        
        </div>
        <div class="col-md-3">
        <div class="form-group {{ $errors->has('usd_vat_inclusive') ? 'has-error' : '' }}">
                {!! Form::label('usd_vat_inclusive','Vat inclusive Total') !!}
            
                    {!! Form::text('usd_vat_inclusive',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Invoice VAT inclusive total','readonly'=>'readonly']) !!}
                    {!! $errors->first('usd_vat_inclusive', '<p class="help-block">:message</p>') !!}
            
            </div>
        
        </div>

     


  


            <div class="col-md-3">
        <label for="">Storage Days</label>

                            {!! Form::text('storage_days',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'id' => 'storage_days','readonly'=>'readonly']) !!}

        
        
        
        </div>

     
       
    </div>

    <div class="row">
    

    
    
    </div>
    <div class="row">
    
    <div class="col-md-3">
    
    

    <div class="form-group {{ $errors->has('proforma_invoice_number') ? 'has-error' : '' }}">
    {!! Form::label('proforma_invoice_number','Proforma Number') !!}

        {!! Form::text('proforma_invoice_number',$proformaInvoice->proforma_invoice_number, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Enter proforma number here...', ]) !!}
        {!! $errors->first('proforma_invoice_number', '<p class="help-block">:message</p>') !!}

</div>
    </div>
    <div class="col-md-3">

    <div class="form-group {{ $errors->has('invoice_date') ? 'has-error' : '' }}">
    {!! Form::label('invoice_date','Invoice Date') !!}
    <div class="input-group date date-picker"  data-date-format="dd/mm/yyyy" data-date-viewmode="years">
        {!! Form::text('invoice_date',$proformaInvoice->invoice_date, ['class' => 'form-control', 'placeholder' => 'Enter proforma date here...', ]) !!}

        <span class="input-group-btn">
                                <button class="btn btn-default clear_date" type="button">
                                     <i class="fa fa-times"></i>
                                 </button>
                                 <button class="btn btn-default" type="button">
                                     <i class="fa fa-calendar"></i>
                                 </button>
                             </span>
        {!! $errors->first('invoice_date', '<p class="help-block">:message</p>') !!}
</div>
    </div>


 


    </div>
    <div class="col-md-3">

    <div class="form-group {{ $errors->has('reciept_date') ? 'has-error' : '' }}">
        {!! Form::label('reciept_date','Reciept Date') !!}
            <div class="input-group date date-picker"  data-date-format="dd/mm/yyyy" data-date-viewmode="years">

                {!! Form::text('reciept_date',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Enter reciept date here...', ]) !!}
                <span class="input-group-btn">
                                        <button class="btn btn-default clear_date" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
            
                {!! $errors->first('reciept_date', '<p class="help-block">:message</p>') !!}

                
            </div>
    </div>


    </div>
    <div class="col-md-3">


    <div class="form-group {{ $errors->has('reciept_no') ? 'has-error' : '' }}">
    {!! Form::label('reciept_no','Reciept Number') !!}

        {!! Form::text('reciept_no',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Enter reciept number here...', ]) !!}
        {!! $errors->first('reciept_no', '<p class="help-block">:message</p>') !!}

        
</div>



    
    </div>
    
    </div>

<div class="row">

<div class="col-md-3">


<div class="form-group {{ $errors->has('usd_rate') ? 'has-error' : '' }}">
    {!! Form::label('usd_rate','USD Rate') !!}

        {!! Form::text('usd_rate',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Enter exchage rate here...', ]) !!}
        {!! $errors->first('usd_rate', '<p class="help-block">:message</p>') !!}

</div>
</div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('sequence_no') ? 'has-error' : '' }}">
            {!! Form::label('sequence_no','Sequence number') !!}

                {!! Form::text('sequence_no',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => false, 'placeholder' => 'Enter  sequence number here...', ]) !!}
                {!! $errors->first('sequence_no', '<p class="help-block">:message</p>') !!}

        </div>


    </div>
<div class="col-md-3">  
    <div class="form-group {{ $errors->has('invoice_status_id') ? 'has-error' : '' }}">
            {!! Form::label('invoice_status_id','Invoice Status') !!}

                {!! Form::select('invoice_status_id',$invoiceStatuses,null,['class' => 'form-control', 'required' => true, ]) !!}
                {!! $errors->first('invoice_status_id', '<p class="help-block">:message</p>') !!}

        </div>
    
    </div>
    <div class="col-md-3">
    
        <div class="form-group">
            <label for="">
            @if($proformaInvoice->billOfLading->include_alteration_fees == 1)

                        {!!Form::radio('include_alteration_fees','1', true)!!}

            @else

            {!!Form::radio('include_alteration_fees',null, false)!!}
            @endif
         Include Alteration fees


            </label>
        </div>
    
    </div>


</div>

    <div class="row">
    
    
    <div class="col-md-3">

    </div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
    </div>
    <table class="table table-condensed table-striped">


    <thead>
        <tr>
          
            <th>ContainerNumber</th>
            <th>size</th>
            <th>Cargo</th>
            <th>Handling</th>
            
            <th>D Amount</th>
            <th>Abnormal</th>
            <th>OpenTop</th>
            <th>storage</th>
            <th>Removal</th>
            <th>Corridor</th>
            <th>Nom</th>
            <th>str/verf</th>
            
           
            <th>Total</th>
            <th>VatAmt</th>
           
            <th>VatIncl</th>
          
            
          
            <th>

               

             
           
            </th>
        </tr>
    </thead>

    <tbody>



        @php $i=0;@endphp
        @foreach($containers as $container)
        <tr>
     
            <td>  

            {!!Form::text("containers[$i][container_number]", $container->container->container_no,['class'=>'form-control','readonly'=>'readonly'])!!}
            {!!Form::hidden("containers[$i][container_id]",$container->container_id)!!}
            {!!Form::hidden("containers[$i][change_of_information]",ctr_charge($container->container_id,40),['id'=>"change_of_information-$i"])!!}
            {!!Form::hidden("containers[$i][stripping_charge]",ctr_charge($container->container_id,11),['id'=>"stripping_charge-$i"])!!}
            {!!Form::hidden("containers[$i][change_of_status_charge]",ctr_charge($container->container_id,32),['id'=>"change_of_status_charge-$i"])!!}
            {!!Form::hidden("containers[$i][alteration_charge]",ctr_charge($container->container_id,12),['id'=>"alteration_charge-$i"])!!}

            </td>
            
            <td>
            
            {!!Form::text("containers[$i][container_size]", $container->container->containerSize->size,['class'=>'form-control','readonly'=>'readonly'])!!}
            </td>
            <td>
{!!Form::text("containers[$i][cargo_type]", $container->container->cargoType->cargo_type,['class'=>'form-control','readonly'=>'readonly'])!!}
            </td>
            <td>
            {!!Form::text("containers[$i][port_handling_charge]", ctr_charge($container->container_id,3),['class'=>'form-control charge','readonly','id'=>"port_handling-$i"])!!}
            </td>
            <td> 
            {!!Form::text("containers[$i][danger_charge]",ctr_charge($container->container_id,5),['class'=>'form-control charge','readonly','id'=>"danger_cargo-$i"])!!}
            </td>
            <td> 
            {!!Form::text("containers[$i][abnormal_cargo]",ctr_charge($container->container_id,39),['class'=>'form-control charge','readonly','id'=>"abnormal_cargo-$i"])!!}
            </td>
            <td> 
            {!!Form::text("containers[$i][open_top_charge]",ctr_charge($container->container_id,6),['class'=>'form-control charge','readonly','id'=>"open_top_charge-$i"])!!}
            </td>
            <td> 
            {!!Form::text("containers[$i][storage_charge]",  ctr_charge($container->container_id,2),['class'=>'form-control charge','id'=>"storage-$i",'readonly'=>'readonly'])!!}
            </td>
            <td>
            {!!Form::text("containers[$i][removal_charge]",  ctr_charge($container->container_id,4),['class'=>'form-control charge','id'=>"removal-$i",'readonly'])!!}
            </td>
            <td>
            {!!Form::text("containers[$i][corridor_levy_charge]",ctr_charge($container->container_id,7),['class'=>'form-control charge','readonly','id'=>"corridor-$i"])!!}
            </td>
            <td>
            {!!Form::text("containers[$i][nomination_charge]",ctr_charge($container->container_id,10),['class'=>'form-control charge','readonly','id'=>"nomination_charge-$i"])!!}
            </td>
            <td>
            {!!Form::text("containers[$i][stripping_verification_charge]",stripping_verification_charge($container->container_id),['class'=>'form-control charge','readonly','id'=>"stripping_verification_charge-$i"])!!}
            </td>
            <td>
                {!!Form::text("containers[$i][line_amount]",ctr_line_total($container->container_id),['class'=>'form-control','readonly'=>'readonly','id'=>"line_total-$i"])!!}
                </td>
            <td>
            {!!Form::text("containers[$i][vat_amount]",ctr_vat_total($container->container_id),['class'=>'form-control','readonly'=>'readonly','id'=>"vat_amount-$i"])!!}
            </td>
            <td>
            {!!Form::text("containers[$i][vat_incl_amount]",ctr_vat_inclusive($container->container_id),['class'=>'form-control','readonly'=>'readonly','id'=>"vat_inclusive-$i"])!!}
            </td>
        </tr>
        @php $i++ @endphp
        @endforeach
    </tbody>
    </table>
    <hr>
    <div class="row">
<div class="form-group col-md-12">
       <div class="table-responsive">
           <table class="table table-bordered" id="items">
               <thead>
                   <tr>
                       <th width="5%"  class="text-center">Actions</th>
                       <th width="65%" class="text-left">Charge description</th>
                       <th width="15%" class="text-right">Amount</th>
                   </tr>
               </thead>
               <tbody>
                   <?php $item_row = 0; ?>
                   @foreach($miscelenouseCharges as $charge)
              <tr id="item-row-{{ $item_row }}">
                       <td class="text-center" style="vertical-align: middle;">
                       <button type="button" onclick="$('#item-row-{{ $item_row }}').remove(); getIcdProformaTotals();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger">REMOVE</button>
                       </td>
                       <td>
                           <input class="form-control typeahead" required="required" name="item[{{ $item_row }}][name]" type="text" id="item-name-{{ $item_row }}" value="{{ $charge->charge->charge_description }}">
                           <input name="item[{{ $item_row }}][charge_id]" type="hidden" id="item-id-{{ $item_row }}" class="item_id_value" value="{{ $charge->charge_id }}">
                       </td>
                       <td>
                           <input class="form-control text-right line" required="required" name="item[{{ $item_row }}][amount]" type="text" id="item-price-{{ $item_row }}"  readonly value="{{$charge->amount * $proformaTotalContainers}}">
                       </td>
                   </tr>
          
             

         
           
                  
                
            

                   <?php $item_row++; ?>
                   @endforeach

        


                   <tr id="addItem">
                       <td class="text-center"><button type="button" onclick="addItem();"  class="btn btn-sm btn-primary">Add row</button></td>
                       <td class="text-right" colspan="5"></td>
                   </tr>


              
               
             
               </tbody>
           </table>




           
       </div>
   </div>


</div>
    <div class="form-group">
             
             {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
             {!! Form::button('Cancel', ['class' => 'btn btn-danger pull-right','data-dismiss'=>'modal']) !!}
    
     </div>

     {!! Form::close() !!}
</div>
    </div>
</div>

