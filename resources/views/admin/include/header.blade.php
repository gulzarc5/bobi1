<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Edujiyaan</title>
    <link rel="icon" href="{{ asset('logo/logo.png')}}" type="image/icon type">


    <!-- Bootstrap -->
    <link href="{{asset('admin/src_files/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/src_files/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/src_files/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('admin/src_files/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{asset('admin/src_files/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('admin/src_files/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('admin/src_files/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    {{-- Datatables --}}
     <link href="{{asset('admin/src_files/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    {{-- pnotify --}}
    
   {{--  <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{asset('admin/src_files/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('admin.deshboard')}}" class="site_title">
                <img src="{{ asset('logo/logo.png')}}" height="50" style=" width: 50%;">
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            {{--   <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> --}}
              <div class="profile_info">
                <span>Welcome,<b>Admin</b></span>
                
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ route('admin.deshboard')}}"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Users <span class="fa fa-chevron-down"></span></a>
                     <ul class="nav child_menu">
                      <li class="sub_menu"><a href="{{ route('admin.allSellers') }}">Seller List</a>
                      </li>
                      <li class="sub_menu"><a href="{{ route('admin.allBuyers') }}">Buyers List</a>
                      </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>Books<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.add_new_book')}}">Add New Books</a></li>
                      <li><a href="{{ route('admin.book_list')}}">List Of Books</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Projects <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.add_new_project')}}">Add New Project</a></li>
                      <li><a href="{{route('admin.project_list')}}">Project List</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i>Megazine<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.add_new_megazine')}}">Add New Megazine</a></li>
                      <li><a href="{{route('admin.megazine_list')}}">List Of Megazine</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i>Quiz<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.add_new_quiz_form')}}">Add New Quiz</a></li>
                      <li><a href="{{route('admin.quiz_list')}}">List Of Quiz</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i>Orders<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.book_order_list')}}">Book Orders</a></li>
                      <li><a href="{{route('admin.project_order_list')}}">Project Orders</a></li>
                      <li><a href="{{route('admin.megazine_order_list')}}">Megazine Orders</a></li>
                      <li><a href="{{route('admin.membership_order_list')}}">Membership Orders</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart-o"></i> Configuration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a><i class="fa fa-bar-chart-o"></i>State <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.view_state_form')}}">Add New State</a></li>
                        </ul>
                      </li>

                      <li><a><i class="fa fa-bar-chart-o"></i>City <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('admin.view_city_form')}}">Add New City</a></li>
                          <li><a href="{{route('admin.city_list')}}">City List</a></li>
                        </ul>
                      </li>

                    </ul>
                  </li>

                  <li><a href="{{route('admin.change_password')}}"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a></li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
             <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

                {{-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">
                      @if (isset($admin_data['total_count']))
                          {{ $admin_data['total_count'] }}
                      @else
                          0
                      @endif
                    </span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    @if (isset($admin_data['new_order_count']) && $admin_data['new_order_count'] > 0 )
                      <li>
                      <a href="{{ route('admin.all_order_list') }}">
                          <span>
                            <span>Order</span>
                          </span>
                          <span class="message">
                            <strong>{{ $admin_data['new_order_count']}}</strong> New Order Placed Click Here To Check
                          </span>
                        </a>
                      </li>
                    @endif
                    @if (isset($admin_data['seller_view_count']) && $admin_data['seller_view_count'] > 0 )
                      <li>
                        <a href="{{ route('admin.allSellers') }}">
                          <span>
                            <span>Seller</span>
                          </span>
                          <span class="message">
                            <strong>{{ $admin_data['seller_view_count']}}</strong> New Seller Registered Click Here To Check
                          </span>
                        </a>
                      </li>
                    @endif
                    @if (isset($admin_data['buyer_view_count']) && $admin_data['buyer_view_count'] > 0 )
                      <li>
                        <a href="{{ route('admin.allBuyers') }}">
                          <span>
                            <span>Buyer</span>
                          </span>
                          <span class="message">
                            <strong>{{ $admin_data['buyer_view_count']}}</strong> New Buyer Registered Click Here To Check
                          </span>
                        </a>
                      </li>
                    @endif
                  </ul>
                </li> --}}
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->