@extends('layouts.app')

@section('content')







@if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
@if(Session::has('error_message'))
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('error_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif




<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Bill Of Lading' }} {{ $billOfLading->m_bl_no }} </h4>
        </div>



    </div>

    <div class="panel-body">



<div class="row">
    <div class="col-md-3">
            <strong>Vessel:</strong> {{  isset($billOfLading->vessel->id) ? $billOfLading->vessel->vessel_name : ''  }}<br>
            <strong>Vessel Arrival:</strong> {{  $billOfLading->arrival_date }}<br>
            <strong>Voyage:</strong> {{  $billOfLading->voyage   }}<br>
            <strong>Client:</strong> {{  isset($billOfLading->client->id) ? $billOfLading->client->consignee_name : ''  }}<br>
            <strong>File Number:</strong> {{ $billOfLading->file_number }}<br>
            <strong>Cargo From:</strong> 
            {{  isset($billOfLading->terminal_id) ? $billOfLading->terminal->terminal_name : ''  }}

            
            <br>

            <strong>Consignment Type:</strong> 

            {{  isset($billOfLading->consignment_type_id) ? $billOfLading->consignmentType->consignment_type : ''  }}
            <br>
            <strong>Storage Days:</strong> 

            <span id="storage_days



















































            "></span>
            <br>



    </div>
    <div class="col-md-3">

            <strong>Place Of Destination:</strong> {{ $billOfLading->place_of_destination }}<br>
            <strong>Place Of Delivery</strong> {{ $billOfLading->place_of_delivery }}<br>
            <strong>Port Of  Loading:</strong> {{ $billOfLading->port_of_loading }}<br>

            <strong>Notify Name:</strong> 
            

            {{  isset($billOfLading->notify_id) ? $billOfLading->notify->notify_name : ''  }}
            <br>
            <strong>Shipping Line:</strong> 
            

            {{  isset($billOfLading->shipping_line_id) ? $billOfLading->shippingLine->shipping_line_name : ''  }}
            <br>
            <strong>Consignee:</strong> 
            
            {{  isset($billOfLading->client_id) ? $billOfLading->client->consignee_name : ''  }}
            
            <br>

    </div>
    <div class="col-md-3">
            <strong>Number Of Package:</strong> {{ $billOfLading->number_of_package }}<br>
        <strong>Gross Weight</strong> {{ number_format($billOfLading->gross_weight,2) }} {{ $billOfLading->gross_weight_unit }} <br>
        <strong>Port Of  Loading:</strong> {{ $billOfLading->port_of_loading }}<br>
        <strong>Number Of Containers:</strong> {{ $billOfLading->number_of_containers }}<br>
        <strong>Shipping Agent:</strong>
        
        {{  isset($billOfLading->shipping_agent_id) ? $billOfLading->shippingAgent->shipping_agent_code : ''  }}
        {{  isset($billOfLading->shipping_agent_id) ? $billOfLading->shippingAgent->shipping_agent_name : ''  }}




            <br>

            <strong>Exporter:</strong> {{  isset($billOfLading->exporter_id) ? $billOfLading->exporter->exporter_name : ''  }}
            
            
            <br>



    </div>
        <div class="col-md-3">
        <strong>Description Of Goods: </strong> 

            <div class="well">
            {{ $billOfLading->description_of_goods }} 
            </div>

            </div>
   
</div>





          
         
            
          
          
           
      
          
           
 
          
         

          

        <div class="panel-body">
        
        
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                                                                    <a data-href="{{route('proforma_invoices.create',str_encrypt($billOfLading->id))}}" data-toggle="modal" href="#modalForm" class="show_modal btn btn-success btn-xs" title="Create new Proforma invoice">
                                                                        <i class="fa fa-plus"></i>   
                                                                        
                                                                        Create Proforma</a>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-custom ">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_5_1" data-toggle="tab"> Proforoma Invoices </a>
                            </li>
                            <li>
                                <a href="#tab_5_2" data-toggle="tab"> Mps Invoice details </a>
                            </li>
                          
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_5_1">
                              
                              
                                <table class="table">
                                              
                                    <thead>
                                    
                                    <tr>
                                    
                                      <th>SN</th>
                                      <th>ProformaNumber</th>
                                      <th>Proforma Date</th>
                                      <th>Sequence No </th>
                                      <th>Reciept No</th>
                                      <th>Reciept Date</th>
                                      <th>StorageDays</th>
                                      <th>Containers</th>
                                      <th>usd_vat_exclusive</th>
                                      <th>usd_vat</th>
                                      <th>Total</th>
                                      <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php  $i=1;?>
                                    @foreach($proformaInvoices as $proformaInvoice)
                                    @if($proformaInvoice->ft_20)
                                    <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                    {{$proformaInvoice->proforma_invoice_number}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->invoice_date}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->sequence_no}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->reciept_no}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->reciept_date}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->storage_days}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->no_of_containers}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->usd_grand_total}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->usd_vat}}
                                    </td>
                                    <td>
                                    {{$proformaInvoice->usd_vat_inclusive}}
                                    </td>
                                    <td>
                                            <a data-href="{{  route('proforma_invoices.edit', str_encrypt($proformaInvoice->id )) }}" class="btn btn-primary btn-xs show_modal" title="Edit Proforma invoice {{$proformaInvoice->proforma_invoice_number}}" data-toggle="modal" href="#modalForm" >
                                             <span class="fa fa-pencil" aria-hidden="true"></span> Edit
                                            </a>
                                            <a href="{{  route('proforma.print', str_encrypt($proformaInvoice->id )) }}" class="btn btn-default btn-xs" title="Print Proforma invoice {{$proformaInvoice->proforma_invoice_number }}" >
                                                <span class="fa fa-print" aria-hidden="true"></span> print
                                            </a>
                                            @if($proformaInvoice->invoice_status_id ==2)                         
                                            <a data-href="{{  route('proforma_invoices.recreate', $proformaInvoice->id ) }}" class="btn green-jungle btn-xs show_modal" title="Recreate  Proforma invoice {{$proformaInvoice->proforma_invoice_number }}"   data-toggle="modal" href="#modalForm" >
                                                    <span class="fa fa-plus" aria-hidden="true"></span> Recreate
                                                </a>
                                            @endif




                                    </td>
                                    </tr>
                                    @endif
                                    @endforeach

                                    
                                    </tbody>
                                  
                                  </table>
                                    
                           
                           
                                </div>
                            <div class="tab-pane" id="tab_5_2">
                             
                                @if(count($mpsInvoices))

                                <?php
                                session()->put('usd_grand_total',0);
                                session()->put('usd_vat',0);
                                session()->put('usd_vat_inclusive',0);
                                ?>

                                    <table class="table">
                                                <thead>
                                                <tr>
                                                <th>Mps no</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Vat</th>
                                                <th>GrandTotal</th>
                                           
                                                <th>Action</th>
                                                </tr>
                                                </thead>
                                            <tbody>
                                                
                                                @foreach($mpsInvoices as $mpsInvoice)


                                                <tr>
                                                <?php
