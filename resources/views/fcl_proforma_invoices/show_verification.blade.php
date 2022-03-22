@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Booking Verification' }}</h4>
        </div>

        <div class="pull-right">
        
            {!! Form::open([
                'method' =>'DELETE',
                'route'  => ['booking_verifications.destroy', $bookingVerification->id]
            ]) !!}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('booking_verifications.index') }}" class="btn btn-primary" title="Show All Booking Verification">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('booking_verifications.create') }}" class="btn btn-success" title="Create New Booking Verification">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('booking_verifications.edit', $bookingVerification->id ) }}" class="btn btn-primary" title="Edit Booking Verification">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', 
                        [   
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger',
                            'title'   => 'Delete Booking Verification',
                            'onclick' => 'return confirm("' . 'Delete Booking Verification?' . '")'
                        ])
                    !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>D Order Number</dt>
            <dd>{{ $bookingVerification->d_order_number }}</dd>
            <dt>Bill Of Lading</dt>
            <dd>{{  isset($bookingVerification->billOfLading->m_bl_no) ? $bookingVerification->billOfLading->m_bl_no : ''  }}</dd>
            <dt>Clearing Agent</dt>
            <dd>{{  isset($bookingVerification->clearingAgent->id) ? $bookingVerification->clearingAgent->id : ''  }}</dd>
            <dt>Verification Type</dt>
            <dd>{{  isset($bookingVerification->verificationType->id) ? $bookingVerification->verificationType->id : ''  }}</dd>
            <dt>Container</dt>
            <dd>{{  isset($bookingVerification->container->id) ? $bookingVerification->container->id : ''  }}</dd>
            <dt>Container Location</dt>
            <dd>{{  isset($bookingVerification->containerLocation->id) ? $bookingVerification->containerLocation->id : ''  }}</dd>
            <dt>Client</dt>
            <dd>{{  isset($bookingVerification->client->id) ? $bookingVerification->client->id : ''  }}</dd>
            <dt>Customs Realize No</dt>
            <dd>{{ $bookingVerification->customs_realize_no }}</dd>
            <dt>Remarks</dt>
            <dd>{{ $bookingVerification->remarks }}</dd>
            <dt>Booking Date</dt>
            <dd>{{ $bookingVerification->booking_date }}</dd>
            <dt>Created At</dt>
            <dd>{{ $bookingVerification->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $bookingVerification->updated_at }}</dd>
            <dt>Updated By</dt>
            <dd>{{  isset($bookingVerification->updater->name) ? $bookingVerification->updater->name : ''  }}</dd>
            <dt>Created By</dt>
            <dd>{{  isset($bookingVerification->creator->name) ? $bookingVerification->creator->name : ''  }}</dd>
            <dt>Is Active</dt>
            <dd>{{ ($bookingVerification->isActive) ? 'Yes' : 'No' }}</dd>
            <dt>Vessel Arrival Information</dt>
            <dd>{{  isset($bookingVerification->vesselArrivalInformation->id) ? $bookingVerification->vesselArrivalInformation->id : ''  }}</dd>
            <dt>Vessel</dt>
            <dd>{{  isset($bookingVerification->vessel->id) ? $bookingVerification->vessel->id : ''  }}</dd>
            <dt>Booking Number</dt>
            <dd>{{ $bookingVerification->booking_number }}</dd>

        </dl>

    </div>


   

    <div class="panel-default panel">
    
    <div class="panel-heading clearfix">

    <div class="pull-left">
        <h4 class="mt-5 mb-5">Booking proforma Invoice</h4>
    </div>


    <div class="btn-group btn-group-sm pull-right" role="group">

              




@if(count($bookingVerification->proformaInvoice) < 1)
    
<a data-href="{{ route('proforma_invoices.create',$bookingVerification->id) }}" class="btn green-jungle show_modal btn-xs" title="Create New Proforma Invoice for booking Verification {{$bookingVerification->booking_number}}" data-toggle="modal" href="#modalForm">
    <span class="fa fa-plus" aria-hidden="true"></span> Create new
</a>

    @endif
     

</div>

 

</div>
    
    <div class="panel-body">
    
 
    @if(count($bookingVerification->proformaInvoices) > 0 )



        <table class="table">

            <thead>

                            <tr>
                            
                            
                            <th>SN</th>
                            <th>ProformaNumber</th>
                            <th>Recreated</th>
                            <th>ProformaDate</th>
                            <th> status</th>
                            <th>Storage days</th>
                     
                            <th>Containers </th>
                            <th>Amount </th>
                            <th>VAT </th>
                            <th>Total </th>
                            </tr>

            </thead>

