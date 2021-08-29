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
              <h2>Edit Event::{{$event->name}}</h2>
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
                <form action="{{route('events.update',['event'=>$event->id])}}" method="post" class="" id='std-form' enctype="multipart/form-data">
                    @csrf
                    {{method_field('put')}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Event name"><i class="fa fa-user"></i></div>
                            <input type="text" id="name" name="name" placeholder="Eventname" class="form-control" value="{{$event->name}}" required title="Event Name">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="input-group">
                          <textarea name="description" id=""  rows="3" class="form-control" required placeholder="description">{{$event->description}}</textarea>
                      </div>
                  </div>
                  
                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace Pic"><i class="fa fa-user"></i></div>
                          <input type="file"  name="pic"  style="padding: 5px;" >
                          <input type="checkbox" name="rempic" id="rempic" class="d-none" value="1">
                      </div>
                      @if ($event->pic)
                      <div class="input-group pic-preview">
                        <img src="{{asset($event->pic)}}" alt="{{$event->name}}" style="width:90px;">   
                        <button type="button" class="btn btn-danger m-1" style="height:40px;" onclick="remprev()">&times;</button>
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace file"><i class="fa fa-user"></i></div>
                        <input type="file"  name="file"  style="padding: 5px;" >
                        <input type="checkbox" name="remfile" id="remfile" class="d-none" value="1">
                    </div>
                    @if ($event->pic)
                    <div class="input-group file-preview">
                      <a href="{{asset($event->file)}}" style="width:90px;">View file</a> 
                      <button type="button" class="btn btn-danger m-1" style="height:40px;" onclick="remprevfile()">&times;</button>
                    </div>
                  @endif
                </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Active Status"><i class="fa fa-check-circle"></i></div>
                            <select name="active" id="status" class="form-control" required>
                                <option value="1" @if ($event->active=='1')
                                  selected  
                                @endif>Active</option>
                                <option value="0" @if ($event->active=='0')
                                selected  
                              @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-actions form-group"><button type="submit" class="btn btn-success btn" id="std-btn">Submit</button></div>
                </form>
                
                
  <!-- /page content -->
@endsection

@section('extra-js')

  <script >

function remprev(){
  $('.pic-preview').remove();
  $('#rempic').prop('checked','true');
}
function remprevfile(){
  $('.file-preview').remove();
  $('#remfile').prop('checked','true');
}

    </script>
@endsection