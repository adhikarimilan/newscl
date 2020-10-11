@extends('back.admin.layout.index')
@section('content')
<div class="right_col" role="main">
    <div class="">
<div class="row">
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2><strong class="card-title">All classes</strong>
        </h2>
      <a href="{{route('classes.create')}}" class="btn btn-success pull-right btn-sm">Add New class</a>
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
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
              <th>Pic</th>
              <th>Name</th>
              <th>Description</th>
              <th>Shift</th>
              <th>Order</th>
              <th>Class Teacher</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @foreach ($classes as $class)
          <tr>
            <td><img src="{{$class->image ? asset($class->image) 
                : asset('img/class-def.jpg')}}" alt="" style="width:90px;"></td>
              <td>{{$class->name}}</td>
              <td>{{$class->description}}</td>
              <td>@if ($class->shift==='0') Morning
                  @elseif($class->shift==='1') Day
                  @elseif($class->shift==='2') Evening
                  @elseif($class->shift==='3') Night
                  @else  N/A
                  @endif
                </td>
              <td>{{$class->order}}</td>
              <td>{{$class->teacher?$class->teacher->name:'N/A'}}</td>
              <td><a class="btn btn-info" href="{{route('classes.show',['class'=>$class->id])}}"><i class="fa fa-eye"></i></a>
              <a class="btn btn-primary" href="{{route('classes.edit',['class'=>$class->id])}}"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger"  onclick="document.getElementById('{{'delete-form-'.$class->id}}').submit();"><i class="fa fa-trash"></i></a>
                <form action="{{route('classes.destroy',['class'=>$class->id])}}" id="{{'delete-form-'.$class->id}}" method="post">
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