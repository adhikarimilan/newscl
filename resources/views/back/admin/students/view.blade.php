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
              <h2>Student::{{$student->name}}</h2>
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
                @if($student->avatar)
                <img src="{{asset($student->avatar)}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @else 
              <img src="{{asset('img/default.jpeg')}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @endif
            
            
                <h3 class="text-success">{{$student->name}}</h3>
                <small>{{$student->bio}}</small>
              </div>
            
                <div class="text-dark">
                   
               <h6>Gender: @if($student->gender=='0')
                  Male
              @elseif($student->gender=='1')
                  Female
              @else 
                  Other
              @endif</h6>
              <h6>Class: {{$student->class?$student->class->name:'N/A'}}</h6>
              <h6>Section: {{$student->section?$student->section->name:'N/A'}}</h6>
              <h6>Roll no: {{$student->roll_no}}</h6>
              <h6>DOB(BS): {{$student->dob ?? 'N/A'}}</h6>
              <h6>DOB(AD): {{$student->dob_ad ?? 'N/A'}}</h6>
              <h6>Address(Temporary): {{$student->temp_address}}</h6>
              <h6>Address(Permanent): {{$student->per_address}}</h6>
              <h6>Contact: {{$student->contact}}</h6>
              <h6>Email: {{$student->email}}</h6>
              <h6>Parent : @foreach ($student->student_parent as $key=>$stdpar)
                @if($key )
                      ,
                    
                @endif
                <a href="{{route('parents.show',['parent'=>$stdpar->stdparent->id])}}">{{$stdpar->stdparent->name.'('.$stdpar->relation.')'}}</a>
                
              @endforeach
              </h6>
              </div>
                
            </div>
            </div>
          </div>

          <div class="x_panel">
            <div class="x_title">
              <h2><strong class="card-title">All Book Issues by {{$student->name}}</strong>
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
                      <th>Borrowed Book</th>
                      <th>Issued At</th>
                      <th>Return Till</th>
                      <th>Returned</th>
                  </tr>
              </thead>
              <tbody>
                @if ($student->issuedbooks->count())
                @foreach ($student->issuedbooks as $bookissue)
                <tr>
                  <td style="display: none;">&nbsp;</td>
                    
                    <td><a href="{{route('books.show',['book'=>$bookissue->book->id])}}">{{$bookissue->book ? $bookissue->book->title .'('. $bookissue->book->author .')' : 'no'}}</a></td>
                    <td>{{$bookissue->issued_at}}</td>
                    <td>{{$bookissue->return_bef}}</td>
                    <td>{{$bookissue->returned ? 'yes' : 'no'}}</td>
                    
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="4" style="text-align: center;">No data available </td>
                </tr>
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