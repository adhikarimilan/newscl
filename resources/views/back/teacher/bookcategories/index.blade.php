@extends('back.teacher.layout.index')
@section('content')
<div class="right_col" role="main">
    <div class="">
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    @include('msg.msg')
  </div>
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2><strong class="card-title">All Book Categories</strong>
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
              
      <p class="text-muted font-13 m-b-30">
      </p>
      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
              <th>Category Name</th>
              <th>Description</th>
              <th>Books Count</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @foreach ($categories as $category)
          <tr>
              <td>{{$category->name}}</td>
              <td>{{$category->description}}</td>
              <td>{{$category->books->count()}}</td>
              
              <td><a class="btn btn-info" href="{{route('teacher.bookcategories.show',['bookcategory'=>$category->id])}}"><i class="fa fa-eye"></i></a>
              <a class="btn btn-primary" href="{{route('teacher.bookcategories.edit',['bookcategory'=>$category->id])}}"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger"  onclick="document.getElementById('{{'delete-form-'.$category->id}}').submit();"><i class="fa fa-trash"></i></a>
                <form action="{{route('teacher.bookcategories.destroy',['bookcategory'=>$category->id])}}" id="{{'delete-form-'.$category->id}}" method="post">
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

<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
  <div class="x_title">
    <h2>Add New Book Category</h2>
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
    
      
    
      <form action="{{route('teacher.bookcategories.store')}}" method="post" class="">
          @csrf
          <div class="form-group">
              <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-home"></i></div>
                  <input type="text" id="name" name="name" placeholder="Category name" class="form-control" value="{{old('name')}}" required>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                  <textarea name="description" id=""  rows="3" class="form-control" required placeholder="short description">{{old('description')}}</textarea>
              </div>
          </div>
          
          <div class="form-actions form-group"><button type="submit" class="btn btn-success btn">Submit</button></div>
      </form>
  </div>
</div>
</div></div>
</div></div>
</div>

@endsection