<tbody>



@foreach($bookingVerification->proformaInvoices as $proformaInvoice)
<tr>

<td>1</td>
<td>{{$proformaInvoice->proforma_invoice_number}}</td>

<td>

{{isset($proformaInvoice->parent_proforma_invoice_id) ? 'Yes': 'No' }}
</td>
<td>{{$proformaInvoice->invoice_date}}</td>
<td>{{$proformaInvoice->invoiceStatus->invoice_status}}</td>
<td>{{$proformaInvoice->storage_days}}</td>
<td>{{$proformaInvoice->no_of_containers}}</td>
<td>{{$proformaInvoice->usd_grand_total}}</td>
<td>{{$proformaInvoice->usd_vat}}</td>
<td>{{$proformaInvoice->usd_vat_inclusive}}</td>


<td>

<a data-href="{{  route('proforma_invoices.edit', $proformaInvoice->id ) }}" class="btn btn-primary btn-xs show_modal" title="Edit Proforma invoice {{$proformaInvoice->proforma_invoice_number}}" data-toggle="modal" href="#modalForm" >
                                          <span class="fa fa-pencil" aria-hidden="true"></span> Edit
                                         </a>


                                         <a href="{{  route('proforma.print', $proformaInvoice->id ) }}" class="btn btn-default btn-xs" title="Print Proforma invoice {{$proformaInvoice->proforma_invoice_number }}" >
                                          <span class="fa fa-print" aria-hidden="true"></span> print
                                         </a>
 @if($proformaInvoice->invoice_status_id ==2)                         
<a data-href="{{  route('proforma_invoices.recreate', $proformaInvoice->id ) }}" class="btn green-jungle btn-xs show_modal" title="Recreate  Proforma invoice {{$proformaInvoice->proforma_invoice_number }}"   data-toggle="modal" href="#modalForm" >
        <span class="fa fa-plus" aria-hidden="true"></span> Recreate
       </a>
@endif





</td>



</tr>
@endforeach

</tbody>



        </table>

    @endif
    
    </div>

    
    
    </div>
</div>


@include('proforma_invoices.modal')
@endsection






@section('js')

<script>

$(function(){



    $(document).on('click','.show_modal',function(event){
           event.preventDefault();

           //console.log();

           var url = $(this).attr('data-href'),
            method=$(this).attr('method'),
            title = $(this).attr('title');

            $.get(url,function(data){
               $('#title').text(title);
           $('#modal_body').html(data);
           // console.log(data.container_no);
            });

        });
});


</script>



