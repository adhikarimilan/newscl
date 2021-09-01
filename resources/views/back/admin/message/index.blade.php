@extends('back.admin.layout.index')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
   
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>All Messages</h2>
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
            
              <div class="table-responsive">
                <table class="table table-bordered" id="staffs" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display:none;">date</th>
                      <th>Sender Name</th>
                      <th>Email</th>   
                      <th>Subject</th>                           
                      <th>Message</th>
                      <th>Viewed</th>
                      <th>Action</th>
                    </tr>
                  </thead>        
                  <tbody>
                  @if($messages->count()>0)
                  @foreach($messages as $message)
                  <tr>
                    <td style="display:none;">&nbsp;</td>
                    <td>{{$message->name}}</td>
                    <td>{{$message->email}}</td> 
                    <td>{{$message->subject}}</td>               	
                    <td>{{strlen($message->message)<41?$message->message:substr($message->message,0,39)."..."}}</td>
                  <td>{{$message->seen?"true":"false"}}</td>
                    <td>
                     
                      <a href="{{route('admin.message.view',['id'=>$message->id])}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                      <a class="btn btn-danger"  onclick="document.getElementById('{{'delete-form-'.$message->id}}').submit();"><i class="fa fa-trash"></i></a>
                    <form action="{{route('admin.message.delete',['id'=>$message->id])}}" id="{{'delete-form-'.$message->id}}" method="post">
                @csrf {{method_field('delete')}}
                </form> 
  
                    </td>
                  </tr>
                  @endforeach
                  @endif                  
                  </tbody>
                </table>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection

@section('extra-js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#staffs').DataTable();
  });
</script>
@endsection
