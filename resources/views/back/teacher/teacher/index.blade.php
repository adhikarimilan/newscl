@extends('back.teacher.layout.index')
@section('content')
<div class="right_col" role="main">
    <div class="">
<div class="row">
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2><strong class="card-title">All Teachers</strong>
        </h2>
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
        <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
              @include('msg.msg')
      <p class="text-muted font-13 m-b-30">
      </p>
      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
              <th>Photo&nbsp;</th>
              <th>Name</th>
              <th>Class</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Faculty</th>
              <th>Post</th>
              <th>Active</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @foreach ($teachers as $teacher)
          <tr>
              <td>@if($teacher->avatar)
                <img src="{{asset($teacher->avatar)}}" alt="" style="width:90px;">
              @else 
              <img src="{{asset('img/default.jpeg')}}" alt="" style="width:90px;">
              @endif</td>
              <td>{{$teacher->name }}</td>
              <td>{{$teacher->class ? $teacher->class->name :'N/A'}}</td>
              {{-- <td>@if($teacher->gender==='0')
                  Male
              @elseif($teacher->gender==='1')
                  Female
              @else 
                  Both
              @endif
              </td> --}}
              <td>{{$teacher->email}}</td>
              <td>{{$teacher->contact}}</td>
              <td>{{$teacher->education}}</td>
              <td>{{$teacher->post}}</td>
              <td>{{$teacher->active?'Active':'Inactive'}}</td>
              <td><a class="btn btn-info" href="{{route('teacher.teachers.show',['teacher'=>$teacher->id])}}"><i class="fa fa-eye"></i></a>
              </td>
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
</div></div>
</div>

@endsection
@section('extra-css')
<style>

</style>
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<!-- Datatables -->
    
<link href="{{asset('back/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('back/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('back/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('back/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('back/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

@endsection
@section('extra-js')
    
 <!-- iCheck -->
 <script src="{{asset('back/vendors/iCheck/icheck.min.js')}}"></script>
 <!-- Datatables -->
 <script src="{{asset('back/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
 <script src="{{asset('back/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
 <script src="{{asset('back/vendors/jszip/dist/jszip.min.js')}}"></script>
 <script src="{{asset('back/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
 <script src="{{asset('back/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

@endsection