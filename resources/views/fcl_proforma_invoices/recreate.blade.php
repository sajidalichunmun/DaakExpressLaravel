@extends('layouts.modals')

@section('content')






<div class="panel panel-primary">


    <div class="panel-body">



<div class="row">
    <div class="col-md-3">
 <strong>Vessel:</strong> {{  isset($proformaInvoice->billOfLading->vessel->id) ? $proformaInvoice->billOfLading->vessel->vessel_name : ''  }}<br>
 <strong>Vessel Arrival:</strong> {{  $proformaInvoice->billOfLading->arrival_date }}<br>
 <strong>Voyage:</strong> {{  $proformaInvoice->billOfLading->voyage   }}<br>
 <strong>Client:</strong> {{  isset($proformaInvoice->billOfLading->client->id) ? $proformaInvoice->billOfLading->client->consignee_name : ''  }}<br>
 <strong>File Number:</strong> {{ $proformaInvoice->billOfLading->file_number }}<br>
 <strong>Cargo From:</strong> 
 {{  isset($proformaInvoice->billOfLading->terminal_id) ? $proformaInvoice->billOfLading->terminal->terminal_name : ''  }}

 
 <br>

 <strong>Consignment Type:</strong> 

 {{  isset($billOfLading->consignment_type_id) ? $billOfLading->consignmentType->consignment_type : ''  }}
 <br>

 <strong>File Number:</strong> {{$proformaInvoice->billOfLading->file_number}}


 <br>

    </div>
    <div class="col-md-3">

 <strong>Place Of Destination:</strong> {{ $proformaInvoice->billOfLading->place_of_destination }}<br>
 <strong>Place Of Delivery</strong> {{ $proformaInvoice->billOfLading->place_of_delivery }}<br>
 <strong>Port Of  Loading:</strong> {{ $proformaInvoice->billOfLading->port_of_loading }}<br>

 <strong>Notify Name:</strong> 
 

 {{  isset($proformaInvoice->billOfLading->notify_id) ? $proformaInvoice->billOfLading->notify->notify_name : ''  }}
 <br>
 <strong>Shipping Line:</strong> 
 

 {{  isset($proformaInvoice->billOfLading->shipping_line_id) ? $proformaInvoice->billOfLading->shippingLine->shipping_line_name : ''  }}
 <br>
 <strong>Consignee:</strong> 
 
 {{  isset($proformaInvoice->billOfLading->client_id) ? $proformaInvoice->billOfLading->client->consignee_name : ''  }}
 
 <br>

    </div>
    <div class="col-md-3">
    <strong>Number Of Package:</strong> {{ $proformaInvoice->billOfLading->number_of_package }}<br>
 <strong>Gross Weight</strong> {{ number_format($proformaInvoice->billOfLading->gross_weight,2) }} {{ $proformaInvoice->billOfLading->gross_weight_unit }} <br>
 <strong>Port Of  Loading:</strong> {{ $proformaInvoice->billOfLading->port_of_loading }}<br>
 <strong>Number Of Containers:</strong> {{ $proformaInvoice->billOfLading->number_of_containers }}<br>
 <strong>Shipping Agent:</strong>
 
 {{  isset($proformaInvoice->billOfLading->shipping_agent_id) ? $proformaInvoice->billOfLading->shippingAgent->shipping_agent_code : ''  }}
 {{  isset($proformaInvoice->billOfLading->shipping_agent_id) ? $proformaInvoice->billOfLading->shippingAgent->shipping_agent_name : ''  }}




<br>

<strong>Exporter:</strong> {{  isset($proformaInvoice->billOfLading->exporter_id) ? $proformaInvoice->billOfLading->exporter->exporter_name : ''  }}
 
 
 <br>



    </div>
    <div class="col-md-3">
    <strong>Description Of Goods:</strong> 

    <div class="well">
    {{ $proformaInvoice->billOfLading->description_of_goods }}
    </div>

    </div>
   
</div>





          
         
            
          
          
           
      
          
           
            
          
         

           
          
