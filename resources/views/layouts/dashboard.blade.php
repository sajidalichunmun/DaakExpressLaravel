<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> @yield('title','kct empty dashboard') </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" media='screen'/>
                <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media='screen' />
                @yield('css')
                <link href="{{ asset('css/components-rounded.min.css')}}" rel="stylesheet" id="style_components" type="text/css"  media='screen'/>
                <link href="{{ asset('css/plugins.min.css')}}" rel="stylesheet" type="text/css" media='screen' />
                <link href="{{ asset('css/layout.min.css')}}" rel="stylesheet" type="text/css" media='screen'/>
                <link href="{{ asset('css/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color" media='screen' /> 
                

       
               
                <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
   
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
            
    <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
                <!-- END PAGE LEVEL PLUGINS -->
                <!-- BEGIN THEME GLOBAL STYLES -->
                <!-- END THEME GLOBAL STYLES -->
                <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
             
       
        
               


       
   
                <link rel="shortcut icon" href="favicon.ico" />
       <style>


   
          .loading {
            background: transparent;
            position: fixed;
            width:100%;
            top:30px;
            text-align: center;
            margin-left:auto;
            margin-right:auto;
            
          
        }
         a.entry{text-decoration: none;} 
        </style>
       
    </head>

    <body class="page-container-bg-solid  page-header-menu-fixed">
        

 <div class="page-header">

        <div class="page-header-top">
            <div class="container-fluid">
   
                <div class="page-logo">
                    <a href="">
                        <img src="{{asset('images/log.png')}}" alt="logo" class="logo-default">
                    </a>
                </div>
       
                <a href="javascript:;" class="menu-toggler"></a>
 
                <div class="top-menu">



                <ul class="nav navbar-nav pull-right">
                                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                                        <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                                        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                <i class="fa fa-bell"></i>
                                                <span class="badge badge-default" id="itemCounter"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="external">
                                                    <h3>You have
                                                        <strong id="itemsMessage"></strong> pending Proforma</h3>
                                                    <a href="{{url('proforma_invoices')}}">view all</a>
                                                </li>
                                            
                                            </ul>
                                        </li>
                                        <!-- END NOTIFICATION DROPDOWN -->
                                        <!-- BEGIN TODO DROPDOWN -->
                                   
                                        <!-- END TODO DROPDOWN -->
                                        <li class="droddown dropdown-separator">
                                            <span class="separator"></span>
                                        </li>
                                        <!-- BEGIN INBOX DROPDOWN -->
                                     
                                        <!-- END INBOX DROPDOWN -->
                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <li class="dropdown dropdown-user">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <img alt="" class="img-circle" src="{{asset('images/avatar.png')}}">
                                        <span class="username username-hide-mobile">{{auth()->user()->name}}</span>
                                        </a>
                                            <ul class="dropdown-menu dropdown-menu-default">
                                                <li>
                                                    <a href="page_user_profile_1.html">
                                                        <i class="icon-user"></i> My Profile </a>
                                                </li>

                                                <li class="divider"> </li>
                                                <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="icon-key"></i>  Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                            
                                               
                                               
                                                
                                             
                                            </ul>
                                        </li>
                                        <!-- END USER LOGIN DROPDOWN -->
                                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                        <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                            <span class="sr-only">Toggle Quick Sidebar</span>
                                            <i class="icon-logout"></i>
                                        </li>
                                        <!-- END QUICK SIDEBAR TOGGLER -->
                                    </ul>


                    <ul class="nav navbar-nav pull-right">
                       
                    

                        <li class="droddown dropdown-separator">
                            <span class="separator"></span>
                        </li>
               
                        <li class="dropdown dropdown-user ">
                           
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                               
                                
                                
                                <li class="divider"> </li>
                              
                             

                                <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="icon-key"></i>  Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                
                            </ul>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
   
        <div class="page-header-menu">
            <div class="container-fluid">
         
             
                
                <?php
              

                 $menus = \App\Models\Menu::with('children')->whereNull('menu_id')->get();

                ?>
                
                <div class="hor-menu  hor-menu-light">




                        <ul class="nav navbar-nav">
                                <?php
                             $menus =  \App\Models\Menu::with('children')->whereNull('menu_id')->get();
                                ?>
         
                                 @foreach($menus->sortBy('sort_order') as $menu)
         
                                 @if(count($menu->children) > 0)
                                         <?php
                                         $found = false;
                                         foreach (auth()->user()->user_menus as $user_menu){
                 
                                             if($user_menu->view_menu==1 && $user_menu->menu_id ==$menu->id){
                                                 $found =true;
                                             }
                                         }?>
         
                                         @if($found)

                                            <li class="menu-dropdown classic-menu-dropdown">
                                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> {{$menu->name}} <b class="caret"></b></a> 
                                             
                                         @else
                                             
                                         @endif
                                         <ul class="dropdown-menu">
                                             @foreach($menu->children->sortBy('sort_order') as $submenu)
                                             
                                            
         
                                     @if(count($submenu->children) > 0)
         
                                     <?php
                                     $found_3 = false;
                                     foreach (auth()->user()->user_menus as $user_menu){
             
                                         if($user_menu->view_menu==1 && $user_menu->menu_id ==$submenu->id){
                                             $found_3 =true;
                                         }
                                     }?>
                                         @if($found_3)
                                         <li class="dropdown">
                                         
                                         <li class="dropdown-submenu">
                                                 <a href=""><i class="fa fa-gear"></i> {{$submenu->name}}</a>
                                         @else
                                         
                                         @endif
                                             
                                                     <ul class="dropdown-menu">
                                                         @foreach($submenu->children->sortBy('order') as $sub_child)
                                                         <?php
                                                         $found_4 = false;
                                                         foreach (auth()->user()->user_menus as $user_menu){
                                 
                                                             if($user_menu->view_menu==1 && $user_menu->menu_id ==$sub_child->id){
                                                                 $found_4 =true;
                                                             }
                                                         }?>
                                                             @if($found_4)
                                                             <li><a href="{{url('/')}}/{{$sub_child->url}}"><i class="fa fa-folder"></i> {{$sub_child->name}}</a></li>
                                                             @else
                                                             
                                                             @endif                                        
                                                         @endforeach
                                                     </ul>
                                                 </li>
                                                 @else
                                                 <?php
                                                 $found_2 = false;
                                                 foreach (auth()->user()->user_menus as $user_menu){
                         
                                                     if($user_menu->view_menu==1 && $user_menu->menu_id ==$submenu->id){
                                                         $found_2 =true;
                                                     }
                                                 }?>
                                       @if($found_2)
                                                     <li class="dropdown">
                                                     <li><a href="{{url('/')}}/{{$submenu->url}}"> <i class="fa fa-gear"></i> {{$submenu->name}}</a></li>
                                                     @else     
                                        @endif
                                                 
                                             @endif
                                     @endforeach
         
                                         </ul>
                                     </li>
                                     @else
         
                                     <?php
                                     $found_1 = false;
                                     foreach (auth()->user()->user_menus as $user_menu){
                     
                                         if($user_menu->view_menu==1 && $user_menu->menu_id ==$menu->id){
                                             $found_1 =true;
                                         }
                                     }?>
                                     @if($found_1)
                                     <li><a href="{{url('/')}}/{{$menu->url}}"><i class="fa fa-file"></i>  {{$menu->name}}</a></li>       
                                     @else
                                         
                                     @endif
         
                                 
                                     @endif
                                     @endforeach
                             </ul>


                  
                </div>
         
            </div>
        </div>
     
    </div>
 



        <div class="page-container">
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="#">l</a>
                                <i class="fa fa-circle"></i>
                            </li>
                           
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                         @yield('content')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                    
                </div>

            </div>

        </div>
        
        <div class="page-footer">
            <div class="container-fluid"> 2018 &copy; 
            </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/layouts/layout3/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.base64.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/icd.js')}}" type="text/javascript"></script>
  
    
    <script src="{{ asset('js/bootstrap3-typeahead.js') }}" ></script>

    

    
   

    <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->


@yield('js')


<script>
    $(function(){
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

        //filers

        
// clear date fields
        $('.clear_date').click(function(event){
           var v = $(this)
                    .closest("div.form-group")
                        .find("input[type=text]").val('');
        });
       $(".alert-success").delay(5000).slideUp(300);
       $(".alert-danger").delay(5000).slideUp(300);  



       function getPendingProformaInvoices(){
           var url ="{{url('/')}}";

           $.get(url + '/getPendingProformaInvoices',function(data){

             $('#itemCounter').text(data);
             $('#itemsMessage').text(data);

             //  console.log($data);

           });
       }



       


// window.setInterval(function(){
//     getPendingProformaInvoices();
// }, 1000);



    });




</script>





    
            </body>

</html>