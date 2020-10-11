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
              <h2>Student::{{$book->name}}</h2>
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
                @if($book->pic)
                <img src="{{asset($book->pic)}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @else 
              <img src="{{asset('img/bookdef.jpg')}}" alt="" style="width:200px;border: 5px solid darkgray;" >
              @endif
            
            
                <h3 class="text-success">{{$book->title}}</h3>
              </div>
            
                <div class="text-dark">
                   
               <h6>Author: {{$book->author}}</h6>
              <h6>Rack no: {{$book->rack_no}}</h6>
              <h6>Category: {{$book->category ? $book->category->name : 'N/A'}}</h6>
              <h6>Purchased on: {{$book->purchased_at}}</h6>
              <h6>Stock : {{$book->stock}}</h6>
              <h6>Stock(Available) : {{$book->stock - $book->issued->count() ?? 'N/A'}}</h6>
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