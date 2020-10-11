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
              <h2>Edit Your Profile::{{$teacher->name}}</h2>
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
              <form action="{{route('teacher.teachers.update',['teacher'=>$teacher->id])}}" method="post" class="" enctype="multipart/form-data">
                @csrf
                {{method_field('put')}}
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Teacher name"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Teachername"  class="form-control" value="{{$teacher->name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label for="male" data-toggle="tooltip" data-placement="right"  data-original-title="male"><span class="fa fa-male input-group-addon"></span>
                        <input type="radio" id="male" name="gender"  class="form-" value="0" @if ($teacher->gender=='0')
                        checked 
                      @endif required>
                        </label>
                        <label for="female" data-toggle="tooltip" data-placement="right"  data-original-title="female"><span class="fa fa-female input-group-addon"></span>
                        <input type="radio" id="female" name="gender"  class="form-" value="1" @if ($teacher->gender=='1')
                        checked 
                      @endif >
                        </label>
                        <label for="other" data-toggle="tooltip" data-placement="right"  data-original-title="other/both"><span class="fa fa-user input-group-addon" ></span>
                        <input type="radio" id="other" name="gender"  class="form-" value="2" @if ($teacher->gender=='2')
                        checked 
                      @endif >
                        </label>
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Temporary Address"><i class="fa fa-location-arrow"></i></div>
                        <input type="text" id="tempaddress" name="temp_address" placeholder="Temporary Address" class="form-control" value="{{$teacher->temp_address}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Permanent address"><i class="fa fa-map-marker"></i></div>
                        <input type="text" id="peraddress" name="per_address" placeholder="Permanent address" class="form-control" value="{{$teacher->per_address}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="DOB(B.S.)"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control" name="dob_bs" placeholder="yyyy-mm-dd (bs)" value="{{$teacher->dob_bs}}">
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="DOB(A.D.)"><i class="fa fa-calendar"></i></div>
                      
                      <input type='text' class="form-control"  name='dob_ad' placeholder="yyyy-mm-dd (ad)" value="{{$teacher->dob_ad}}"/>
                  </div>
              </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Contact Number"><i class="fa fa-mobile"></i></div>
                        <input type="text" id="contact" name="contact" placeholder="Contact Number" class="form-control" value="{{$teacher->contact}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Email"><i class="fa fa-envelope"></i></div>
                        <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="{{$teacher->email}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Education"><i class="fa fa-book"></i></div>
                        <input type="text" id="education" name="education" placeholder="Education" class="form-control" value="{{$teacher->education}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Faculty"><i class="fa fa-certificate"></i></div>
                        <input type="text" id="faculty" name="faculty" placeholder="Faculty" class="form-control" value="{{$teacher->faculty}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Post"><i class="fa fa-briefcase"></i></div>
                    <input type="text" id="post" name="post" placeholder="Post" class="form-control" value="{{$teacher->post}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Order"><i class="fa fa-sort-numeric-asc"></i></div>
                        <input type="number" id="order" name="order" placeholder="Order" class="form-control" min="0" value="{{$teacher->order}}">
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace Avatar"><i class="fa fa-user"></i></div>
                      <input type="file"  name="pic"  style="padding: 5px;" >
                      <input type="checkbox" name="rempic" id="rempic" class="d-none" value="1">
                  </div>
                  @if ($teacher->avatar)
                  <div class="input-group pic-preview">
                    <img src="{{asset($teacher->avatar)}}" alt="{{$teacher->name}}" style="width:90px;">   
                    <button type="button" class="btn btn-danger m-1" style="height:40px;" onclick="remprev()">&times;</button>
                  </div>
                @endif
              </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Active"><i class="fa fa-check-circle"></i></div>
                        <select name="active" id="status" class="form-control" required>
                            <option value="1" @if ($teacher->active=='1')
                              selected  
                            @endif>Active</option>
                            <option value="0" @if ($teacher->active=='0')
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