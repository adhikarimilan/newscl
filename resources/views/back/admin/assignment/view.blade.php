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
              <h2>Assignment::{{$assignment->name}}</h2>
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
                 <div class="text-dark">
               <h6>Class: {{$assignment->class?$assignment->class->name:'N/A'}}</h6>
              @if($assignment->section)
              <h6>Section: {{$assignment->section->name}}</h6>
              @endif
              <h6>Assigned By: {{$assignment->teacher?$assignment->teacher->name:'N/A'}} </h6>
              <h6>Created at: @php
                $cdate=date_create($assignment->created_at);
                echo date_format($cdate,"Y-m-d H:i");
            @endphp</h6>
              <h6 @if (date('Y-m-d') > $assignment->submitted_till) class='text-danger'
                @endif>Submitted till: {{$assignment->submitted_till}}</h6>
              <h6>Description</h6>
              <div class="p-2"  style="border: 1px solid #222;background:#eee;" >{{$assignment->description}}</div>
              
               @if ($assignment->file)
               <br>
               <h6><a href="{{asset($assignment->file)}}">view file</a></h6> 
               @endif 
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
      flex-wrap: wrap;
      align-items:center;
      justify-content:space-between;
    }
    .std-card > div{
      flex:50%;
      padding: 1px;
    }
    @media screen and (max-width: 576px){
     .std-card {
      display: block;
      text-align: center; 
    }
  
    }
</style>
@endsection