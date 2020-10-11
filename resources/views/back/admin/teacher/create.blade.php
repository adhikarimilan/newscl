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
              <h2>Add Teacher</h2>
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
              
            <form action="{{route('teachers.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Teacher name"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Teachername" class="form-control" value="{{old('name')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label for="male" data-toggle="tooltip" data-placement="right" title="" data-original-title="Male"><span class="fa fa-male input-group-addon"></span>
                        <input type="radio" id="male" name="gender"  class="form-" value="0" @if (old('gender')==='0')
                        checked 
                      @endif required>
                        </label>
                        <label for="female" data-toggle="tooltip" data-placement="right" title="" data-original-title="female"><span class="fa fa-female input-group-addon"></span>
                        <input type="radio" id="female" name="gender"  class="form-" value="1" @if (old('gender')==='1')
                        checked 
                      @endif>
                        </label>
                        <label for="other" data-toggle="tooltip" data-placement="right" title="" data-original-title="other/both"><span class="fa fa-user input-group-addon"></span>
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
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Temporary Address"><i class="fa fa-location-arrow"></i></div>
                        <input type="text" id="tempaddress" name="temp_address" placeholder="Temporary Address" class="form-control" value="{{old('temp_address')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" data-original-title="Permanent address"><i class="fa fa-map-marker"></i></div>
                        <input type="text" id="peraddress" name="per_address" placeholder="Permanent address" class="form-control" value="{{old('per_address')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" data-original-title="Contact Number"><i class="fa fa-mobile"></i></div>
                        <input type="text" id="contact" name="contact" placeholder="Contact Number" class="form-control" value="{{old('contact')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Email"><i class="fa fa-envelope"></i></div>
                        <input type="text" id="email" name="email" placeholder="Email" class="form-control" value="{{old('email')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Education"><i class="fa fa-book"></i></div>
                        <input type="text" id="education" name="education" placeholder="Education" class="form-control" value="{{old('education')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Faculty"><i class="fa fa-certificate"></i></div>
                        <input type="text" id="faculty" name="faculty" placeholder="Faculty" class="form-control" value="{{old('faculty')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Post"><i class="fa fa-briefcase"></i></div>
                    <input type="text" id="post" name="post" placeholder="Post" class="form-control" value="{{old('post')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Order"><i class="fa fa-sort-numeric-asc"></i></div>
                        <input type="number" id="order" name="order" placeholder="Order" class="form-control" min="0" value="{{old('order')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace Avatar"><i class="fa fa-user"></i></div>
                        <input type="file"  name="pic"  style="padding: 5px;" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Active/Inactive"><i class="fa fa-check-circle"></i></div>
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
                        <div class="input-group-addon" data-toggle="tooltip" data-placement="right" title="" data-original-title="Password"><i class="fa fa-asterisk"></i></div>
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

@section('contents')

<div class="content mt-3">
    @include('msg.msg')
    <div class="card">
        <div class="card-header">Add New Teacher</div>
        <div class="card-body card-block">
        
        </div>
    </div>


</div>
@endsection
@section('extras')
    
        <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script >
    // window.unload(function(){
    //     let e = confirm("Are you sure to quit this page?");
    //     if(e){}
    // })
    (function(){
    //     $(window).bind('beforeunload',function(event){
    //         let msg='are u leaving?'
    //     if(typeof event == undefined)
    //     event=window.event;
    //     if(event)
    //     event.returnValue = msg;
    //     return msg;
    //     return confirm("Are you sure to quit this page?");
    // })
     $('a').click(function(en){
         //en.preventDefault()
         window.onbeforeunload=null;
     })
    })()
    
    // window.onbeforeunload= function(event){
    //     let msg='are u leaving?'
    //     if(typeof event == undefined)
    //     event=window.event;
    //     if(event)
    //     event.returnValue = msg;
    //     return msg;
    // }
    </script>
@endsection