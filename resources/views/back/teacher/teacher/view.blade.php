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
              <h2>Teacher::{{$teacher->name}}</h2>
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
                @if($teacher->avatar)
                <img src="{{asset($teacher->avatar)}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @else 
              <img src="{{asset('img/default.jpeg')}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @endif
            
            
                <h3 class="text-success">{{$teacher->name}}</h3>
                <small>{{$teacher->bio}}</small>
              </div>
            
                <div class="text-dark">
                   
               <h6>Gender: @if($teacher->gender=='0')
                  Male
              @elseif($teacher->gender=='1')
                  Female
              @else 
                  Other
              @endif</h6>
              <h6>Class Teacher of: {{$teacher->class?$teacher->class->name:'N/A'}}</h6>
              <h6>Address(Temporary): {{$teacher->temp_address}}</h6>
              <h6>Address(Permanent): {{$teacher->per_address}}</h6>
              <h6>Contact: {{$teacher->contact}}</h6>
              <h6>Email: {{$teacher->email}}</h6>
              <h6>Post: {{$teacher->dob ?? 'N/A'}}</h6>
              <h6>Faculty: {{$teacher->faculty ?? 'N/A'}}</h6>
              <h6>Education: {{$teacher->education ?? 'N/A'}}</h6>
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