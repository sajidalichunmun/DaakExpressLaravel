@extends('layouts.app')

@section('content')

<div class="portlet light ">                                                     
    <div class="portlet-title">
            <div class="caption caption-md">
                <i class="icon-bar-chart font-dark hide"></i>
                <span class="caption-subject font-green-steel uppercase bold">
                    Proforma Invoice {{$proformaInvoice->proforma_invoice_number}}
                </span>
           
            </div>
            <div class="actions">
               

                   <a href="JavaScript:;;" onclick="printContent('printContents')" class="btn btn-default btn-circle">
                                        <i class="fa fa-print"></i> 
                                        
                                        Print</a>
                                        
                                        
            </div>
    </div>
    <div class="portlet-body">
    <section>              
    <div class="row">
        <div class="col-md-12">
            <div id="printContents">
                    <table  class="" id='top_header'>
                        <tbody>
                            <tr>

                            <td width='20%' id='logo'> 

                           
                             <img src="{{asset('images/logo.png')}}" alt="" class="logo-default" height='100'>
                            </td>
                            <td>


                                <table>


                                <tr>
                                <th width='60%' id='header'>
                                <span class='main'> TANZANIA ROAD HAULAGE (1980) LTD</span>  
                                <br>
                                <span class='main2'>INLAND CONTAINER DEPOT(ICD)</span>
                                <br>
                                P.O Box 21493, Nelson Mandela Express Way, Dar es Salaam, Tanzania
                                <br>
                                Tel: 213366, 2118327-8, 2115260-1, Fax: 2113358, 2112585, Telex 41952
                                </th>
                                <td width='20%'></td>
                                </tr>
                                </table>
                            </td> 
                            </tr>
                        </tbody> 
                    </table>
                    <br>
                    <table  class="" id='proforma_number'>
                        <tbody>
                        <tr>
                        <th>
                            <span class='main'>PROFORMA INVOICE <br>  {{$proformaInvoice->proforma_invoice_number}} </span>
                        </th>
                    </tr> 
                        </tbody>
                    </table>
                    <br>
                    <table id='details'>
                    <tr>
                        <th style='width:15%'>Consignee</th>
                        <td style='width:30%'>{{$proformaInvoice->client->consignee_name}}</td>
                        <th style='width:15%'>Consignee TIN</th>
                        <td style='width:10%'>{{$proformaInvoice->client->consignee_tin}}</td>
                        <th style='width:10%'>BL No</th>
                        <td style='width:20%'>{{$proformaInvoice->billOfLading->m_bl_no}}</td>
                    </tr>
                    <tr>
                        <th>File No</th>
                        <td>{{$proformaInvoice->billOfLading->file_number}}</td>
                        <th>Voyage</th>
                        <td>{{$proformaInvoice->billOfLading->voyage}}</td>
                        <th>Cargo Type:</th>
                        <td>{{$proformaInvoice->billOfLading->consignmentType->consignment_type}}</td>
                    </tr>
                    <tr>
                        <th>C/F:</th>
                        <td>{{isset($proformaInvoice->billOfLading->clearingAgent) ? $proformaInvoice->billOfLading->clearingAgent->agent_name : '' }}</td>
                        <th>Destination</th>
                    <td>{{isset($proformaInvoice->billOfLading->destination) ? $proformaInvoice->billOfLading->destination->destination_code : '' }}</td>
                    <th>Vessel:</th>
                        <td>
                        {{$proformaInvoice->billOfLading->vessel->vessel_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>Container From:</th>
                        <td>{{$proformaInvoice->billOfLading->terminal->terminal_name}}</td>
                        <th>Shipp Arrival:</th>
                        <td>{{$proformaInvoice->billOfLading->arrival_date}}</td>
                        <th>D/Order:</th>
                        <td>
                        {{isset($proformaInvoice->billOfLading) ? $proformaInvoice->billOfLading->d_order_number : ''}}
                        </td>
                    </tr>
                    <tr>
                    <th>Shipping Line:</th>
                    <td>{{$proformaInvoice->billOfLading->shippingLine->shipping_line_name}}</td>
                    <th>Ticts No:</th>
                    <td>{{isset($proformaInvoice->ticts_invoice_id) ? $proformaInvoice->tictsInvoice->invoice_number :''}}</td>
                    </tr>
                </table>
                <br>
                <table id='charges'>
                <thead>
                <tr>
                <th>Description</th>
                <th>No of Days</th>
                <th>Tariff Rate</th>
                <th>Unit</th>
                <th>Amount</th>
                </tr>
                </thead>
                    <tbody>
                    <?php
                    $items = count($proformaInvoice->containerInvoiceCharges);
                    $handling=0;
                    $storage=0;
                    foreach($proformaInvoice->containerInvoiceCharges as $containerCharge){
                        $handling +=$containerCharge->port_handling_charge;
                        $storage +=$containerCharge->storage_charge;
                    }
                    ?>
                    @foreach($proformaCharges as $proformaCharge)
                    <tr>
                    <td>
                    {{title_case($proformaCharge->charge->charge_description)}}
                    </td>
                    <td>
                    @if(strtolower($proformaCharge->charge->charge_description) =='storage charge')
                    {{$proformaInvoice->storage_days}}
                    @endif
                    </td>
                    <td>{{tariff_rate($proformaInvoice->id,$proformaCharge->charge_id)}}</td>
                    <td>
                    {{count_invoice_unit($proformaInvoice->id,$proformaCharge->charge_id)}}
                    </td>
                    <td>
                    {{number_format($proformaCharge->total_amount *$rate,2)}}
                    </td>
                    </tr>
                    @endforeach
                    @if($mpsContainers > 0)
                    <tr>
                    <td>
                    MPS Total Charges
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                    {{$mpsContainers}}
                    </td>
                    <td>
                    {{number_format($mpsTotalCharges * $rate,2)}}
                    </td>
                    </tr>
                    @endif
                    </tbody>
                <!-- invoice totals -->
                    <tfoot>
                        <tr>
                    <th>VAT Exclusive: </th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{($proformaInvoice->tzs_vat_exclusive)}}</td>
                    </tr>
                    <tr>
                    <td>VAT (18%)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{($proformaInvoice->tzs_vat)}}</td>
                    </tr>
                    <tr>
                    <td>Grand Total</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{($proformaInvoice->tzs_vat_inclusive)}}</td>
                    </tr>
                    </tfoot>
                </table>                                                   
                    <br>
                    <table id='containers'>
                        <tr>
                            <td>
                            <div class="row">
                                <div class="col-md-12">
                                {{implode(', ',$proformaContainers)}}
                                </div>
                            </div>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table id='invoice_summary'>
                        <tr>
                        <th>
                        No of containers: {{$proformaInvoice->no_of_containers}}
                        </th>

  <td style='float:right'>
                            <span id='invoice_date'>Charged Upto: {{$proformaInvoice->invoice_date}}</span>
                            <span id='exchange_rate'>
                        Exchange Rate : {{$rate}}
                    </span>
                        </td>
                        </tr>
                        <tr>
                        <td style='border:none;'><br>
                    <br></td>
                        </tr>
                        <tr>
                        <th colspan='2'>
                        {{$proformaInvoice->amount_in_words}}
                        </th>
                        </tr>
                    </table>
                    <table id='footer'>
                    <tr>
                        <th>Prepared By : <br>
                        {{$proformaInvoice->creator->name}}</th>
                        <th>Prepared : <br>
                        {{$proformaInvoice->created_at}}</th>
                        <td>The Invoice shall be paid at prevailing exchange rate of the Date</td>
                    </tr>
                   

                    </table>
            </div> 
        </div>
    </div>                                         
 </section>                                                    
</div>
</div>

 
@endsection
	
@section('css')
<link rel="stylesheet" href="{{asset('css/print_proforma.css')}}">
@endsection