<div class="panel-body">
    <hr>
    







 {!! Form::model($proformaInvoice, [
                'method' => 'POST',
                'route' => 'proforma_invoices.store',
                //'class' => 'form-horizontal',
                'name' => 'edit_proforma_invoice_form',
                'id' => 'icd_proforma_invoice_form',
                
            ]) !!}

            

            {!!Form::text('recreate',1)!!}

    {!!Form::hidden('bill_of_lading_id',$proformaInvoice->bill_of_lading_id)!!}
    {!!Form::hidden('storageDays',null,['id'=>'storageDays'])!!}
    {!!Form::text('parent_proforma_invoice_id',$proformaInvoice->id,['id'=>'parent_proforma_invoice_id'])!!}
    {!!Form::text('booking_verification_id',$proformaInvoice->booking_verification_id)!!}


    {!!Form::hidden('client_id',$proformaInvoice->client_id)!!}
    {!!Form::hidden('clearing_agent_id',$proformaInvoice->clearing_agent_id)!!}

        {!!Form::text('ticts_invoice_id',null,['id'=>'ticts_id'])!!}


    {!!Form::text('no_of_containers',$proformaInvoice->no_of_containers,['id'=>'no_of_containers_verified']) !!}

   


    <div class="row">


        <div class="col-md-2">
            
          
     
          
        <div class="form-group {{ $errors->has('usd_grand_total') ? 'has-error' : '' }}">
                {!! Form::label('usd_grand_total','Grand Total') !!}
            
                    {!! Form::text('usd_grand_total',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => true, 'placeholder' => 'Invoice Grand total','readonly'=>'readonly' ]) !!}
                    {!! $errors->first('usd_grand_total', '<p class="help-block">:message</p>') !!}
            
            </div>
          


        </div>
        <div class="col-md-2">

        <div class="form-group {{ $errors->has('usd_vat') ? 'has-error' : '' }}">
                {!! Form::label('usd_vat','Total VAT') !!}
            
                    {!! Form::text('usd_vat',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => true, 'placeholder' => 'Invoice VAT total','readonly'=>'readonly' ]) !!}
                    {!! $errors->first('usd_vat', '<p class="help-block">:message</p>') !!}
            
            </div>

     
        
        </div>
        <div class="col-md-2">
        <div class="form-group {{ $errors->has('usd_vat_inclusive') ? 'has-error' : '' }}">
                {!! Form::label('usd_vat_inclusive','Vat inclusive Total') !!}
            
                    {!! Form::text('usd_vat_inclusive',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => true, 'placeholder' => 'Invoice VAT inclusive total','readonly'=>'readonly']) !!}
                    {!! $errors->first('usd_vat_inclusive', '<p class="help-block">:message</p>') !!}
            
            </div>
        
        </div>

        <div class="col-md-4">
        
        <div class="form-group">
                                                                    <label>Proforma Status</label>
                                                                    <div class="input-group">
                                                                       @foreach($invoiceStatuses as $key=>$value)
                                                                            <label>
                                                                                
                                                                                
                                                                    {{Form::radio('invoice_status_id',$key,false,['required'])}}
                                    
                                                                                 {{$value}}
                                                                                  
                                                                                  </label>
                                                                        @endforeach



                                                                         
    
                                                                       
                                                                   
                                                                    </div>





        
        
        </div>
        </div>
       
    </div>
    <div class="row">
    
    <div class="col-md-3">
    
    

        <div class="form-group">
            {!! Form::label('proforma_invoice_number','Proforma Number') !!}
        
                {!! Form::text('proforma_invoice_number',$proformaNumber, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => true, 'placeholder' => '','readonly'=>'readonly' ]) !!}
          
        
        </div>
    </div>
    <div class="col-md-3">

    <div class="form-group {{ $errors->has('invoice_date') ? 'has-error' : '' }}">
    {!! Form::label('invoice_date','Invoice Date(Charges upto)') !!}
    <div class="input-group date date-picker"  data-date-format="dd/mm/yyyy" data-date-viewmode="years">
        {!! Form::text('invoice_date',null, ['class' => 'form-control', 'placeholder' => 'Enter invoice date here...', ]) !!}

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
    <div class="form-group {{ $errors->has('usd_rate') ? 'has-error' : '' }}">
    {!! Form::label('usd_rate','USD Rate') !!}

        {!! Form::text('usd_rate',null, ['class' => 'form-control', 'min' => '1', 'max' => '100', 'required' => true, 'placeholder' => 'Enter exchage rate here...', ]) !!}
        {!! $errors->first('usd_rate', '<p class="help-block">:message</p>') !!}

</div>


    </div>
    <div class="col-md-3">
<label for="">Storage Days</label>

        {!! Form::text('storage_days',null, ['class' => 'form-control readonly', 'min' => '1', 'max' => '100', 'required' => true, 'id' => 'storage_days','data-readonly' ]) !!}




    
    </div>
    
    </div>




<hr>



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
            <th><input type="checkbox" id="checkAll"/> All</th>
            <th>ContainerNo</th>
      
            <th>size</th>
            <th>Cargo</th>
            <th>Handling</th>
            <th>Removal</th>
            <th>Storage</th>
            <th>DAmount</th>
            <th>OpenTop</th>
            <th>Corridor</th>
            <th>Stripping/veri</th>
            <th>Mps</th>
            <th>Nomination</th>
           
          
            
          
            <th>

               

             
           
            </th>
        </tr>
    </thead>

    <tbody>



        @php $i=0;@endphp
        @foreach($containers as $containerCharge)
        <tr>
            <td>{!!Form::checkBox('selectedContainers[]',$containerCharge->container_id,false,['class'=>'checkContainers'])!!} 
            
            {!!Form::hidden("containers[$i][container_id]",$containerCharge->container_id)!!}
            </td>
            <td>  
            
           
            {!!Form::text("containers[$i][container_number]", $containerCharge->container->container_no,['class'=>'form-control','readonly'=>'readonly'])!!}

            
            
            
            </td>
            
            <td>
            
            {!!Form::text("containers[$i][container_size]", isset($containerCharge->container->container_size_id) ? $containerCharge->container->containerSize->size: null,['class'=>'form-control','readonly'=>'readonly'])!!}
            
            
            </td>
            <td>
            
            {!!Form::text("containers[$i][cargo_type]", isset($containerCharge->container->cargo_type_id) ? $containerCharge->container->cargoType->cargo_type:'',['class'=>'form-control','readonly'=>'readonly'])!!}

            
            </td>
            <td>
            
      
            


{!!Form::text("containers[$i][port_handling_charge]", $containerCharge->port_handling_charge,['class'=>'form-control charge','readonly'])!!}

            </td>
            <td>
            
          
            {!!Form::text("containers[$i][removal_charge]", $containerCharge->removal_charge,['class'=>'form-control charge','readonly','id'=>"removal-$i"])!!}
            
            </td>
            <td>

       
          

         
            {!!Form::text("containers[$i][storage_charge]", $containerCharge->storage_charge,['class'=>'form-control charge','readonly',"id"=>"storage-$i"])!!}
            </td>
            <td> 
           
            {!!Form::text("containers[$i][danger_charge]", null ,['class'=>'form-control charge','readonly','id'=>"danger_cargo-$i"])!!}
         



            </td>
            <td> 
            

            
          

            {!!Form::text("containers[$i][open_top_charge]", null,['class'=>'form-control charge','readonly','id'=>"open_top_charge-$i"])!!}


            
            </td>
            <td>
            {!!Form::text("containers[$i][corridor_levy_charge]", null,['class'=>'form-control charge','id'=>"corridor-$i",'readonly'])!!}
            
            
            </td>
            <td>
            {!!Form::text("containers[$i][stripping_verification_charge]",$containerCharge->stripping_verification_charge,['class'=>'form-control charge','readonly'])!!}
            
            
            </td>



            
            <td>
            
            {!!Form::text("containers[$i][mps_total_charges]", !is_null($containerCharge->container->mps_usd_total ) ? \App\Models\Container::getContainerMpsCharges($containerCharge->container_id) : 0,['class'=>'form-control charge','readonly'])!!}

            
            </td>

            <td>
            
            {!!Form::text("containers[$i][nomination_charge]", null,['class'=>'form-control charge','readonly','id'=>"nomination-$i"])!!}

            
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
                    @foreach($proformaInvoice->charges as $item)
                 
                    <tr id="item-row-{{ $item_row }}">
                        <td class="text-center" style="vertical-align: middle;">
                        <button type="button" onclick="$('#item-row-{{ $item_row }}').remove(); getIcdProformaTotals();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger">REMOVE</button>

                        </td>
                        <td>
                            <input class="form-control typeahead" required="required" name="item[{{ $item_row }}][name]" type="text" id="item-name-{{ $item_row }}" value="{{ $item->charge_description }}">
                            <input name="item[{{ $item_row }}][charge_id]" type="hidden" id="item-id-{{ $item_row }}" class="item_id_value" value="{{ $item->id }}">
                       
                       
                        </td>
                        
                        <td>
                            <input class="form-control text-right line" required="required" name="item[{{ $item_row }}][amount]" type="text" id="item-price-{{ $item_row }}"  readonly value="{{$item->pivot->amount}}">
                        </td>
                       
                  
                    </tr>

                    <?php $item_row++; ?>
                    @endforeach

                      @if (count($proformaInvoice->charges) < 1)


                              

                    <tr id="item-row-{{ $item_row }}">
                        <td class="text-center" style="vertical-align: middle;">
                        <button type="button" onclick="$('#item-row-{{ $item_row }}').remove(); getIcdProformaTotals();" data-toggle="tooltip" title="" class="btn btn-xs btn-danger">REMOVE</button>

                        </td>
                        <td>
                            <input class="form-control typeahead" required="required" name="item[{{ $item_row }}][name]" type="text" id="item-name-{{ $item_row }}">
                            <input name="item[{{ $item_row }}][charge_id]" type="hidden" id="item-id-{{ $item_row }}" class="item_id_value">
                       
                           
                        </td>
                        
                        <td>
                            <input class="form-control text-right line readonly" required="required" name="item[{{ $item_row }}][amount]" type="text" id="item-price-{{ $item_row }}"  data-readonly>
                        </td>
                       
                  
                    </tr>
                   

                      @endif

                    <?php $item_row++; ?>


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
    
     </div>

     {!! Form::close() !!}
