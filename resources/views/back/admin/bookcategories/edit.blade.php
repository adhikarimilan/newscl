
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
              <h2>Edit Category::{{$category->name}}</h2>
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
                <form action="{{route('bookcategories.update',['bookcategory'=>$category->id])}}" method="post" class="">
                    @csrf
                    {{method_field('put')}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-home"></i></div>
                            <input type="text" id="name" name="name" placeholder="Classname" class="form-control" value="{{$category->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea name="description" id=""  rows="3" class="form-control" required placeholder="short description">{{$category->description}}</textarea>
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

@section('extra-js')
    
  <script >

    (function(){
    //     if(sec>'0'){
	// 	$("#minusatt").removeAttr('disabled');
	// }
    })()
    
    $('#plussec').click(function(){
        sec++;
        let id='secadded-'+sec;
        let section=$('#sec-section');
        let secadded=$('<div class="form-row section" id="'+id+'"> <div class="form-group col-lg-10"><input type="text"  class="form-control" placeholder="section name" name="sname[]" required="required" value=""><input type="hidden" name="sid[]" value=""></div><div class="form-group col-lg-2"> <button id="minussec" class="btns btn btn-warning" type="button"  title="delete section" data-id="" onclick="remsecadded('+sec+');">&minus;</button></div></div>');
        section.append(secadded);
    });

    function remsec(h){
        let id='#sec-'+h;
        $(id).remove();
    }
    function remsecadded(h){
        let id='#secadded-'+h;
        $(id).remove();
    }
    </script>
@endsection