session()->put('usd_grand_total',session()->get('usd_grand_total') + $mpsInvoice->usd_grand_total);
session()->put('usd_vat',session()->get('usd_vat') + $mpsInvoice->usd_vat);
session()->put('usd_vat_inclusive',session()->get('usd_vat_inclusive') + $mpsInvoice->usd_vat_inclusive);
?>
                                                <td>
                                                
                                                {{$mpsInvoice->invoice_number}}
                                                </td>
                                                <td>{{$mpsInvoice->invoice_date}}</td>
                                                <td>{{$mpsInvoice->usd_grand_total}}</td>
                                                <td>{{$mpsInvoice->usd_vat}}</td>
                                                <td>{{$mpsInvoice->usd_vat_inclusive}}</td>
                                             
                                                <td>     
                                                      <a data-href="{{route('proforma_invoices.show_mps_charges',str_encrypt($mpsInvoice->id))}}" data-toggle="modal" href="#modalForm" class="show_modal btn btn-success btn-xs" title="Container mps  charges details">Charges</a>
</td>
                                                </tr>
                                               

                                @endforeach

                                                </tbody>

                                                
<tfoot>

<tr>

<th>TOTAL</th>
<th></th>


<th>{{number_format(session()->get('usd_grand_total'),3)}}</th>
<th>{{number_format(session()->get('usd_vat'),3)}}</th>
<th>{{number_format(session()->get('usd_vat_inclusive'),3)}}</th>
</tr>
</tfoot>

                                    </table>
                                    @endif
                              
                            </div>
                           
                        </div>
                    </div>
                  
                </div>
            </div>


      
     
    






