@extends('back.student.layout.index')
@section('content')
  <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row" style="display: inline-block;">
            <div class="top_tiles">
              <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-edit"></i></div>
                  <div class="count">{{$assignments}}</div>
                  <h3><a href="{{route('student.assignments')}}">Assignments</a></h3>
                  <p>these are total active assignments for your class.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-book"></i></div>
                  <div class="count">{{$issuedbooks}}</div>
                  <h3><a href="{{route('student.bookissues')}}">Duebooks</a></h3>
                  <p>these are total active due books of your in library.</p>
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
   
    
      
    
@endsection
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

