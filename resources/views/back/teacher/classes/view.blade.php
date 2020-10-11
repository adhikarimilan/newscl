@extends('back.teacher.layout.index')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
     
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Class::{{$class->name}}</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                      class="fa fa-wrench"></i></a>
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
                @include('msg.msg')
                <div class="std-card" >
                  <div class="pt-2">
                    <img src="{{$class->image ? asset($class->image) 
                      : asset('img/class-def.jpg')}}" alt="" style="width:200px;border: 5px solid darkgray;">
              
                <h3 class="text-success">{{$class->name}}</h3>
                <small>{{$class->description}}</small>
              </div>
            
                <div class="text-dark">
                   
               <h6>Shift: @if ($class->shift==='0') Morning
                @elseif($class->shift==='1') Day
                @elseif($class->shift==='2') Evening
                @elseif($class->shift==='3') Night
                @else  N/A
                @endif</h6>
              <h6>Class Teacher: {{$class->teacher?$class->teacher->name:'N/A'}}</h6>
              <h6>Total Students: {{$class->students->count()}}</h6>
              <h6>Total Sections: {{$class->sections->count()}}</h6>
              <h6>Section: 
                @foreach ($class->sections as $key=>$stdpar)
                @if($key )
                      ,
                    
                @endif
                {{$stdpar->name}}</a>
                @endforeach
              </h6>
              </div>
                
            </div>
            </div>
          </div>
          <div class="x_panel">
            <div class="x_title">
              <h2><strong class="card-title">All Students of {{$class->name}}</strong>
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
              <p class="text-muted font-13 m-b-30">
              </p>
              <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                      <th>Photo&nbsp;</th>
                      <th>Name</th>
                      <th>Roll no</th>
                     <th>Gender</th> 
                      <th>Email</th>
                      <th>Class</th>
                      <th>Section</th>
                      <th>Active</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
              @foreach ($class->students as $student)
                  <tr>
                      <td>@if($student->avatar)
                        <img src="{{asset($student->avatar)}}" alt="" style="width:90px;">
                      @else 
                      <img src="{{asset('img/default.jpeg')}}" alt="" style="width:90px;">
                      @endif</td>
                      <td>{{$student->name }}</td>
                      <td>{{$student->roll_no }}</td>
                      <td>@if($student->gender=='0')
                          Male
                      @elseif($student->gender=='1')
                          Female
                      @else 
                          Other
                      @endif
                      </td> 
                      <td>{{$student->email}}</td>
                      <td>{{$student->class?$student->class->name:'N/A'}}</td>
                      <td>{{$student->section?$student->section->name:'N/A'}}</td>
                      <td>{{$student->active?'Active':'Inactive'}}</td>
                      <td><a class="btn btn-info" href="{{route('teacher.students.show',['student'=>$student->id])}}"><i class="fa fa-eye"></i></a>
                      <a class="btn btn-primary" href="{{route('teacher.students.edit',['student'=>$student->id])}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger" onclick="document.getElementById('{{'delete-form-'.$student->id}}').submit();"><i class="fa fa-trash"></i></a>
                        <form action="{{route('teacher.students.destroy',['student'=>$student->id])}}" id="{{'delete-form-'.$student->id}}" method="post">
                        @csrf {{method_field('delete')}}
                        </form>
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
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection

@section('extra-css')

<style>
  .std-card{
    display:flex;
    align-items:center;
    justify-content:space-between;
  }
  .std-card > div{
    flex:50%;
  }
  @media screen and (max-width: 576px){
  .std-card {
    display: block;
    text-align: center;
  }

  }
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