@extends('layouts.app')

@section('content')

<div class="portlet light bordered">
                                
                                    <div class="portlet-body">
 
{!!Form::open(['method'=>'GET','class'=>''])!!}

<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Bill Of lading</label>
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="fa fa-file"></i>
                </span>
                {!!Form::text('bl',null,['class'=>'form-control','placeholder'=>'Bill of Lading '])!!}
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>File no</label>
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="fa fa-file"></i>
                </span>
                {!!Form::text('file',null,['class'=>'form-control','placeholder'=>'File number  '])!!}
                </div>
                </div>
            </div>
        </div>
    </div>

      <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Voyage</label>
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="fa fa-file"></i>
                </span>
                {!!Form::text('voyage',null,['class'=>'form-control','placeholder'=>'Voyage number  '])!!}
</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Arrival From</label>

                       <div class="input-group date date-picker"  data-date-format="dd/mm/yyyy" data-date-viewmode="years">
                                   {!!Form::text('arrival_from',null,['class'=>'form-control input-small pickadate','placeholder'=>'--arrival date--','readonly'=>'readonly'])!!}
                                <span class="input-group-btn">
                                   <button class="btn btn-default clear_date" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                             </div>


                </div>
            </div>
        </div>
    </div>

        <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Arrival to</label>
                <div class="input-group date date-picker"  data-date-format="dd/mm/yyyy" data-date-viewmode="years">
                                   {!!Form::text('arrival_to',null,['class'=>'form-control input-small pickadate','placeholder'=>'--arrival date--','readonly'=>'readonly'])!!}
                                <span class="input-group-btn">
                                   <button class="btn btn-default clear_date" type="button">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                             </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Consignee</label>
                

                                {!!Form::select('consignee', $clients,null,['class'=>'form-control select2-allow-clear filter','placeholder'=>'select consignee','id'=>'consignee_id'])!!}

                </div>
            </div>
        </div>
    </div>


    

</div>


