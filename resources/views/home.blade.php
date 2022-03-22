@extends('layouts.app')
@section('css')
<link href="{{ asset('CustomCssJS/CSS/modalCss.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="container">
    <!--div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div-->
	
	<div class="card-body">
		@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
		@endif
		
	</div>
	<div class="panel panel-primary">

		<div class="panel-body text-center">
             <div class="row">
                <div class="col-sm-3">
                    <img src="{{ asset('Images/logo.png') }}" alt="logo" class="img-responsive">
                </div>
                <div class="col-sm-6">
                    <div class="col-xs-12 text-justify">
                    <p><strong>Home Blade</strong>
                        It gives us great pleasure to introduce ourselves for SGL EXPRESS and leading various type of service here under one roof.
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
                            SGL Express commenced domestic operating and has steadily grown occupy a prominent position in the Verification , Collection ,Courier, Logistic and Mailing industry.  Basically we are handling in the bulk Courier, Parcels & Cargo and Mailing services in India.
                            SGL Group a name of trust & value in the field of courier, logistics, Mailing, verification and collection portfolio solutions.
                            The growth of SGL Express has been tremendous, and presently, the company enjoys the highest credibility in the market. We have a very strong capital base with an equally Strong operational infrastructure, and are confident of providing the best service. We have a very comprehensive list of satisfied customer, to whom we have been rendering regular service. 
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
                                <form name="frmSearch" id="frmSearchID" class="trackform" method="post">
                                    @csrf                                  
                                    <div class="form-check-inline"> 
                                        <label class="customradio" >
                                            <span class="radiotextsty">Awb No</span> 
                                            <input type="radio" checked="checked" name="radio" id="radio" class="trackradio trackRadioAWB" value="track_id"> 
                                            <span class="checkmark"></span> 
                                        </label> 
                                        <label class="customradio" >
                                            <span class="radiotextsty">Ref No</span> 
                                            <input type="radio" name="radio" id="radio" class="trackradio trackRadioOrder" value="orderId"> 
                                            <span class="checkmark"></span> 
                                        </label> 
                                        <label class="customradio" >
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
                                                <!--input type="text" class="form-control tracktext" onkeypress="return AvoidSpace(event)" id="tracking-id" name="tracking-id" onclick="sendGaEvent('banner_trackform', 'awb_orderid_input', 'track_order');"-->
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
                    <!-- END RIGHT SIDE BAR -->
                </div>
            </div>    
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
            <!-- <hr style="border:1px solid green;"><div class="table-responsive">
						<table class="table table-dark table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th>Sr No</th>
								<th>Awb No</th>
								<th>Customer Name</th>
								<th>Status</th>
								<th>Created By</th>
								<th>Created On</th>
							</tr>
						</thead>
						<tbody>
                        </tbody>
                        </table> -->
                <!-- <input type="text" readonly id="ClientCodeName" name="ClientCodeName">
                <input type="text" readonly id="ClientCodeID" name="ClientCodeID">
                <input type="text" readonly id="majorname" name="majorname">
                <input type="text" readonly id="CustomerName" name="CustomerName">
                <input type="text" readonly id="address" name="address">
                <input type="text" readonly id="MobileNo" name="MobileNo"> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" onClick="document.getElementById('trckingModalID').style.display='none'">Close</button>
        </div>
        <div class="tracking-modal-footer">
          <p>Copyright &copy; 2019-2020 &copy; Daak Express</p>
          <p>All rights reseved Powred by <span>Sajid Ali</span></p>
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
	   var id=$('#tracking-id').val();
	   var radiovalue=document.querySelector('input[name="radio"]:checked').value;
       var podno = $('#podno').val();
       var msg = "value not be empty!!!";
       if(podno =='')
       {
           if(radiovalue === 'track_id')
            msg = "Please enter a valid Awb Number";
           else if(radiovalue === 'orderId')
            msg = "Please enter a valid Ref Number";
           else if(radiovalue === 'lrnumber')
            msg = "Please enter a valid Barcode Number";

           alert(msg);
           return false;
       }

	   
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
                //console.log(response);
                $('#traking_details').html(response.responseText);
               
                $('#trckingModalID').show();
                //$('tbody').html(response);
                // response.forEach(function(currentValue, index)
                // {
                //     console.log(currentValue);
                //     $('#ClientCodeName').val(currentValue["AwbNo"]);
                //     $('#ClientCodeID').val(currentValue["RefNo"]);
                //     $('#majorname').val(currentValue["BarcodeNo"]);
                //     $('#CustomerName').val(currentValue["CustomerName"]);
                //     $('#MobileNo').val(currentValue["MobileNo"]);
                //     $('#address').val(currentValue["Address1"]+`,`+currentValue["Address2"]+`,`+currentValue["Pincode"]);
                // });
            },
            error:function(err){
                //console.log(err);
                $('#traking_details').html(err.responseText);
                $('#trckingModalID').show();
                //$('tbody').html(err["responseText"]);
            }
          });
   }); 
});
</script>
@endsection