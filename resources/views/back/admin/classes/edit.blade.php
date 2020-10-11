
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
              <h2>Edit Class::{{$class->name}}</h2>
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
                <form action="{{route('classes.update',['class'=>$class->id])}}" method="post" class="" enctype="multipart/form-data">
                    @csrf
                    {{method_field('put')}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-home"></i></div>
                            <input type="text" id="name" name="name" placeholder="Classname" class="form-control" value="{{$class->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea name="description" id=""  rows="3" class="form-control" required placeholder="short description">{{$class->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-check-circle"></i></div>
                            <select name="shift" id="shift" class="form-control" required>
                                <option value="">Choose Shift</option>
                                <option value="0" @if ($class->shift==='0')
                                  selected  
                                @endif>Morning</option>
                                <option value="1" @if ($class->shift==='1')
                                selected  
                              @endif>Day</option>
                              <option value="2" @if ($class->shift==='2')
                                selected  
                              @endif>Evening</option>
                              <option value="3" @if ($class->shift==='3')
                                selected  
                              @endif>Night</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-check-circle"></i></div>
                            <select name="teacher" id="teacher" class="form-control" >
                                <option value="">Choose Classteacher&hellip;</option>
                                @if(isset($teachers) && count($teachers))
                                @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}" @if ($class->class_teacher_id===$teacher->id)
                                selected  
                              @endif>{{ $teacher->post?$teacher->name.'('.$teacher->post.')':$teacher->name}}</option>
                              {{-- {{($teacher->class())}} --}}
                                @endforeach
                                @endif
    
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace Avatar"><i class="fa fa-user"></i></div>
                          <input type="file"  name="pic"  style="padding: 5px;" >
                          <input type="checkbox" name="rempic" id="rempic" class="d-none" value="1">
                      </div>
                      @if ($class->image)
                      <div class="input-group pic-preview">
                        <img src="{{asset($class->image)}}" alt="{{$class->name}}" style="width:90px;">   
                        <button type="button" class="btn btn-danger m-1" style="height:40px;" onclick="remprev()">&times;</button>
                      </div>
                    @endif
                  </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></div>
                            <input type="number" id="order" name="order" placeholder="Order" class="form-control" min="0" value="{{$class->order}}">
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Active Status"><i class="fa fa-check-circle"></i></div>
                          <select name="active" id="status" class="form-control" required>
                              <option value="1" @if ($class->active=='1')
                                selected  
                              @endif>Active</option>
                              <option value="0" @if ($class->active=='0')
                              selected  
                            @endif>Inactive</option>
                          </select>
                      </div>
                  </div>
                    <script>
                        var sec=0;
                    </script>
                    @if($class->sections)
                    @php
                     $i=0;	
                    @endphp
                    <div id="sec-section">
                    <h4 class="my-2 pl-2">Section</h4> 
                    @foreach($class->sections as $sec)
                    <div class="form-row section" id="{{'sec-'.$sec->id}}"> 
                    <div class="form-group col-lg-10">      
                    <input type="text"  class="form-control" placeholder="section name" name="sname[]" required="required" value="{{$sec->name}}">
                    <input type="hidden" name="sid[]" value="{{$sec->id}}">
                    </div>
                    <div class="form-group col-lg-2">  
                        <button id="minussec" class="btns btn btn-warning" type="button"  title="delete section" data-id="{{$sec->id}}" onclick="remsec({{$sec->id}});">&minus;</button>
                    </div>
                    </div>
                    @php
                    $i++;
                @endphp
                @endforeach
                @php
                echo "<script> sec=$i;</script>";	
                @endphp
                
                </div>
                    <div class="form-row section mb-2 pl-2">  
                        <button id="plussec" class="btns btn btn-primary" type="button" title="add section">&plus;</button>
                    </div>
                
                @endif
    
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

function remprev(){
  $('.pic-preview').remove();
  $('#rempic').prop('checked','true');
}
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