@include('tpa_proforma_invoices.create_modal')
@include('containers.invoiceEditModal')
@include('containers.over')
</div>
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

//         $("#checkAll").change(function () {
//     $("input:checkbox").prop('checked', $(this).prop("checked"));
//    // console.log($(":checkbox:checked").length-1);
//     //$ln =$(":checkbox:checked").length;
// alert();
//    // console.log($(".checkContainers:checked").size());

//     //console.log($(":checkbox:checked").length)

   
// });





       $(document).on('click','.selectall',function(){
        $(".individual").prop("checked",$(this).prop("checked"));
       });

        $(document).on('click','.show_modal',function(event){
           event.preventDefault();

       

           var url = $(this).attr('data-href'),
         
            method=$(this).attr('method'),
            title = $(this).attr('title');
      
            $.get(url,function(data){
                $('#title').text(title);
            $('#modal_body').html(data);
           // console.log(data.container_no);
            });

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
            calculateStorageCharges();
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
           $('#containersModalForm').modal('hide');
           calculateStorageCharges();
           // form[0].reset();
          // window.location.reload();

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


           


$('body').click(function(){
   // getStorageDays();
   //console.log();
   calculateStorageCharges();

   ///getRemovalCharges();
});
$(document).on('change','#invoice_date',function(){
   // alert();
   //getStorageDays();
   //console.log();
   calculateStorageCharges();
  //// getRemovalCharges();
});

$(document).on('input change','.charge,#usd_rate',function(){
   // alert();
   calculateStorageCharges();
   //console.log();
  // alert();
});
      
        function calculateStorageCharges(){
            var url ="{{url('calculateIcdCharges')}}",
            form =$('form#proforma_invoice_form'),
            method = 'post';  
            $.ajax({
                url:url,
                method:method,
                dataType:'JSON',
                data:form.serialize(),
                success:function(data){
                $.each(data.containerStorage,function(key,value){
                   $('#storage-'+key).val(value.storage);
                   $('#danger_cargo-'+key).val(value.dangerous_cargo_charges);
                   $('#corridor-'+key).val(value.corridor_charge);
                   $('#open_top_charge-'+key).val(value.open_top_charge);
                   $('#line_total-'+key).val(value.line_amount);
                   $('#vat_amount-'+key).val(value.vat_amount);
                   $('#vat_inclusive-'+key).val(value.vat_inclusive);
                   $('#corridorLevy-'+key).val(value.corridorLevy);
                   $('#storage_days').val(value.storageAdjustedDays);
                    $('#removal-'+key).val(value.removal);
                $('#port_handling-'+key).val(value.handling_charge);
                $('#change_of_information-'+key).val(value.change_of_information_charge);
                $('#stripping_charge-'+key).val(value.stripping_charge);
                $('#change_of_status_charge-'+key).val(value.change_of_status_charge);
                $('#alteration_charge-'+key).val(value.alteration_charge);
                });
                $.each(data.otherCharges,function(key,value){
                   $('#danger_cargo-'+key).val(value.dangerous_charge);
                   $('#corridor-'+key).val(value.corridor_charge);
                   $('#open_top_charge-'+key).val(value.open_top_charge);
                   $('#abnormal_cargo-'+key).val(value.abnormal_cargo);
                   $('#nomination_charge-'+key).val(value.nomination_charge);
                  
                });


                $('#usd_grand_total').val(data.invoiceTotalExcl);
                $('#usd_vat').val(data.grandTotalVat);
                $('#usd_vat_inclusive').val(data.invoiceTotalIncl);     
                $('#no_of_containers').val(data.no_of_containers);     

                 $('#tzs_vat').val(data.tzs_vat); 
                $('#tzs_vat_exclusive').val(data.tzs_vat_exclusive); 
                $('#tzs_vat_inclusive').val(data.tzs_vat_inclusive); 
                $('#tzs_grand_total').val(data.tzs_grand_total); 
                $('#usd_vat_exclusive').val(data.usd_vat_exclusive); 
                $('#amount_in_words').val(data.amount_in_words);
                },
            });
        }



        $(document).on('submit','form#proforma_invoice_form',function(event){
           // event.preventDefault();

                  
           event.preventDefault();
           //console.log('asas');
            calculateStorageCharges();
     var url =$(this).attr('action'),
     form = $('form#proforma_invoice_form'),
    method =$(this).attr('method');
    ///console.log(url);
    //customer_branch=$('#customer_branch_id');
    form.find('.form-group').removeClass('has-error');
    form.find('.help-block').remove();
    $.ajax({
        url:url,
        method:method,
        dataType:'json',
        data:form.serialize(),
        success:function(data){
    
        //$('#modalForm').modal('hide');
       
      //   window.location.reload();

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




        })






        


    });
</script>




<script>
    $(function(){



//;

       

         //var grandTotal =  

     
   

    




         




      $(document).on('input','.form-control.typeahead',function(){
        autocomplete();

      })

   

    function autocomplete(){
        $(document).on('input','.form-control.typeahead',function(){
        //var path = "{{ url('icd_additional_charges') }}";

         var path = "{{ url('/') }}" + '/' + $('#container_info').val();
         console.log(path);
        arr = $(this).attr('id').split('-');
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
                           // $('#item-price-' + item_id).val(data.amount);
                            

                            //  $('#item-price-' + item_id).val(data.amount*$('#no_of_containers').val());
                              $('#item-price-' + item_id).val(data.amount);
                            // $('#item-price-' +item_id).val(data.itemPrice);
                            // $('#item-lineTotal-' + item_id).val(data.itemPrice);
                            getIcdProformaTotals();
                        }

                    });
                
        

});

    }

  








    });
