
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
              <h2>Add New Book</h2>
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
              
                <form action="{{route('books.store')}}" method="post" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                            <input type="text" id="title" name="title" placeholder="Book Title" class="form-control" value="{{old('title')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                          <input type="text" id="author" name="author" placeholder="Author name" class="form-control" value="{{old('author')}}" required>
                      </div>
                      </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-check-circle"></i></div>
                            <select name="category_id" id="category" class="form-control" >
                                <option value=''><i class="fa fa-check-circle"></i>Choose Book Category&hellip;</option>
                                @if(isset($categories) && count($categories))
                                @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if (old('category')===$category->id)
                                selected  
                              @endif>{{ $category->post?$category->name.'('.$category->post.')':$category->name}}</option>
                              {{-- {{($category->class())}} --}}
                                @endforeach
                                @endif
    
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></div>
                            <input type="number" id="stock" name="stock" placeholder="Quantity" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-home"></i></div>
                          <input type="text" id="rack_no" name="rack_no" placeholder="Rack name/number" class="form-control" min="0">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Book Cover pic"><i class="fa fa-image"></i></div>
                        <input type="file"  name="pic"  style="padding: 5px;" >
                    </div>
                </div>
                  <div class="form-group">
                    <div class='input-group date' id='myDatepicker2'>
                        <input type='text' class="form-control" placeholder="Purchased date" name='purchased_at' required/>
                        <span class="input-group-addon">
                           <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                    <div class="form-actions form-group"><button type="submit" class="btn btn-success btn">Submit</button></div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet')}}">
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('back/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}} " rel="stylesheet">
@endsection
@section('extra-js')
    <script src="{{asset('back/vendors/moment/min/moment.min.js')}}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('back/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
  <script>
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
    });
  </script>
@endsection