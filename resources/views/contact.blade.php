@extends('layouts.main')

@section('css')
@endsection

@section('content')

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="fa fa-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

<div class="container">
  <div class="about-section">
    <h1>Contact Us</h1>
    <p>Some text about who we are and what we do.</p>
    <p>Resize the browser window to see that this page is responsive by the way.</p>
  </div>
  <h2 style="text-align:center">Contact Us</h2>
  <div class="row">
    <div class="col-lg-6">
        <img src="{{ asset('Images/logo.png') }}" class="img-responsive">
    </div>
    <div class="col-lg-6">
      <div class="panel  panel-primary">
        <div class="panel-heading clearfix">
          <h5>Contact Us</h5>
        </div>
        <div class="panel-body panel-body-with-table">
            <form action="{{ route('save-contact') }}" method='post'>
              @csrf
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Your name.." class="form-control" require>
              </div>
              @if ($errors->has('firstname'))
								
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
            @endif
              <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Your last name.." class="form-control">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="email address" class="form-control" require>
              </div>
              @if ($errors->has('email'))
								
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
              <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country" class="form-control">
                <option value="australia">Australia</option>
                  <option value="canada">Canada</option>
                  <option value="usa">USA</option>
                </select>
              </div>
              @if ($errors->has('country'))
								
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif
              <div class="form-group">
                <label for="subject">Subject</label>
                <textarea id="subject" name="subject" value="{{ old('subject') }}" placeholder="Write something.." rows=2 class="form-control"></textarea>
              </div>
              @if ($errors->has('subject'))
								
                <span class="help-block">
                    <strong>{{ $errors->first('subject') }}</strong>
                </span>
            @endif
              <input type="submit" value="Submit">
            </form>
          
        </div>
    </div>
  </div>
</div>
@endsection