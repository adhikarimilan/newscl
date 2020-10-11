
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
              
                <form action="{{route('bookissues.store')}}" method="post" class="">
                    @csrf
                    <h4>Choose Student</h4>
                    <div id="std-1" class="my-2">
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
                    </div>
                  </div>

                  <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                            <select name="book" id="book" class="form-control" required>
                                <option value=''><i class="fa fa-check-circle"></i>Choose  Book&hellip;</option>
                                @if(isset($books) && count($books))
                                @foreach ($books as $book)
                            <option value="{{$book->id}}" @if (old('book')===$book->id)
                                selected  
                              @endif>{{ $book->title.'('.$book->author.')'}}</option>
                              {{-- {{($book->class())}} --}}
                                @endforeach
                                @endif
    
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class='input-group date' id='myDatepicker2'>
                          <input type='text' class="form-control" placeholder="Return date" name='return_bef' value="{{old('return_bef')}}" required/>
                          <span class="input-group-addon">
                             <span class="fa fa-calendar"></span>
                          </span>
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
<script src="{{asset('back/vendors/moment/min/moment.min.js')}}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('back/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
  <script>
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
    });
  </script>
  <script >
      var iid;
      iid=0;
      var sec=1;
function remprev(){
  $('.pic-preview').remove();
  $('#rempic').prop('checked','true');
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
		  //console.log(response.data);
          var newstds=response.data;
          let options='';
          let students=$('#students-'+num);
          let pre='<div class="form-group" id="student-updated-'+num+'"><div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div><select name="student"  class="form-control" title="Choose Student" required onchange="getdues('+ num +')" id="student-'+num+'"><option value="">Choose Student</option>';
          newstds.forEach(newsec => {
             // options+="<option value='fgk'>dfkjgk</option>";
             pre+='<option value="'+ newsec.id +'">'+newsec.name+'('+ newsec.roll_no +')'+'</option>';
           
          });
        pre+='</select></div></div><p id="dues-updated-'+ num +'"></p>'
        pre=$(pre);
        students.append(pre);
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

function getdues(id){
        let num=id;
          event.preventDefault();
          let sval=$("#student-"+ num).val();
          if(sval){
            let updated=$('#dues-updated-'+ num);
            if(updated) updated.empty();
          $('#spinner-'+num).removeClass('d-none');

          if(iid!=sval){
            $('#section-choose-def-'+ num).hide();
            let url="{{route('students.getdues')}}";
            let sid=sval;

            $.ajaxSetup({
	    headers: {
	    'X-CSRF-TOKEN': '{{csrf_token()}}'
	    }
	});
		  $.ajax({
		  type: 'POST',
		  url: url,
		  data: {
      sid:sval,
		   },
		  cache: false, 
		  success: function(response){ 
        $('#spinner-'+ num).addClass('d-none');
		  //console.log(response.data);
          var dues=parseInt(response.data) ;
        if(dues>0)
        dues='This student has previously borrowed '+ response.data + ' which are not returned till now';
        else
         dues='This student does not have any due books till now.';
        updated.append(dues);
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
    
    </script>
@endsection
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet')}}">
    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('back/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}} " rel="stylesheet">
@endsection