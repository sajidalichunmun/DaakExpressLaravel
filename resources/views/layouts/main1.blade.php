<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BILLING | ADE') }}</title>

      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

   <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
   <!--  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
   <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

<!--     <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" />  
 -->


<link href="{{asset('css/bootstrap-datepicker.standalone.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('css/styles.css')}}" rel="stylesheet" type="text/css" />
 

<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"-->
	<!-- Latest compiled and minified JavaScript -->
<!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script-->


<style>
.panel-default > .panel-heading{
  color: inherit; !important;
}
*{
  border-radius: 0 !important;
}
a{
  text-decoration: none !important; 
}


/*.navbar {
    background-color: 
    #3c8dbc;
} */

/*.navbar .nav > li > a {
    color: #fff;
} */


 .navbar .nav>li>a:hover,
 .navbar .nav>li>a:active,
 .navbar .nav>li>a:focus,
 .navbar .nav .open>a,
 .navbar .nav .open>a:hover,
 .navbar .nav .open>a:focus,
 .navbar .nav>.active>a {
  background:rgba(0,0,0,0.1);
 color:#f6f6f6 
}



.dropdown:hover {
  display: block;
} 

.dropdown-submenu {
  position: relative;
}

.dropdown-submenu>.dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -6px;
  margin-left: -1px;
  -webkit-border-radius: 0 6px 6px 6px;
  -moz-border-radius: 0 6px 6px 6px;
  border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
  display: block;
 

}

.dropdown-submenu>a:after {
  display: block;


  content: " ";
  float: right;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
  border-width: 5px 0 5px 5px;
  border-left-color: #cccccc;
  margin-top: 5px;
  margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
  border-left-color: #ffffff;

}

.dropdown-submenu.pull-left {
  float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
  left: -100%;
  margin-left: 10px;
  -webkit-border-radius: 6px 0 6px 6px;
  -moz-border-radius: 6px 0 6px 6px;
  border-radius: 6px 0 6px 6px;
}
/*
.dropdown-menu > li > a {

    color: #000;

}*/



 .container-fluid {
    max-width: 1200px;
    margin: 0 auto;
    min-height: 100%;
    /* box-shadow: 0 0 8px 
    rgba(0,0,0,0.5); */
    position: relative;
}

li.dropdown:hover > .dropdown-menu {
    display: block;
}

.nav .dropdown-menu{box-shadow:5px 5px rgba(102,102,102,.1);
    padding:0;
    border:1px solid #eee; 
    
}


</style>

@yield('css')

@yield('script')    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BILLING ADE') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                            <!-- Begin Navbar -->
                            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#"><img src="../../Images/kctempty.png" alt="logo" class="img-responsive"></a>
                                </div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">			  
                                        <!--li class="active"><a href='mainpage.php'><i class="fa fa-fw fa-home"></i>HOME</a></li-->
										@if(Auth::user()->id==141)
										<li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="test1"><i class="fa fa-th-list"></i>&nbsp;SECURITY<b class="caret"></b></a>		  
                                            <ul class="dropdown-menu">
                                                <li class="{{ Request::is('menus') ? 'active' : null }}"><a tabindex="-1" href='{{ route("menus.menu.index") }}'><i class="fa fa-th-list"></i>&nbsp;MENU<b class="caret"></b></a></li>
                                                <li class="{{ Request::is('users') ? 'active' : null }}"><a tabindex="-1" href='{{ route("users.user.index") }}'><i class="fa fa-th-list"></i>&nbsp;USERS<b class="caret"></b></a></li>
                                            </ul>
                                        </li>
										@endif
                                        <ul class="nav navbar-nav">
										   @foreach($menus->sortBy('sort_order') as $menu)
												@if(count($menu->children) > 0)
														<li class="dropdown">
															@if(in_array($menu->id,$userMenus))
																<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="{{$menu->icon}}"></i> {{$menu->name}} <i class="caret"></i>  </a> 
															@endif
															<ul class="dropdown-menu">
																@foreach($menu->children->sortBy('sort_order') as $submenu)
																	@if(in_array($submenu->id,$userMenus))
																		@if(count($submenu->children) > 0)
																			<li class="dropdown-submenu">
																				<a href=""><i class="{{$submenu->icon}}"></i>  {{$submenu->name}}</a>
																				<ul class="dropdown-menu">
																				@foreach($submenu->children->sortBy('sort_order') as $sub_child)
																					@if(in_array($sub_child->id,$userMenus)) 
																						<li><a href="{{url('/')}}/{{$sub_child->url}}"><i class="{{$sub_child->icon}}"></i> {{$sub_child->name}}</a></li>                      
																					@endif 
																				@endforeach
																				</ul>
																			</li>
																		@else
																			<li><a href="{{url('/')}}/{{$submenu->url}}"><i class="{{$submenu->icon}}"></i> {{$submenu->name}}</a></li>
																		@endif
																	@endif 
																@endforeach
															</ul>
														</li>
												@else
													@if(in_array($menu->id,$userMenus)) 
														<li><a href="{{url('/')}}/{{$menu->url}}"><i class="{{$menu->icon}}"></i>  {{$menu->name}}</a></li>       
													@endif 
												@endif
											@endforeach

										</ul>
                                    </ul>
                                    <!--ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                                        <li><a href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                        <li><a href="mainpage.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                    </ul-->
                                    <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                                    @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                                </ul>
                                    <!--ul class="nav navbar-nav navbar-right" style="margin-right: 50px;margin-top: 15px;color: #007fff;">
                                        <li>Welcome to <span>KCT EMPTY</span> {{ Auth::user()->name }} </li>
                                    </ul-->
                                </div>
                            </nav>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
    
    <div class="footer">
    @section('footer')

    @show
    </div>
</body>
</html>
