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
              <h2>Add New User</h2>
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
              
                <form action="{{route('admin.users.store')}}" method="post" class="" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="User name"><i class="fa fa-user"></i></div>
                            <input type="text" id="name" name="name" placeholder="User name" class="form-control" value="{{old('name')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="male" data-toggle="tooltip" data-placement="right"  data-original-title="Male"><span class="fa fa-male input-group-addon"></span>
                            <input type="radio" id="male" name="gender"  class="form-" value="0" @if (old('gender')==='0')
                            checked 
                          @endif required>
                            </label>
                            <label for="female" data-toggle="tooltip" data-placement="right"  data-original-title="Female"><span class="fa fa-female input-group-addon"></span>
                            <input type="radio" id="female" name="gender"  class="form-" value="1" @if (old('gender')==='1')
                            checked 
                          @endif>
                            </label>
                            <label for="other" data-toggle="tooltip" data-placement="right"  data-original-title="Other/both"><span class="fa fa-user input-group-addon"></span>
                            <input type="radio" id="other" name="gender"  class="form-" value="2" @if (old('gender')==='2')
                            checked 
                          @endif @if (!old('gender'))
                          checked 
                        @endif>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="email"><i class="fa fa-envelope"></i></div>
                            <input type="text" id="email" name="email" placeholder="Email" class="form-control" value="{{old('email')}}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="active status"><i class="fa fa-check-circle"></i></div>
                            <select name="active" id="status" class="form-control" required>
                                <option value="1" @if (old('active')==='1')
                                  selected  
                                @endif>Active</option>
                                <option value="0" @if (old('active')==='0')
                                selected  
                              @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Password"><i class="fa fa-asterisk"></i></div>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" minlength="8" value="">
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