</div>
    </div>
</div>

@include('containers.invoiceEditModal')
@include('containers.over')

@endsection

@section('css')
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')




<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>


<script>
    $(function(){

      //  alert();
      //  getIcdProformaTotals();

calculateStorageCharges();


  $(".readonly").keydown(function(e){
e.preventDefault();
});

//calculateStorageCharges();
        //getIcdProformaTotals();

         //var grandTotal =  

        $("body").on('click',function(){
            //getIcdProformaTotals();
            //getRemovalCharges();

            //getIcdProformaTotals();
           calculateStorageCharges();
        });

        $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
   // console.log($(":checkbox:checked").length-1);
    //$ln =$(":checkbox:checked").length;

   // console.log($(".checkContainers:checked").size());

    //console.log($(":checkbox:checked").length)

   
});
       
        $(document).on('click','.show_container_modal',function(event){
           event.preventDefault();

           //console.log();

           var url = $(this).attr('data-href'),
            method=$(this).attr('method'),
            title = $(this).attr('title');

            $.get(url,function(data){
                $('#containersTitle').text(title);
            $('#containersAjaxModalForm').html(data);
           // console.log(data.container_no);
            });

        });

    


               //customer bracnhes ajax creation
               $(document).on('submit','form#container_form',function(event){
            event.preventDefault();
     var url =$(this).attr('action'),
     form = $('form#container_form'),
    method =$(this).attr('method');
    console.log(url);
    //customer_branch=$('#customer_branch_id');
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url:url,
        method:method,
        dataType:'json',
        data:form.serialize(),
        success:function(data){
           // customer_branch.append('<option value="' + data[0].id + '" selected="selected">' + data[0].name + '</option>');
           //customer_branch.trigger('change.select2');
           // $('#CustomerBranchmodalForm').modal('hide');
           // form[0].reset();
           window.location.reload();

        },
        error:function (response) {
            var errors = response.responseJSON;
            if($.isEmptyObject(errors)==false){
                $.each(errors,function (key,value) {
                    $('#'+key).closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block">'+value+'</span>');
                });
            }
            // $('.modal').on('hidden.bs.modal',function(){
            //     form.find('.form-group').removeClass('has-error');
            //     form.find('.help-block').remove();
            //     form.trigger('reset');
            // })
        },
    });
           // console.log();
        })


$(document).on('change','#invoice_date',function(){
   // alert();
   //getStorageDays();
   //console.log();
   calculateStorageCharges();
  // getRemovalCharges();
});

