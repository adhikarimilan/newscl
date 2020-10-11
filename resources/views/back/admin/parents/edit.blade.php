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
              <h2>Edit Parent::{{$parent->name}}</h2>
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
                <form action="{{route('parents.update',['parent'=>$parent->id])}}" method="post" class="" id='std-form' enctype="multipart/form-data">
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
                    <div class="form-actions form-group"><button type="submit" class="btn btn-success btn" id="std-btn">Submit</button></div>
                </form>
                {{-- already linked students --}}
                <h3 class="text-dark mt-2">All linked Student</h3>
                <form action="{{route('parents.updatechildren')}}" method="post" id="stdform">
                <table class="table table-striped">
                  <thead>
                    <tr>
                    <th>Pic</th>
                    <th>Name</th>
                    <th>Relation</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>&nbsp;</th>
                   </tr>
                  </thead>
                  <tbody>
                @foreach($parent->student_parent as $stdpar)
                   <tr id="{{'rel-existing-'.$stdpar->id}}">
                   <td><img src="{{$stdpar->student->avatar ?? asset('img/default.jpeg')}}" alt="" style="width:90px;"></td>
                   <td>{{$stdpar->student->name}}</td>
                   <td>{{$stdpar->relation ?? '-'}}</td>
                   <td>{{$stdpar->student->class ?$stdpar->student->class->name:'N/A'}}</td>
                   <td>{{$stdpar->student->section ?$stdpar->student->section->name:'N/A'}}</td>
                   <td><button class="btn btn-dark" type="button"  onclick="remexi({{$stdpar->id}})">-</button></td>
                  <input type="hidden" name="student[]" id="" readonly value="{{$stdpar->student->id}}">
                    <input type="hidden" name="relation[]" id="" readonly value="{{$stdpar->relation}}">
                    <input type="hidden" name="reln[]">
                  </tr>
                @endforeach
              </tbody>
            </table>
                {{-- student addition --}}
                <h3 class="text-dark mt-2">Add Student</h3>
                
                  @csrf
                  <div id="student-sel">
                    <input type="hidden" name="par" value="{{$parent->id}}">
                  <div id="std-1" >
                  <div class="p-2" style="border:1px solid;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Class"><i class="fa fa-home"></i></div>
                            <select name="class" id="class-1" class="form-control classes" title="Choose Class" onchange="gsecs(1)">
                                <option value="">Choose Class</option>
                                @foreach ($classes as $class)
                            <option value="{{$class->id}}" >{{$class->name}}</option> 
                                @endforeach
                            </select>
                            <span class="spinner-border spinner-border-sm text-primary ml-1 d-none" role="status" id="spinner-1" style="margin-top:8px;">
                                <span class="sr-only">Loading...</span>
                            </span>
                        </div>
                    </div>
                    <div id="sections-1">
                    <div class="form-group" id='section-choose-def-1'>
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Section"><i class="fa fa-star"></i></div>
                            <select name="section" id="section" class="form-control" title="Choose Section">
                                <option value="">Choose Section</option>
                            </select>
                        </div>
                        
                    </div>
                    
                </div>
                <input type="button" value="search student" id="stdsearch-1" class="btnsearch mb-1" onclick="searchstd(1)">
                <div id="students-1">

                </div>
                <div id="relation-1"></div>
                </div>
                <button class="btn btn-dark my-2" type="button" id="minus-1" onclick="remsec(1)">-</button>
              </div>
              {{-- endstd1 --}}
            </div>
                <button class="btn btn-primary my-2" type="button" id="plus-sec">+</button>
<input type="submit" value="submit" class="btn btn-success d-block">
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
      iid=0;
      var sec=1;
function remprev(){
  $('.pic-preview').remove();
  $('#rempic').prop('checked','true');
}
function chrel(id){
  let num=id;
  let rel=$("#rel-"+num).val();
  if(rel=='1'){
    $('#reln-'+num).show();
    $('#reln-'+num).focus();
  }
  else
  $('#reln-'+num).hide();
}
function gsecs(id){
        let num=id;
          let val=$("#class-"+num).val();
          if(val){
            let updated=$('#section-updated-'+ num);
            if(updated) updated.remove();
          $('#spinner-'+num).removeClass('d-none');

          if(iid!=val){
            $('#section-choose-def-'+num).hide();
            let url="{{route('classes.getsections')}}";
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
        $('#spinner-'+ num).addClass('d-none');
		  
          var newsecs=response.data;
          console.log(newsecs);
          let options='';
          let sections=$('#sections-'+num);
          let pre='<div class="form-group" id="section-updated-'+num+'"><div class="input-group"><div class="input-group-addon"><i class="fa fa-star"></i></div><select name="section" id="section-'+num+'"  class="form-control" title="Choose Section"><option value="">Choose Section</option>';
          newsecs.forEach(newsec => {
             pre+='<option value="'+ newsec.id +'">'+newsec.name+'</option>';
          });
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
               $('#section-choose-def-'+num).show();
               $('#section-updated-'+num).remove();
               $('#spinner-'+num).addClass('d-none');
               }
          }
          else{
            let updated=$('#section-updated-'+num);
            if(updated) updated.remove();
             $('#section-choose-def-'+num).hide();
             $('#spinner-'+num).addClass('d-none');
            }
}

