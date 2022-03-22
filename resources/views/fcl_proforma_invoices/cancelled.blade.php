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

    <div class="panel panel-primary">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Booking Verifications </h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

              

            

            </div>

        </div>
        
        @if(count($proformaInvoices) == 0)
            <div class="panel-body text-center">
                <h4>No Booking Verifications Available!</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th>ProformaNo</th>
                            <th>Original Proforma</th>
                            <th>BL</th>
                        
                            <th>Containers</th>
                         
                          
                            <th>OriginalTotal</th>
                            <th>NewTotal</th>

                            <th>Vat</th>
                            <th>VatIncl</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($proformaInvoices as $proformaInvoice)
                   


 <tr>
                   
                            <td>
                                
                                
                                {{$proformaInvoice->proforma_invoice_number  }}</td>
                                <td>
                        
                       


                     
                        {{$proformaInvoice->parentProforma->proforma_invoice_number}}
                  
               </td>
                            <td>
                            {{$proformaInvoice->parentProforma->billOfLading->m_bl_no}}

                            
                            </td>
                            <td>
                            {{$proformaInvoice->no_of_containers}}
                            
                            </td>
                            
                            <td>         
                                 {{$proformaInvoice->parentProforma->usd_grand_total}}
</td>
                            <td>
                            
                            {{$proformaInvoice->usd_grand_total}}

                            </td>
                            <td>ddd</td>

                           
                        </tr>

                        


                   
                       
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="panel-footer">
            {!! $proformaInvoices->render() !!}
        </div>

        @endif

    </div>

    @include('booking_verifications.modal')
@endsection


@section('js')

<script>

$(function(){

 

    $(document).on('click','.show_booking_modal',function(event){
           event.preventDefault();

           //console.log();

           var url = $(this).attr('data-href'),
            method=$(this).attr('method'),
            title = $(this).attr('title');

            $.get(url,function(data){
                $('#bookingTitle').text(title);
            $('#bookingsAjaxModalForm').html(data);
           // console.log(data.container_no);
            });

        });




               //customer bracnhes ajax creation
               $(document).on('submit','form#booking_verification_form',function(event){
            event.preventDefault();
     var url =$(this).attr('action'),
     form = $('form#booking_verification_form'),
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
            $('#bookingsModalForm').modal('hide');
            window.location.reload();
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
        });

       

$(document).on('change','#bill_of_lading_id',function(){
    
    getBlContainers();

   // $('select[name=container_id]').prop("disabled", true);  

  //  alert($(this))

    

   
        //$('select[name=container_id]').prop("disabled", false); 
 
});


        function getBlContainers(){

            $('select#container_id').prop("disabled", false);
            var url ="{{url('getBlContainers')}}",
            form =$('form#booking_verification_form'),
            method = 'GET';  
            $.ajax({
                url:url,
                method:method,
                dataType:'JSON',
                data:form.serialize(),
                success:function(data){
                   $('select#container_id').empty().trigger('change.select2');
                   //$('select[name=trailer_id]').empty().trigger('change.select2');
                    $.each(data.containers,function (key,value) {
                           $('select#container_id').append($('<option/>',{
                            value:key,
                            text:value,
                    })).trigger('change.select2');
                    });
                    
                },
            });
        }
});


</script>
@endsection