$(document).on('input','.charge',function(){
   // alert();
   //calculateStorageCharges();
   //console.log();
  // alert();
});
        // function getStorageDays(){
        //     var url ="{{url('getStorageDays')}}",
        //     form =$('form#icd_proforma_invoice_form'),
        //     method = 'post';  
        //     $.ajax({
        //         url:url,
        //         method:method,
        //         dataType:'JSON',
        //         data:form.serialize(),
        //         success:function(data){

        //            // $('#storageDays').val(data);
        //             $('#storage_days').val(data);
                    
        //         //    $('select[name=horse_id]').empty().trigger('change.select2');
        //         //    //$('select[name=trailer_id]').empty().trigger('change.select2');
        //         //     $.each(data.horse,function (key,value) {
        //         //            $('select[name=horse_id]').append($('<option/>',{
        //         //             value:key,
        //         //             text:value,
        //         //     })).val('').trigger('change.select2');
        //         //     });
                    
        //         },
        //     });
        // }

        function calculateStorageCharges(){
            var url ="{{url('calculateStorageCharges')}}",
            form =$('form#icd_proforma_invoice_form'),
            method = 'post';  
            $.ajax({
                url:url,
                method:method,
                dataType:'JSON',
                data:form.serialize(),
                success:function(data){

//console.log(data.invoiceTotalExcl);
                $.each(data.containerStorage,function(key,value){
                  $('#storage-'+key).val(value.storage);
                   $('#line_total-'+key).val(value.line_amount);
                   $('#vat_amount-'+key).val(value.vat_amount);
                   $('#vat_inclusive-'+key).val(value.vat_inclusive);


  $('#corridorLevy-'+key).val(value.corridorLevy);
                 $('#storage_days').val(value.storageAdjustedDays);
                   $('#removal-'+key).val(value.removal);
                   $('#nomination-'+key).val(value.nomination);


                   

                   
                   
                   // console.log(key);
                   // console.log(value.storage);

                });


                $.each(data.otherCharges,function(key,value){
                   $('#danger_cargo-'+key).val(value.dangerous_charge);
                   $('#corridor-'+key).val(value.corridor_charge);
                   $('#open_top_charge-'+key).val(value.open_top_charge);
                });
                $('#usd_grand_total').val(data.invoiceTotalExcl);
                $('#usd_vat').val(data.grandTotalVat);
                $('#usd_vat_inclusive').val(data.invoiceTotalIncl);

               // $('#usd_grand_total').val(data.invoiceTotalExcl);
               // $('#usd_vat').val(data.grandTotalVat);
                //$('#usd_vat_inclusive').val(data.invoiceTotalIncl);
                   /// $('#storageDays').val(data);
                   // $('#storageDays2').html(data);
                    
                //    $('select[name=horse_id]').empty().trigger('change.select2');
                //    //$('select[name=trailer_id]').empty().trigger('change.select2');
                //     $.each(data.horse,function (key,value) {
                //            $('select[name=horse_id]').append($('<option/>',{
                //             value:key,
                //             text:value,
                //     })).val('').trigger('change.select2');
                //     });
                    
                },
            });
        }



    var path = "{{ url('charges/autocomplete') }}";

