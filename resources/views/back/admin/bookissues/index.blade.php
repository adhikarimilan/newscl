@extends('back.admin.layout.index')
@section('content')
<div class="right_col" role="main">
    <div class="">
<div class="row">
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2><strong class="card-title">All Book Issues</strong>
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
      <table id="datatable-keytable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
              <th style="display: none;">&nbsp;</th>
              <th>Name</th>
              <th>Isstaff</th>
              <th>Borrowed Book</th>
              <th>Issued At</th>
              <th>Return Till</th>
              <th>Returned</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @foreach ($bookissues as $bookissue)
          <tr>
            <td style="display: none;">&nbsp;</td>
              <td>@if ($bookissue->isteacher)
                <a href="{{route('teachers.show',['teacher'=>$bookissue->teacher->id])}}">{{$bookissue->teacher->name}}</a>
              @else
              <a href="{{route('students.show',['student'=>$bookissue->student->id])}}">{{$bookissue->student->name}}</a>   
              @endif</td>
              <td>{{$bookissue->isteacher? 'yes' : 'no'}}</td>
              <td><a href="{{route('books.show',['book'=>$bookissue->book->id])}}">{{$bookissue->book ? $bookissue->book->title .'('. $bookissue->book->author .')' : 'no'}}</a></td>
              <td>{{$bookissue->issued_at}}</td>
              <td @if (date('Y-m-d') > $bookissue->return_bef) class='text-danger'
                @endif>{{$bookissue->return_bef}}</td>
              <td>{{$bookissue->returned ? 'yes' : 'no'}}</td>
              <td><a class="btn btn-info" href="{{route('bookissues.show',['bookissue'=>$bookissue->id])}}"><i class="fa fa-eye"></i></a>
              
                <a class="btn btn-success"  onclick="document.getElementById('{{'delete-form-'.$bookissue->id}}').submit();" data-toggle="tooltip" data-placement="right"  data-original-title="Mark as Returned"><i class="fa fa-check-square"></i></a>
                <form action="{{route('bookissues.destroy',['bookissue'=>$bookissue->id])}}" id="{{'delete-form-'.$bookissue->id}}" method="post">
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
