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
              <h2>Add New Student</h2>
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
              
                <form action="{{route('teacher.students.store')}}" method="post" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Student name"><i class="fa fa-user"></i></div>
                            <input type="text" id="name" name="name" placeholder="Studentname" class="form-control" value="{{old('name')}}" required>
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

                    <div id="class-section">
                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Class"><i class="fa fa-home"></i></div>
                              <select name="class" id="class" class="form-control" title="Choose Class">
                                  <option value="">Choose Class</option>
                                  @foreach ($classes as $class)
                              <option value="{{$class->id}}" >{{$class->name}}</option> 
                                  @endforeach
                              </select>
                              <span class="spinner-border spinner-border-sm text-primary ml-1 d-none" role="status" id="spinner" style="margin-top:8px;">
                                  <span class="sr-only">Loading...</span>
                              </span>
                          </div>
                      </div>
                      <div id="sections">
                      <div class="form-group" id='section-choose-def'>
                          <div class="input-group">
                              <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Section"><i class="fa fa-star"></i></div>
                              <select name="section" id="section" class="form-control" title="Choose Section">
                                  <option value="">Choose Section</option>
                              </select>
                          </div>
                      </div>
                      
                  </div>
                  </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Roll number"><i class="fa fa-sort-numeric-asc"></i></div>
                            <input type="number" id="roll" name="roll_no" placeholder="Roll number" class="form-control" min="1" value="{{old('roll_no')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Temporary Address"><i class="fa fa-location-arrow"></i></div>
                            <input type="text" id="tempaddress" name="temp_address" placeholder="Temporary Address" class="form-control" value="{{old('temp_address')}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Permanent address"><i class="fa fa-map-marker"></i></div>
                            <input type="text" id="peraddress" name="per_address" placeholder="Permanent address" class="form-control" value="{{old('per_address')}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Contact Number"><i class="fa fa-mobile"></i></div>
                            <input type="text" id="contact" name="contact" placeholder="Contact Number" class="form-control" value="{{old('contact')}}" >
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
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace Avatar"><i class="fa fa-user"></i></div>
                          <input type="file"  name="pic"  style="padding: 5px;" >
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
@section('extra-js')

  <script >
      var iid;

    (function(){
        iid=0;
        var classes={};
        classes='{{$classes}}';
        classes=JSON.parse(classes.replace(/&quot;/g,'"'));

    $('#std-btn').on('click',function(en){
        //en.preventDefault();
        let val=$("#class").val();
         
          if(val){
            if(iid!=val){
                $('#section-choose-def').remove(); 
                
            }   
          }
          else{
              //let section=
            $('#sections').append($('<input type="hidden" name="section" value="">'));
            $('#section-choose-def').remove(); 
            let updated=$('#section-updated');
            if(updated) updated.remove();
          }
          $('#std-form').submit();
    });

    $('#class').on('change',function(en){
          en.preventDefault();
          let val=$("#class").val();
          
          if(val){
            let updated=$('#section-updated');
            if(updated) updated.remove();
          $('#spinner').removeClass('d-none');

          if(iid!=val){
            $('#section-choose-def').hide();
            let url="{{route('teacher.classes.getsections')}}";
            let cid=val;

            $.ajaxSetup({
	    headers: {
	    'X-CSRF-TOKEN': '{{csrf_token()}}'
	    }
	});
		  $.ajax({
		  type: 'POST',
		  url: url,
		  data: {
			cid:cid
		   },
		  cache: false, 
		  success: function(response){ 
        $('#spinner').addClass('d-none');
		  console.log(response.data);
          var newsecs=response.data;
          let options='';
          let sections=$('#sections');
          let pre='<div class="form-group" id="section-updated"><div class="input-group"><div class="input-group-addon"><i class="fa fa-star"></i></div><select name="section" id="section-up" class="form-control" title="Choose Section"><option value="">Choose Section</option>';
          newsecs.forEach(newsec => {
             // options+="<option value='fgk'>dfkjgk</option>";
             pre+='<option value="'+ newsec.id +'">'+newsec.name+'</option>';
          });
         // options+='</div></div>';
          //options=$(options);
        //   options.appendTo(pre);
        //   pre.appendTo(sections);
        //pre.append(options);
        pre=$(pre);
        sections.append(pre);
	    },
		catch :function(response){
		  alert('an error occured');
		 },
			
		
		//   },
		  dataType: 'json'
		  
	  });

		  }
          
          else{
               $('#section-choose-def').show();
               $('#section-updated').remove();
               $('#spinner').addClass('d-none');
               }
          }
          else{
            let updated=$('#section-updated');
            if(updated) updated.remove();
             $('#section-choose-def').hide();
             $('#spinner').addClass('d-none');
            }
          //alert(val);
      })

})()
    </script>
@endsection
