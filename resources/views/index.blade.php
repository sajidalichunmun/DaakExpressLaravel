@extends('layouts.main')

@section('css')
<link href="{{ asset('CustomCssJS/CSS/modalCss.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <img src="{{ asset('Images/logo.png') }}" alt="logo" class="img-responsive">
        </div>
        <div class="col-sm-6">
            <div class="col-xs-12 text-justify">
            <p><strong>Index Blade</strong>
                It gives us great pleasure to introduce ourselves for Daak Express and leading various type of service here under one roof.
            </p>
            </div>
            <hr style="border: 1px solid #454545;">
            <div class="col-xs-12">
                <ul>
                    <li>KYC / Document Verification</li>
                    <li>Document Collections / Cash Collection / Chq Collection</li>
                    <li>Local /Domestic/ international Courier, Cargo and Mailing Services.</li>
                </ul>
            </div>
            <hr style="border: 1px solid green;">
            <div class="col-sm-12 text-justify">
                <p>
                    Head Office in Mumbai and our branch offices are in Pune, Nashik, Nagpur, Surat, Baroda, Ahmadabad, Bhopal, Indore, Hyderabad, Chennai, Kolkata, Guwahati, Bhubneshwar, Ranchi, Patna, Bangalore, New Delhi, Lucknow, Jaipur, Chandigarh and Rest of the network is operated as Exclusive Franchisee model.
                    Daak Express commenced domestic operating and has steadily grown occupy a prominent position in the Verification , Collection ,Courier, Logistic and Mailing industry.  Basically we are handling in the bulk Courier, Parcels & Cargo and Mailing services in India.
                    SGL Group a name of trust & value in the field of courier, logistics, Mailing, verification and collection portfolio solutions.
                    The growth of Daak Express has been tremendous, and presently, the company enjoys the highest credibility in the market. We have a very strong capital base with an equally Strong operational infrastructure, and are confident of providing the best service. We have a very comprehensive list of satisfied customer, to whom we have been rendering regular service. 
                    Main thought of this company to provide good services with quality delivery and timely delivery to our valuable customer.
                </p>
            </div>
        </div>
        <div class="col-sm-3">
            <!--p>Right Side Panel</p-->
            <div class="panel  panel-primary">
                <div class="panel-heading clearfix">
                    <h2 class="black-color">TRACK ORDER</h2>
                </div>
                <div class="panel-body panel-body-with-table">
                    <div class="tracking-form white-bg radius clearfix"> 
                        <form name="frmSearch" id="frmSearchID" class="trackform" method="post" encrypt="multi/form">
                            @csrf
                            <div class="form-check-inline"> 
                                <label class="customradio" onclick="sendGaEvent('banner_trackform', 'radio_btn_awb', 'track_order');">
                                    <span class="radiotextsty">Awb No</span> 
                                    <input type="radio" checked="checked" name="radio" id="radio" class="trackradio trackRadioAWB" value="track_id"> 
                                    <span class="checkmark"></span> 
                                </label> 
                                <label class="customradio" onclick="sendGaEvent('banner_trackform', 'radio_btn_orderid', 'track_order');">
                                    <span class="radiotextsty">Ref No</span> 
                                    <input type="radio" name="radio" id="radio" class="trackradio trackRadioOrder" value="orderId"> 
                                    <span class="checkmark"></span> 
                                </label> 
                                <label class="customradio" onclick="sendGaEvent('banner_trackform', 'radio_btn_lrn', 'track_order');">
                                    <span class="radiotextsty">LTL Shipment (LRN)</span> 
                                    <input type="radio" name="radio" id="radio" class="trackradio trackRadioLRN" value="lrnumber"> 
                                    <span class="checkmark"></span> 
                                </label>
                            </div>
                            <div class="clear"></div>
                            <div class="hometracking-container clearfix">
                                <div class="hintfix"> 
                                    <span class="msg hintfixError">Enter Valid Tracking ID</span>
                                </div>
                                <div class="col-sm-12 nopadding">
                                    <div class="form-group"> 
                                        <input type="hidden" class="form-control tracktext" onkeypress="return AvoidSpace(event)" id="tracking-id" name="tracking-id" onclick="sendGaEvent('banner_trackform', 'awb_orderid_input', 'track_order');">
                                        <input type="text" value="CIBOM0126232" class="form-control tracktext" id="podno" name="podno" required="">
                                    </div>
                                    <span class="msg"></span> 
                                    <!-- <span class="msg">* Track multiple orders separated by 'space'</span> -->
                                </div>
                                <div class="col-sm-6 nopadding"> 
                                    <button type="button" class="btn uppercase default-btn btn-primary btn-sm radius view_data">
                                        <!--div id="loader_div" class="loader_div"></div-->Track
                                    </button>
                                    
                                    <!--button type="button" name="btnCheck" id="btnCheckID" onclick="document.getElementById('trckingModalID').style.display='block';">Click me</button-->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END RIGHT SIDE BAR -->
        </div>
    </div>
    <div class="panel  panel-primary">
        <div class="panel-heading clearfix">
          <p>Copyright &copy; 2019-2020 &copy; Daak Express</p>
          <p>All rights reseved Powred by <span>Sajid Ali</span></p>
        </div>
    </div>
</div>
        
<!-- SIMPLE MODAL -->
<div id="trckingModalID" class="tracking-modal">
    <div class="tracking-modal-content">
        <div class="tracking-modal-header">
            <span class="trackingBtn" onClick="document.getElementById('trckingModalID').style.display='none'">&times;</span>
            <h2>TRACKING DETAILS</h2>
        </div>
        <div class="tracking-modal-body">
            <div id="traking_details"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" onClick="document.getElementById('trckingModalID').style.display='none'">Close</button>
        </div>
        <div class="tracking-modal-footer">
            <h3>&copy;Daak Express Pvt Ltd.</h3>
        </div>
    </div>
</div>
<!--SIMPLE MODAL END -->
<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">TRACKING DETAILS</h4>
                <div class="modal-body" id="trakinc_details">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="{{ asset('Autocomplete/UI/1.11.4/themes/smoothness/jquery-ui.css')}}">
<script src="{{ asset('Autocomplete/UI/1.11.4/jquery-ui.js') }}"></script>
<script src="{{ asset('Autocomplete/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script src="{{ asset('ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
    $('.view_data').click(function(e){
	   event.preventDefault();
       if($('#podno').val()=='')
       {
           alert("Please enter a valid LR Number");
           return false;
       }
	   var id=$('#tracking-id').val();
	   var radiovalue=document.querySelector('input[name="radio"]:checked').value;
	   var podno = $('#podno').val();
       var div = document.getElementById('search-pod');
       var div1 = document.getElementById('pod-details');
       console.log(div);
       console.log(div1);
       if(div != null)
       {
            //div.parentNode.removeChild(div);
            div.remove();
       }
       if(div1 != null)
       {
            //div.parentNode.removeChild(div);
            div1.remove();
       }
      
          // Fetch data
          $.ajax({
            url:"{{route('queryPod1')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               podno:podno,radio : radiovalue
            },
            success: function( response ) {
                $('#traking_details').html(response.responseText);
               
                $('#trckingModalID').show();
            },
            error:function(err){
                $('#traking_details').html(err.responseText);
                $('#trckingModalID').show();
            }
          });
   }); 
});
</script>
@endsection