<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Destination Country</label>
         
                {!!Form::select('country',$countries,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select destination country   ','id'=>'country_id'])!!}

              

             
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Place of destination </label>
              {!!Form::select('destination', $destinations,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select destination  ','id'=>'destination_id'])!!}


                </div>
            </div>
        </div>
    </div>

      <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Vessel type</label>
             
              {!!Form::select('vesseltype', $vesselTypes,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select vessel Type  ','id'=>'vessel_type_id'])!!}

                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    
                    <div class="col-md-6">
                        
                           <div class="form-group">
                                    <label>Ship Arrived</label>

                                             <div class="mt-checkbox-list">
                                                            <label class="mt-checkbox mt-checkbox-outline"> 
                                                          
                                                             {!!Form::checkBox('arrival',null)!!}
                                                            <span></span>
                                                         </label>
                                     
                                            </div>



                                    </div>
                    </div>
<div class="col-md-6">
    
   <div class="form-group">
                <label>Nominated</label>

                         <div class="mt-checkbox-list">
                                        <label class="mt-checkbox mt-checkbox-outline"> 
                                         

                                         
{!!Form::checkBox('nominated',null)!!}
                                         
                                        <span></span>
                                     </label>
                 
                        </div>



                </div>


</div>

                </div>
             

             
           





            </div>
        </div>
    </div>

        <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Shpping Line</label>
           {!!Form::select('shippingline', $shippingLines,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select shipping line  ','id'=>'shipping_line_id'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Vessel</label>
                

   {!!Form::select('vessel', $vessels,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select vessel  ','id'=>'vessel_id'])!!}
                </div>
            </div>
        </div>
    </div>


    

</div>



<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Shipping Agent</label>
         
                   {!!Form::select('shippingagent',$shippingAgents,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select shpping agent  ','id'=>'shipping_agent_id'])!!}
             

             
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Consignment Type </label>
              
  {!!Form::select('consignmenttype',$consignmentTypes,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select consignment type   ','id'=>'consignment_type_id'])!!}
                </div>
            </div>
        </div>
    </div>

      <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label>Clearing agent</label>
              {!!Form::select('clearingagent', $clearingAgents,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select clearing agent  ','id'=>'clearing_agent_id'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label>Cargo from</label>
{!!Form::select('cargofrom',$terminals,null,['class'=>'form-control select2-allow-clear','placeholder'=>'select cargo from   ','id'=>'cargo_from_id'])!!}
                </div>
            </div>
        </div>
    </div>

        <div class="col-md-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label></label>
           
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label></label>
                </div>
            </div>
        </div>
    </div>
</div>                                
{!!Form::submit('Search',['class'=>'btn btn-primary'])!!}
{!!Form::close() !!}
                                        
</div>
</div>



    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif


<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
          <i class="icon-share font-dark"></i>
           <span class="caption-subject font-dark bold uppercase">Manifests documents</span>
        </div>
        <div class="actions">
                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                <i class="icon-cloud-upload"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </div>
    </div>

                               


 


 
        
        @if(count($billOfLadings) == 0)
            <div class="portlet-body text-center">
                <h4>No Bill Of Ladings Available!</h4>
            </div>
        @else
        <div class="portlet-body portlet-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>

                        <th>Bl No</th>
                            <th>File No</th>
                            <th>Nominated</th>
                            <th>ArrivalDate</th>
                            <th>S/L</th>
                            <th>Port</th>
                            <th>Gross</th>
                            <th>Vol</th>
                            <th>Vessel</th>
                            <th>Voyage</th>
                            <th>Consignee</th>
                           
                           
                         
                            <th>Destination</th>
                          <th>Consignment</th>
                          <th>Cargofrom</th>
                       
                            <th>Port</th>
                            <th>Containers</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($billOfLadings as $billOfLading)
                        <tr>
                        <td>
                  
                           
<a href="{{ route('proforma_invoices.show_manifest', str_encrypt($billOfLading->id) ) }}" class="entry">{{ $billOfLading->m_bl_no }} </a>



                    </td>
                            <td>
                                 {{ $billOfLading->file_number }}
                            

                            </td>

                            <td>{{$billOfLading->is_nominated ==1 ? 'Yes': 'No'}}</td>
                             <td>{{$billOfLading->arrival_date}}</td>
                               <td>{{$billOfLading->shippingLine->shipping_line_name}}</td>
                                    <td>{{$billOfLading->port_of_loading}}</td>
                                       <td>{{$billOfLading->gross_weight}} {{$billOfLading->gross_weight_unit}}</td>
                            <td>{{$billOfLading->gross_volume}} {{$billOfLading->gross_volume_unit}}</td>
                            <td>{{  isset($billOfLading->vessel->id) ? $billOfLading->vessel->vessel_name : ''  }}</td>
                            <td>{{ $billOfLading->voyage  }}</td>
                            <td>{{  isset($billOfLading->client->id) ? $billOfLading->client->consignee_name : ''  }}</td>
                            <td>{{ $billOfLading->destination->destination_code }}, {{$billOfLading->country->country_name}}</td>
                            <td>
                            {{$billOfLading->consignmentType->consignment_type}}
                            
                            </td>

                            <td>{{$billOfLading->terminal->terminal_name}}</td>
                            <td>{{ $billOfLading->port_of_loading }}</td>
                            <td>{{ $billOfLading->number_of_containers }}</td>

                          
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="portlet-footer">
            {!! $billOfLadings->render() !!}
        </div>

        @endif

    </div>

    @include('manifests.modal')
@endsection

@section('css')

                <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
   
                <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('js')
  <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/pages/scripts/components-select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
 
    <script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script>

    $(function(){


    //     $('.filter').each(function(index,object){
    // //name ='sdsdsdsd';
    //     //name =  (name2 =='id' ||  ( name3 && name3 =='id'))  ?  name1  :  name1+' '+name2 +' '+name3;
    //         $(this).select2({
    //             placeholder:'-- Select '+name+ ' --',
    //             allowClear:true
    //         });
    //       //  console.log(name2);
    //     });


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



                 //customer bracnhes ajax creation
                 $(document).on('submit','form#bill_of_lading_form',function(event){
            event.preventDefault();
     var url =$(this).attr('action'),
     form = $('form#bill_of_lading_form'),
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

    });
</script>
@endsection


