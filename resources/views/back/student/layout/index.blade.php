<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('back/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('back/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('back/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ asset('back/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="{{ asset('back/build/css/custom.min.css') }}" rel="stylesheet">
    @yield('extra-css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('student.dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @php
                $curuser=Auth::guard('student')->user();
            @endphp
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{$curuser->avatar ? asset($curuser->avatar) : asset('back/prd/images/img.jpg') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{$curuser->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                    </ul>
                  </li>
                  
                    </ul>
                  </li>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('student.logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
                  <!-- top navigation -->
                  <div class="top_nav">
                    <div class="nav_menu">
                        <div class="nav toggle">
                          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                          <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                              <img src="{{$curuser->avatar ? asset($curuser->avatar) : asset('back/prd/images/img.jpg') }}" alt="">{{$curuser->name}}
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item"  href="{{route('student.profile')}}"> Profile</a>
                                <a class="dropdown-item"  href="javascript:;">
                                  <span class="badge bg-red pull-right">50%</span>
                                  <span>Settings</span>
                                </a>
                            <a class="dropdown-item"  href="javascript:;">Help</a>
                              <a class="dropdown-item"  href="{{route('student.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </div>
                          </li>
          
                          <li role="presentation" class="nav-item dropdown open">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-envelope-o"></i>
                              <span class="badge bg-green">6</span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                              <li class="nav-item">
                                <a class="dropdown-item">
                                  <span class="image"><img src="{{ asset('back/prd/images/img.jpg') }}" alt="Profile Image" /></span>
                                  <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                  </span>
                                  <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                  </span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="dropdown-item">
                                  <span class="image"><img src="{{ asset('back/prd/images/img.jpg') }}" alt="Profile Image" /></span>
                                  <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                  </span>
                                  <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                  </span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="dropdown-item">
                                  <span class="image"><img src="{{ asset('back/prd/images/img.jpg') }}" alt="Profile Image" /></span>
                                  <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                  </span>
                                  <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                  </span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="dropdown-item">
                                  <span class="image"><img src="{{ asset('back/prd/images/img.jpg') }}" alt="Profile Image" /></span>
                                  <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                  </span>
                                  <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                  </span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <div class="text-center">
                                  <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                  </a>
                                </div>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                <!-- /top navigation -->
        @yield('content')

        <!-- footer content -->
        <footer>
          <div class="pull-right d-none">
            Gentelella - Bootstrap Student Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('back/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
   <script src="{{ asset('back/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('back/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('back/vendors/nprogress/nprogress.js') }}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{ asset('back/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('back/build/js/custom.min.js') }}"></script>
    @yield('extra-js')
  </body>
</html>