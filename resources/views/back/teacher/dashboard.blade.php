@extends('back.teacher.layout.index')
@section('content')
  <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row" style="display: inline-block;">
            <div class="top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">{{$students}}</div>
                  <h3>Students</h3>
                  <p>these are total active students in your school.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">{{$teachers}}</div>
                  <h3>Teachers</h3>
                  <p>these are total active teachers in your school.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count">{{$parents}}</div>
                  <h3>Parents</h3>
                  <p>these are total active parents in your school.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-table"></i></div>
                  <div class="count">{{$stdclasses}}</div>
                  <h3>Classes</h3>
                  <p>these are total active classes in your school.</p>
                </div>
              </div>
            </div>
          </div>

             <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Student Summary <small>Activity shares</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-12" style="overflow:hidden;">
                        <div id="class_bar">

                        </div>
                        
                        <h4 style="margin:18px">Students per each class</h4>
                      </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            
          </div>
        </div>
        <!-- /page content -->
@endsection

@section('extra-js')
    <!-- Chart.js -->
    <script src="{{asset('back/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{asset('back/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('back/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('back/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('back/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('back/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('back/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('back/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('back/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('back/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('back/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('back/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('back/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    
    <!-- morris.js -->

    <script src="{{asset('back/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('back/vendors/morris.js/morris.min.js')}}"></script>
   
    
      <script>
        var classes={};
      classes='{{$classe}}';
      classes=JSON.parse(classes.replace(/&quot;/g,'"'));
        (function(){ 
         classes=JSON.stringify(classes);
          //console.log(classes);
          $("#class_bar").length &&
      Morris.Bar({
        element: "class_bar",
        data: JSON.parse(classes),
        xkey: "class",
        ykeys: ["total"],
        labels: ["Total Student"],
        barRatio: 0.4,
        barColors: ["#26B99A", "#34495E", "#ACADAC", "#3498DB"],
        xLabelAngle: 35,
        hideHover: "auto",
        resize: !0,
      })
        })()
      </script>
    
@endsection
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

