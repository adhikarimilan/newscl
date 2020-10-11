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
              <h2>User::{{$user->name}}</h2>
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
                @if($user->avatar)
                <img src="{{asset($user->avatar)}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @else 
              <img src="{{asset('img/default.jpeg')}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @endif
            
            
                <h3 class="text-success">{{$user->name}}</h3>
                <small>{{$user->bio}}</small>
              </div>
            
                <div class="text-dark">
               
              <h6>Gender: @if($user->gender=='0')
                Male
            @elseif($user->gender=='1')
                Female
            @else 
                Other
            @endif</h6>
            <h6>Class Teacher of: {{$user->class?$user->class->name:'N/A'}}</h6>
            <h6>DOB(BS): {{$user->dob_bs ?? 'N/A'}}</h6>
            <h6>DOB(AD): {{$user->dob_ad ?? 'N/A'}}</h6>
            <h6>Address(Temporary): {{$user->temp_address}}</h6>
            <h6>Address(Permanent): {{$user->per_address}}</h6>
            <h6>Contact: {{$user->contact}}</h6>
            <h6>Email: {{$user->email}}</h6>
            <h6>Post: {{$user->dob ?? 'N/A'}}</h6>
            <h6>Faculty: {{$user->faculty ?? 'N/A'}}</h6>
            <h6>Education: {{$user->education ?? 'N/A'}}</h6>
              <a href="{{route('teacher.profile.edit',['id'=>$user->id])}}" class="btn btn-success">Edit Profile</a>
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