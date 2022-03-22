@extends('layouts.main')

@section('css')
@endsection

@section('content')

<div class="container">
  <div class="about-section">
    <h1>Our Service's</h1>
    <p>Some text about who we are and what we do.</p>
    <p>Resize the browser window to see that this page is responsive by the way.</p>
  </div>
  <h2 style="text-align:center">Our Service's</h2>
  <div class="row">
    <div class="col-lg-6">
      <div class="panel  panel-primary">
          <div class="panel-heading">
          </div>
          <div class="panel-body panel-body-with-table">
            <img src="{{ asset('Images/logo.png') }}" class="img-responsive">
          </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel  panel-primary">
        <div class="panel-heading clearfix">
        </div>
        <div class="panel-body panel-body-with-table">
          <form action="contact.php">
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="firstname" placeholder="Your name.." class="form-control">
            </div>
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lastname" placeholder="Your last name.."  class="form-control">
            </div>
            <div class="form-group">
              <label for="country">Country</label>
              <select id="country" name="country" class="form-control">
                <option value="australia">Australia</option>
                <option value="canada">Canada</option>
                <option value="usa">USA</option>
              </select>
            </div>
            <div class="form-group">
              <label for="subject">Subject</label>
              <textarea id="subject" name="subject" placeholder="Write something.." rows=2 class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit">
          </form>
        </div>
    </div>
  </div>
</div>
@endsection