function searchstd(id){
        let num=id;
          event.preventDefault();
          let cval=$("#class-"+ num).val();
          let sval=$("#section-"+ num).val();
          
          if(cval){
            let updated=$('#student-updated-'+ num);
            if(updated) updated.remove();
            updated=$('#relation-updated-'+ num);
            if(updated) updated.remove();
          $('#spinner-'+num).removeClass('d-none');

          if(iid!=cval){
            $('#section-choose-def-'+ num).hide();
            let url="{{route('classes.getstudents')}}";
            let cid=cval;

            $.ajaxSetup({
	    headers: {
	    'X-CSRF-TOKEN': '{{csrf_token()}}'
	    }
	});
		  $.ajax({
		  type: 'POST',
		  url: url,
		  data: {
			cid:cid,
      sid:sval,
		   },
		  cache: false, 
		  success: function(response){ 
        $('#spinner-'+ num).addClass('d-none');
		  console.log(response.data);
          var newstds=response.data;
          let options='';
          let students=$('#students-'+num);
          let rels=$('#relation-'+num);
          let pre='<div class="form-group" id="student-updated-'+num+'"><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><select name="student[]"  class="form-control" title="Choose Student"><option value="">Choose Student</option>';
          newstds.forEach(newsec => {
             // options+="<option value='fgk'>dfkjgk</option>";
             pre+='<option value="'+ newsec.id +'">'+newsec.name+'('+ newsec.roll_no +')'+'</option></div></div>';
           
          });
          let rel='<div class="form-group" id="relation-updated-'+num+'"><div class="input-group"><div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Relation" ><i class="fa fa-star"></i></div> <select name="relation[]" id="rel-'+num+'" class="form-control" onchange="chrel('+num+')"><option value="">Choose Relation</option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Uncle">Uncle</option><option value="Aunt">Aunt</option><option value="1">Other</option></select><br><input type="text" name="reln[]" id="reln-'+num+'" placeholder="please specify the relation" class="form-control" style="display:none;">';
        pre=$(pre);
        rel=$(rel);
        students.append(pre);
        rels.append(rel);
	    },
		catch :function(response){
		  alert('an error occured');
		 },
			
		
		//   },
		  dataType: 'json'
		  
	  });

		  }
          
          else{
               $('#section-choose-def-'+ num).show();
               $('#section-updated-'+ num).remove();
               $('#spinner-'+ num).addClass('d-none');
               }
          }
          else{
             $('#spinner-'+ num).addClass('d-none');
            }
}

function remsec(h){
        let id='#std-'+h;
        $(id).remove();
    }

    function remexi(h){
        let id='#rel-existing-'+h;
        $(id).remove();
    }

    (function(){
        iid=0;
        var classes={};
        classes='{{$classes}}';
        classes=JSON.parse(classes.replace(/&quot;/g,'"'));
        console.log(classes);

        
        $('#plus-sec').click(function(){
        sec++;
        //let cls=$(event.target).attr('id');
        //let num=cls.substr(6);
        //let id='secadded-'+sec;
        let section=$('#student-sel');
        let pre='<div id="std-'+sec+'"><div class="p-2" style="border:1px solid;"><div class="form-group"><div class="input-group"><div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Class"><i class="fa fa-home"></i></div><select name="class" id="class-'+sec+'" class="form-control classes" title="Choose Class" onchange=gsecs('+sec+')><option value="">Choose Class</option>';
          classes.forEach(cls => {
             pre+='<option value="'+ cls.id +'">'+cls.name+'</option>';
          });

pre+='</select><span class="spinner-border spinner-border-sm text-primary ml-1 d-none" role="status" id="spinner-'+sec+'" style="margin-top:8px;"><span class="sr-only">Loading...</span></span></div></div><div id="sections-'+sec+'"><div class="form-group" id="section-choose-def-'+sec+'"><div class="input-group"><div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Section"><i class="fa fa-star"></i></div><select name="section" id="section" class="form-control" title="Choose Section"><option value="">Choose Section</option></select></div></div></div><input type="button" value="search student" id="stdsearch-'+sec+'" class="btnsearch mb-1" onclick="searchstd('+sec+')"><div id="students-'+sec+'"></div><div id="relation-'+sec+'"></div></div><button class="btn btn-dark my-2" type="button" id="minus-'+sec+'" onclick="remsec('+sec+')">-</button></div>';
pre=$(pre);
        section.append(pre);
    });

    
    function remsecadded(h){
        let id='#secadded-'+h;
        $(id).remove();
    }
    



})()
    </script>
@endsection