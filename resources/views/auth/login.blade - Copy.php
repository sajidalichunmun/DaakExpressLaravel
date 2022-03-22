<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SGL') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />




<style>
body{height:100%;

background-color: #889db3 !important;
background-color: #000 !important;
    }body{font-size: 14px;font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:400;overflow-x:hidden;overflow-y:auto}




    .login-form {
        width: 340px;
        margin: 50px auto;
        margin-top: 1%;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }



</style>

</head>
<body>
    <div id="app" >
  

<div class="container">




<div class="login-form">


                     


	<div class="login-logo">
		<a href="#"><b style ="color:#5390A7"><img src="{{ asset('/images/logo-sm2.png') }}" width="340px;" height="93px"/></b></a>
	</div> 

<form  method="POST" action="{{ route('login') }}" class="form-signin">
                        {{ csrf_field() }}
					
 <h2 class="text-center">LOGIN</h2>   <hr>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" >E-Mail Address</label>

					
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder='Enter email address'>
                                @if ($errors->has('email'))
								
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" >Password</label>


                                <input id="password" type="password" class="form-control" name="password" required placeholder='Enter password'>
								
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Log in</button>
							</div>
							<hr>
							<div class="clearfix">
								<label class="pull-left checkbox-inline"> <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}  />Remember me</label>
								<!--a href="{{ route('password.request') }}" class="pull-right">Forgot Password?</a-->
							</div> 
                   
  
                    </form>






 
</div>



</div>
            



                </div>
            
       

  <script src="{{asset('js/app.js')}}"></script>  

    
 




 
    

</body>
</html>