$(document).on('input','.form-control.typeahead',function(){
    arr = $(this).attr('id').split('-');
 //console.log(arr.slice(-1))

   var item_id = arr.slice(-1)[0]


    $(this).typeahead({
                    minLength: 1,
                    displayText:function (data) {
                        return data.charge_description;
                    },
                    source: function (query, process) {
                        $.ajax({
                            url: path,
                            type: 'GET',
                            dataType: 'JSON',
                            data: query,
                            success: function(data) {
                                //console.log(data);
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {
                      $('#item-id-' + item_id).val(data.id);
                       $('#item-quantity-' + item_id).val('1');
                        $('#item-price-' + item_id).val(data.amount*$('#no_of_containers_verified').val());
                       
                       // $('#item-price-' +item_id).val(data.itemPrice);
                       // $('#item-lineTotal-' + item_id).val(data.itemPrice);
                       calculateStorageCharges();
                    }

                });
          
             

});

 $(document).on('input', '#items tbody .form-control', function(){
    calculateStorageCharges();
       });


       
//        function getRemovalCharges(){
//             var url ="{{url('getRemovalCharges')}}",
//             form =$('form#icd_proforma_invoice_form'),
//             method = 'POST';  
//             $.ajax({

//                 url:url,
//                 method:method,
//                 dataType:'JSON',
//                 data:form.serialize(),
                
                
//                 success:function(data){



//  $.each(data.removalCharge,function(key,value){

//                    $('#removal-'+key).val(value.removal);

//                                       $('#ticts_id').val(value.ticts_invoice_id);

//                   // console.log(value.removal);


//  });

//                    // $('#storageDays').val(data);
//                     //$('#storage_days').val(data);
                    
//                 //    $('select[name=horse_id]').empty().trigger('change.select2');
//                 //    //$('select[name=trailer_id]').empty().trigger('change.select2');
//                 //     $.each(data.horse,function (key,value) {
//                 //            $('select[name=horse_id]').append($('<option/>',{
//                 //             value:key,
//                 //             text:value,
//                 //     })).val('').trigger('change.select2');
//                 //     });
                    
//                 },
//             });
//         }




        

    });
</script>





<script type="text/javascript">


var item_row = '{{ $item_row }}';

function addItem() {


    html ='<tr id="item-row-'+item_row+'"><td class="text-center" style="vertical-align: middle;">';
        html +='<button type="button" onclick="$(\'#item-row-'+item_row+'\').remove();getIcdProformaTotals();" class="btn btn-xs btn-danger btn-sm">REMOVE </button></td>';
        html +='<td><input class="form-control typeahead" required="required" name="item['+item_row+'][name]" type="text" id="item-name-'+item_row+'">';
        html +='<input name="item['+item_row+'][charge_id]" type="hidden" id="item-id-'+item_row+'"></td>';
        html +='<td><input class="form-control text-right" required="required" name="item['+item_row+'][amount]" type="text" id="item-price-'+item_row+'" readonly></td>';
        
        
        $('#items tbody #addItem').before(html);

  


    item_row++;
}


//  $(document).on('input', '#items tbody .form-control', function(){
//             getIcdProformaTotals();
//        });

//       function totalItem() {

         

//           //console.log();
//             $.ajax({
//                 url: '{{ url("invoicesTotal") }}',
//                 type: 'POST',
//                 dataType: 'JSON',
//                 data: $('form#icd_proforma_invoice_form').serialize(),    
//                 success: function(data) {
//                         // $.each( data.lineTotal, function( key, value ) {
//                         //     $('#item-lineTotal-' + key).val(value['line_total']);
//                         // });
//                         //$('#sub-total').html(data.sub_total);
//                         //$('#tax-total').html(data.tax_total);
//                         //$('#invoiceTotal').val(data.invoiceTotal);

// //var grandTotal = parseFloat($('#usd_grand_total').val().replace(',','')) +parseFloat(data);
// var grandTotal = parseFloat($('#usd_grand_total').val().replace(',',''));

// console.log();
// result =(grandTotal +data).toLocaleString();
// console.log(result);

//                          $('#usd_grand_total').val(data);
                 
//                 }
//             });
//         }



//         function getIcdProformaTotals(){
//             var url ="{{url('getIcdProformaTotals')}}",
//             form =$('form#icd_proforma_invoice_form'),
//             method = 'post';  
//             $.ajax({
//                 url:url,
//                 method:method,
//                 dataType:'JSON',
//                 data:form.serialize(),
//                 success:function(data){

// //console.log(data.invoiceTotalExcl);
//                // $.each(data.containerStorage,function(key,value){
//                   // $('#storage-'+key).val(value.storage);
//                   // $('#line_total-'+key).val(value.line_amount);
//                    //$('#vat_amount-'+key).val(value.vat_amount);
//                    //$('#vat_inclusive-'+key).val(value.vat_inclusive);
                   
//                    // console.log(key);
//                    // console.log(value.storage);

//                 //});

//                 $('#usd_grand_total').val(data.invoiceTotalExcl);
//                 $('#usd_vat').val(data.grandTotalVat);
//                 $('#usd_vat_inclusive').val(data.invoiceTotalIncl);
//                    $('#usd_grand_total').val(data.overall);
//                    // $('#storageDays2').html(data);
                    
//                 //    $('select[name=horse_id]').empty().trigger('change.select2');
//                 //    //$('select[name=trailer_id]').empty().trigger('change.select2');
//                 //     $.each(data.horse,function (key,value) {
//                 //            $('select[name=horse_id]').append($('<option/>',{
//                 //             value:key,
//                 //             text:value,
//                 //     })).val('').trigger('change.select2');
//                 //     });
                    
//                 },
//             });
//         }








</script> 
@endsection