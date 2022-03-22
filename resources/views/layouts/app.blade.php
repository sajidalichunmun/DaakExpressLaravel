<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Daak Express Courier & Logistics') }}</title>

  <!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /-->

   <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
   <!--  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
   <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

<!--     <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" />  
 -->


<link href="{{asset('css/bootstrap-datepicker.standalone.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<!--link href="{{ asset('css/styles.css')}}" rel="stylesheet" type="text/css" /-->
 

<script src="{{ asset('/ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
<script src="{{ asset('/ui/1.12.1/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

<script src="{{ asset('DataTables/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<!--link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"-->
<link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
 
<script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Ajax Autocomplete -->
<link rel="stylesheet" type="text/css" href="{{ asset('Autocomplete/UI/1.11.4/themes/smoothness/jquery-ui.css')}}">
<script src="{{ asset('Autocomplete/UI/1.11.4/jquery-ui.js') }}"></script>
<script src="{{ asset('Autocomplete/jquery-1.10.2.js') }}"></script>
<script src="{{ asset('ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script src="{{ asset('ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>

<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script-->

<script src="{{ asset('ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
<script src="{{ asset('ui/1.12.1/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('ajax/libs/jquery/1.7.2/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ajax/libs/jqueryui/1.8.18/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

<script src="{{ asset('ajax/libs/jqueryui/1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>
<!-- Ajax Autocomplete End-->
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
</head>
<body>
    <div id="app" class="container-fluid">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        
						<img src="{{ asset('Images/logo-sm.png') }}" alt="logo" class="img responsive" height="30px;"/>
                    </a>
                </div>
				
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
						@if(Auth::user() === null)
							<li><a href="{{ route('About') }}">About us</a></li>
							<li><a href="{{ route('Contact') }}">Contact us</a></li>
							<li><a href="{{ route('Service') }}">Service's</a></li>
						
						@endif
						@if(Auth::user() !== null)
							@if(Auth::user()->id === 1)
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="test1"><i class="fa fa-th-list"></i>&nbsp;SECURITY<b class="caret"></b></a>		  
								<ul class="dropdown-menu">
									<li class="{{ Request::is('menus') ? 'active' : null }}"><a tabindex="-1" href='{{ route("menus.menu.index") }}'><i class="fa fa-th-list"></i>&nbsp;MENU<b class="caret"></b></a></li>
									<li class="{{ Request::is('users') ? 'active' : null }}"><a tabindex="-1" href='{{ route("users.user.index") }}'><i class="fa fa-th-list"></i>&nbsp;USERS<b class="caret"></b></a></li>
									<li class="{{ Request::is('roles') ? 'active' : null }}"><a tabindex="-1" href='{{ route("roles.role.index") }}'><i class="fa fa-th-list"></i>&nbsp;ROLES<b class="caret"></b></a></li>
								</ul>
							</li>
							@endif
						@endif
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


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                        @yield('content')
                </div>
            </div>
            
        </div>
        <div class="panel  panel-primary">
            <div class="panel-heading clearfix">
            <p>Copyright &copy; 2019-2020 &copy; Daak Express</p>
            <p>All rights reseved Powred by <span>Sajid Ali</span></p>
            </div>
        </div>
    </div>

  
    <script src="{{asset('js/jquery.min.js')}}"></script>
   {{-- <script src="{{asset('js/app.js')}}"></script>  --}}
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    
    
     <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    
    
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>  
    
    
    <script src="{{ asset('js/bootstrap3-typeahead.js') }}" ></script>
        <script src="{{ asset('js/script.js') }}" ></script>

        <script src="{{asset('js/app.min.js')}}" type="text/javascript"></script>

<script src="{{asset('js/jquery.base64.js')}}" type="text/javascript"></script>
<script src="{{asset('js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/components-select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
    

<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    @yield('script')
    
    <script>
      $(function () {

            $('form').on('submit',function(event){

               // $('input[type=submit]').val('PLEASE WAIT..').attr('disabled',true);
               // return true;
            });



        @if(Session::has('success'))
toastr.success("{{Session::get('success')}}",'Congrats!');






    @endif

        $(".alert-success").delay(5000).slideUp(300);
           $(".alert-danger").delay(5000).slideUp(300);  

           
    
        $('.input-group.date').datepicker({
           // calendarWeeks: true,
            autoclose: true,
            todayHighlight: true,
            format: "dd/mm/yyyy",
        });
     
    
    
    
    
        //Initialize Select2 Elements
      //$('select').selectpicker()
     // $('sel').select2()
    
   
      
  
    
        $('.clear_date').click(function(event){
                   var v = $(this)
                            .closest("div.form-group")
                                .find("input[type=text]").val('');
                });

                   // add placeholders to select2 fields
            $('.select2-allow-clear').each(function(index,object){
            var name,
                name1 = $(this).attr('id').split('_')[0],
                name2 = $(this).attr('id').split('_')[1],
                name3 =$(this).attr('id').split('_')[2];
                if(name2 =='id'){
                    name= name1;
                }else if(name2 !=='id'){
                    if(name3 =='id'){
                        name= name1 +' '+ name2;
                    }else{
                        name= name1 +' '+ name2 +' '+name3;
                    }
                }else{
                    
                }
            //name =  (name2 =='id' ||  ( name3 && name3 =='id'))  ?  name1  :  name1+' '+name2 +' '+name3;
                $(this).select2({
                    placeholder:'-- Select '+name+ ' --',
                    allowClear:true
                });
              //  console.log(name2);
            });
    
      
      })
    </script>
    

</body>
</html>
