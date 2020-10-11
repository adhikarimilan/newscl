@extends('back.parent.layout.index')
@section('content')
  <!-- page content -->
  @php
                $curuser=Auth::guard('stdparent')->user();
  @endphp
        <div class="right_col" role="main">
          <div class="">
            <div class="row" style="display: inline-block;">
            <div class="top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">{{$curuser->student_parent->count()}}</div>
                  <h3>Students</h3>
                  <p>these are total active students in your school.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">2</div>
                  <h3>Teachers</h3>
                  <p>these are total active teachers in your school.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count">2</div>
                  <h3>Parents</h3>
                  <p>these are total active parents in your school.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-table"></i></div>
                  <div class="count">2</div>
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
                    <h2>Your Children Summary</h2>
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
                        <table id="datatable" class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Class</th>
                              <th>Section</th>
                              <th>Assignments</th>
                              <th>Attendance</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($curuser->student_parent as $std)
                            <tr>
                              <td><img src="{{$std->student->avatar ? asset($std->student->avatar) : asset('img/default.jpeg') }}" style="width: 90px;"></td>
                              <td> <a href="{{route('parent.student.view',['id'=>$std->student->id])}}">{{$std->student->name}}</a></td>
                              <td>{{$std->student->class ? $std->student->class->name : 'N/A'}}</td>
                              <td>{{$std->student->section ? $std->student->section->name : 'N/A'}}</td>
                              <td><a href="{{route('parent.stdassignments.view',['id'=>$std->student->id])}}"> {{$std->student->class ? $std->student->class->assignments->count() : 'N/A'}} </a> </td>
                              <td><a href="{{route('parent.stdattendance.view')}}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
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
     
        })()
      </script>
    
@endsection
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection

