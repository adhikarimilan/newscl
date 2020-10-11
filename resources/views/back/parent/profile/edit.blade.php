@extends('back.parent.layout.index')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
     
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Edit Your Profile::{{$parent->name}}</h2>
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
              <form action="{{route('parent.profile.update',['id'=>$parent->id])}}" method="post" class="" enctype="multipart/form-data">
                @csrf
                {{method_field('put')}}
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Parent name"><i class="fa fa-user"></i></div>
                      <input type="text" id="name" name="name" placeholder="Parentname" class="form-control" value="{{$parent->name}}" required title="Parent Name">
                      
                  </div>
              </div>
              
              <div class="form-group">
                  <div class="input-group">
                      <label for="male" data-toggle="tooltip" data-placement="right"  data-original-title="male"><span class="fa fa-male input-group-addon"></span>
                      <input type="radio" id="male" name="gender"  class="form-" value="0" @if ($parent->gender=='0')
                      checked 
                    @endif required title='Gender: Male'>
                      </label>
                      <label for="female" data-toggle="tooltip" data-placement="right"  data-original-title="female" ><span class="fa fa-female input-group-addon"></span>
                      <input type="radio" id="female" name="gender"  class="form-" value="1" @if ($parent->gender=='1')
                      checked 
                    @endif title='Gender: Female'>
                      </label>
                      <label for="other" data-toggle="tooltip" data-placement="right"  data-original-title="other/both"><span class="fa fa-user input-group-addon"></span>
                      <input type="radio" id="other" name="gender"  class="form-" value="2" @if ($parent->gender==2)
                      checked 
                    @endif 
                     @if ($parent->gender===null)
                    checked 
                  @endif title='Gender: Both'
                  >
                      </label>
                  </div>
              </div>
              
              
          <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Occupation"><i class="fa fa-user-md"></i></div>
                <input type="text" id="Occupation" name="occupation" placeholder="Occupation" class="form-control" value="{{$parent->occupation}}" >
            </div>
        </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Address"><i class="fa fa-map-marker"></i></div>
                      <input type="text" id="peraddress" name="address" placeholder="Permanent address" class="form-control" value="{{$parent->address}}" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Contact Number"><i class="fa fa-mobile"></i></div>
                      <input type="text" id="contact" name="contact" placeholder="Contact Number" class="form-control" value="{{$parent->contact}}" >
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Email"><i class="fa fa-envelope"></i></div>
                      <input type="text" id="email" name="email" placeholder="Email" class="form-control" value="{{$parent->email}}" required>
                  </div>
              </div>
            
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace Avatar"><i class="fa fa-user"></i></div>
                    <input type="file"  name="pic"  style="padding: 5px;" >
                    <input type="checkbox" name="rempic" id="rempic" class="d-none" value="1">
                </div>
                @if ($parent->avatar)
                <div class="input-group pic-preview">
                  <img src="{{asset($parent->avatar)}}" alt="{{$parent->name}}" style="width:90px;">   
                  <button type="button" class="btn btn-danger m-1" style="height:40px;" onclick="remprev()">&times;</button>
                </div>
              @endif
            </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Active Status"><i class="fa fa-check-circle"></i></div>
                      <select name="active" id="status" class="form-control" required>
                          <option value="1" @if ($parent->active=='1')
                            selected  
                          @endif>Active</option>
                          <option value="0" @if ($parent->active=='0')
                          selected  
                        @endif>Inactive</option>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Password"><i class="fa fa-asterisk"></i></div>
                      <input type="password" id="password" name="password" placeholder="Password" class="form-control" minlength="8">
                  </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  
                    <input type="checkbox" name="pass" id='pass' value="1" style="transform: scale(1.2)"><label for="pass" class='ml-2 text-dark'>Set Password</label>
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

 <script>
   function remprev(){
  $('.pic-preview').remove();
  $('#rempic').prop('checked','true');
}
  </script>       

@endsection