<script>


    $(function(){
        $(document).on('click','.selectall',function(){
        $(".individual").prop("checked",$(this).prop("checked"));
       });




  $(".readonly").keydown(function(e){
e.preventDefault();
});

calculateCharges();
      //  getIcdProformaTotals();

         //var grandTotal =  

        $("body").on('click',function(){
          //  getIcdProformaTotals();
           calculateCharges();

          // getNominationCharges();
        });


       
        // $(document).on('click','.show_container_modal',function(event){
        //    event.preventDefault();

        //    //console.log();

        //    var url = $(this).attr('data-href'),
        //     method=$(this).attr('method'),
        //     title = $(this).attr('title');

        //     $.get(url,function(data){
        //         $('#containersTitle').text(title);
        //     $('#containersAjaxModalForm').html(data);
        //    // console.log(data.container_no);
        //     });

        // });

    


               //customer bracnhes ajax creation
               $(document).on('submit','form#icd_proforma_invoice_form',function(event){
            event.preventDefault();
     var url =$(this).attr('action'),
     form = $('form#icd_proforma_invoice_form'),
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
   calculateCharges();
   //getNominationCharges();

  // getRemovalCharges();
});

$(document).on('input','.charge',function(){
   // alert();
   calculateCharges();
   //getNominationCharges();
   //console.log();
  // alert();
});
  


//         function calculateStorageCharges(){
//             var url ="{{url('calculateStorageCharges')}}",
//             form =$('form#icd_proforma_invoice_form'),
//             method = 'post';  
//             $.ajax({
//                 url:url,
//                 method:method,
//                 dataType:'JSON',
//                 data:form.serialize(),
//                 success:function(data){

// //console.log(data.invoiceTotalExcl);
//                 $.each(data.containerStorage,function(key,value){
//                   $('#storage-'+key).val(value.storage);
//                    $('#line_total-'+key).val(value.line_amount);
//                    $('#vat_amount-'+key).val(value.vat_amount);
//                    $('#vat_inclusive-'+key).val(value.vat_inclusive);


                   
                   
//                    // console.log(key);
//                    // console.log(value.storage);

//                 });

//                 $('#usd_grand_total').val(data.invoiceTotalExcl);
//                 $('#usd_vat').val(data.grandTotalVat);
//                 $('#usd_vat_inclusive').val(data.invoiceTotalIncl);
//                    /// $('#storageDays').val(data);
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






                function calculateCharges(){
            var url ="{{url('calculateStorageCharges')}}",
            form =$('form#icd_proforma_invoice_form'),
            method = 'post';  
            $.ajax({
                url:url,
                method:method,
                dataType:'JSON',
                data:form.serialize(),
                success:function(data){
                $.each(data.containerStorage,function(key,value){
                //$('#storage-'+key).val(value.storage);
                //    $('#line_total-'+key).val(value.line_amount);
                //    $('#vat_amount-'+key).val(value.vat_amount);
                //    $('#vat_inclusive-'+key).val(value.vat_inclusive);
                 $('#storage_days').val(value.storageAdjustedDays);
                   $('#removal-'+key).val(value.removal);
                   $('#nomination-'+key).val(value.nomination);

//console.log(value.storage);
                $('#storage-'+key).val(value.storage);
                   $('#line_total-'+key).val(value.line_amount);
                   $('#vat_amount-'+key).val(value.vat_amount);
                   $('#vat_inclusive-'+key).val(value.vat_inclusive);
                });
                //invoiceTotalExcl
                $('#usd_grand_total').val(data.invoiceTotalExcl);
                $('#usd_vat').val(data.grandTotalVat);
                $('#usd_vat_inclusive').val(data.invoiceTotalIncl);
                    $('#ticts_tpa_invoice_date').val(data.ticts_invoice_date);

                },
            });
        }

        


//                 function getNominationCharges(){
//             var url ="{{url('getNominationCharges')}}",
//             form =$('form#icd_proforma_invoice_form'),
//             method = 'post';  
//             $.ajax({
//                 url:url,
//                 method:method,
//                 dataType:'JSON',
//                 data:form.serialize(),
//                 success:function(data){
//                 $.each(data.containerStorage,function(key,value){
//                 //$('#storage-'+key).val(value.storage);
//                 //    $('#line_total-'+key).val(value.line_amount);
//                 //    $('#vat_amount-'+key).val(value.vat_amount);
//                 //    $('#vat_inclusive-'+key).val(value.vat_inclusive);
//                 // $('#corridorLevy-'+key).val(value.corridorLevy);
//                 // $('#storage_days').val(value.storageAdjustedDays);
//                  //  $('#removal-'+key).val(value.removal);

// //console.log(value.storage);
//                 //$('#storage-'+key).val(value.storage);
//                  //  $('#line_total-'+key).val(value.line_amount);
//                  //  $('#vat_amount-'+key).val(value.vat_amount);
//                  //  $('#vat_inclusive-'+key).val(value.vat_inclusive);
//                 });
              
//                 //$('#usd_grand_total').val(data.invoiceTotalExcl);
//                 //$('#usd_vat').val(data.grandTotalVat);
//                 //$('#usd_vat_inclusive').val(data.invoiceTotalIncl);   
//                 },
//             });
//         }






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
                        //console.log();
                       // $('#item-price-' +item_id).val(data.itemPrice);
                       // $('#item-lineTotal-' + item_id).val(data.itemPrice);
                      // getIcdProformaTotals();
                    }

                });
          
             

});

 $(document).on('input', '#items tbody .form-control', function(){
            //getIcdProformaTotals();
       });







    });
</script>

<script type="text/javascript">
var item_row = 1;
function addItem() {
    html ='<tr id="item-row-'+item_row+'"><td class="text-center" style="vertical-align: middle;">';
        html +='<button type="button" onclick="$(\'#item-row-'+item_row+'\').remove();calculateCharges();" class="btn btn-xs btn-danger btn-sm">REMOVE </button></td>';
        html +='<td><input class="form-control typeahead" required="required" name="item['+item_row+'][name]" type="text" id="item-name-'+item_row+'">';
        html +='<input name="item['+item_row+'][charge_id]" type="hidden" id="item-id-'+item_row+'"></td>';
        html +='<td><input class="form-control text-right readonly" required="required" name="item['+item_row+'][amount]" type="text" id="item-price-'+item_row+'" data-readonly></td>';
        $('#items tbody #addItem').before(html);
    item_row++;
}




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