</script>





<script type="text/javascript">
chargeRows= "{{$chargeRows}}";
console.log(chargeRows);
var item_row;
if(chargeRows > 0){

     item_row = chargeRows;

}else{

     item_row = 1;

}


function addItem() {


    html ='<tr id="item-row-'+item_row+'"><td class="text-center" style="vertical-align: middle;">';
        html +='<button type="button" onclick="$(\'#item-row-'+item_row+'\').remove();getIcdProformaTotals();" class="btn btn-xs btn-danger btn-sm">REMOVE </button></td>';
        html +='<td><input class="form-control typeahead" required="required" name="item['+item_row+'][name]" type="text" id="item-name-'+item_row+'">';
        html +='<input name="item['+item_row+'][charge_id]" type="hidden" id="item-id-'+item_row+'"></td>';
        html +='<td><input class="form-control text-right readonly" name="item['+item_row+'][amount]" type="text" id="item-price-'+item_row+'" readonly></td>';
        
        
        $('#items tbody #addItem').before(html);

  


    item_row++;
}





        function getIcdProformaTotals(){
            var url ="{{url('getIcdProformaTotals')}}",
            form =$('form#proforma_invoice_form'),
            method = 'post';  
            $.ajax({
                url:url,
                method:method,
                dataType:'JSON',
                data:form.serialize(),
                success:function(data){
                    
               // $('#usd_vat').val(data.grandTotalVat);
               // $('#usd_vat_inclusive').val(data.invoiceTotalIncl);
                  // $('#usd_grand_total').val(data.overall);
                    
                },
            });
        }
   

             
    //   $(document).on('submit','form#proforma_invoice_form',function(event){
    //         event.preventDefault();
    //         var form = $(this);
    //         form.find('.form-group').removeClass('has-error');
    //         form.find('.help-block').remove();
    //         $.ajax({
    //             url: form.attr('action'),
    //             type: form.attr('method'),            
    //             data: new FormData(this),
    //             contentType: false,      
    //             cache: false,           
    //             processData:false,
    //             success:function(data){
    //           //  window.location.reload();
    //             },
    //             error:function (response) {
    //                 var errors = response.responseJSON;
    //                 if($.isEmptyObject(errors)==false){
    //                     $.each(errors,function (key,value) {
    //                         $('#'+key).closest('.form-group')
    //                             .addClass('has-error')
    //                             .append('<span class="help-block">'+value+'</span>');
    //                     });
    //                 }
    //             },
    //         });
    //     });



     
    



</script> 


@endsection