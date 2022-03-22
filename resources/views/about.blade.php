@extends('layouts.main')

@section('css')
@endsection

@section('content')
<div class="container">
  <div class="about-section">
    <h1>About Us</h1>
    <p>Some text about who we are and what we do.</p>
    <p>Resize the browser window to see that this page is responsive by the way.</p>
  </div>

  <h2 style="text-align:center">About Our Team</h2>
  <div class="row">
    <div class="col-lg-4">
      <div class="panel  panel-primary">
        <div class="panel-heading clearfix">
            <h5>PARMOD GUPTA</h5>
            <p class="title">CEO & Founder</p>
          </div>
          <div class="panel-body panel-body-with-table">
              <img src="{{ asset('images/logo.png') }}" alt="Gupta" class="img-responsive">
              <div class="container">
              
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p>parmod.gupta@sglexpress.co.in</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="panel  panel-primary">
        <div class="panel-heading clearfix">
            <h5>Awadhesh Kumar</h5>
            <p class="title">Art Director</p>
          </div>
          <div class="panel-body panel-body-with-table">
          <img src="{{ asset('Images/logo.png') }}" alt="Awadehes" class="img-responsive">
          <div class="container">
            
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>awa.kumar@sglexpress.co.in</p>
            <p><button class="button">Contact</button></p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="panel  panel-primary">
          <div class="panel-heading clearfix">
              <h5>Sajid Ali</h5>
              <p class="title">Designer</p>
            </div>
            <div class="panel-body panel-body-with-table">
            <img src="{{ asset('Images/logo.png') }}" alt="Sajid" class="img-responsive">
            <div class="container">
              
              <p>Some text that describes me lorem ipsum ipsum lorem.</p>
              <p>sajid.ali@sglexpress.co.in</p>
              <p><button class="button">Contact</button></p>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection