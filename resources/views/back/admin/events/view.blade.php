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
              <h2>Event::{{$event->name}}</h2>
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
                @if($event->pic)
                <img src="{{asset($event->pic)}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @else 
              <img src="{{asset('img/default.jpeg')}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @endif
            
            
                <h3 class="text-success">{{$event->name}}</h3>
              </div>
            
                <div class="text-dark">
                   
              @if($event->file)
              <h6>File: <a href="{{asset($event->file)}}">View</a></h6>
              @endif
              <h6>Description: </h6>
              <p style="border: 1px solid darkgray;padding:3px;">{{$event->description}}</p>
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
@endsection