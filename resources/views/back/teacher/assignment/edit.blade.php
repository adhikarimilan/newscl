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
              <h2>Edit Assignment::{{$assignment->name}}</h2>
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
                <form action="{{route('teacher.assignments.update',['assignment'=>$assignment->id])}}" method="post" class="" id='std-form' enctype="multipart/form-data">
                    @csrf
                    {{method_field('put')}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Assignment name"><i class="fa fa-user"></i></div>
                            <input type="text" id="name" name="name" placeholder="Assignmentname" class="form-control" value="{{$assignment->name}}" required title="Assignment Name">
                            
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <textarea name="description" id="description" cols="30" rows="6" class="form-control" placeholder="Description">{{$assignment->description}}</textarea>
                      </div>
                  </div>
                    <div id="class-section">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Class"><i class="fa fa-home"></i></div>
                            <select name="class" id="class" class="form-control" title="Choose Class">
                                <option value="">Choose Class</option>
                                @foreach ($classes as $class)
                            <option value="{{$class->id}}" @if ($assignment->class_id===$class->id)
                                  selected  
                                @endif>{{$class->name}}</option> 
                                @endforeach
                            </select>
                            <span class="spinner-border spinner-border-sm text-primary ml-1 d-none" role="status" id="spinner" style="margin-top:8px;">
                                <span class="sr-only">Loading...</span>
                            </span>
                        </div>
                    </div>
                    <div id="sections">
                    @if($assignment->class && $assignment->class->sections)
                    <div class="form-group" id='section-choose-def'>
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Section"><i class="fa fa-star"></i></div>
                            <select name="section" id="section" class="form-control" title="Choose Section">
                                <option value="">Choose Section</option>
                                 @foreach ($assignment->class->sections as $section)
                            <option value="{{$section->id}}" @if ($assignment->section_id===$section->id)
                                  selected  
                                @endif>{{$section->name}}</option> 
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                </div>
                    
                    <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Upload/replace File"><i class="fa fa-user"></i></div>
                          <input type="file"  name="file"  style="padding: 5px;" >
                          <input type="checkbox" name="remfile" id="remfile" class="d-none">
                      </div>
                      @if ($assignment->file)
                      <div class="input-group file-preview">
                        <a href="{{asset($assignment->file)}}" class="btn" style="border:1px solid;">View file</a>   
                        <button type="button" class="btn btn-danger m-1" style="height:40px;" onclick="remprev()">&times;</button>
                      </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <div class='input-group date' id='myDatepicker2'>
                      <span class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="final submission date">
                        <span class="fa fa-calendar"></span>
                     </span>
                        <input type='text' class="form-control" placeholder="Submission date" name='submission_date' value="{{$assignment->submitted_till}}" required/>
                        <span class="input-group-addon">
                           <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                    <div class="form-actions form-group"><button type="button" class="btn btn-success btn" id="std-btn">Submit</button></div>
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
  <script >
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
    });
      var iid;
    
      function remprev(){
  $('.file-preview').remove();
  $('#remfile').prop('checked','true');
}
    (function(){
        iid={{$student->class_id ?? 0}};
        var classes={};
        classes='{{$classes}}';
        classes=JSON.parse(classes.replace(/&quot;/g,'"'));
        //console.log(classes);
    //     $(window).bind('beforeunload',function(event){
    //         let msg='are u leaving?'
    //     if(typeof event == undefined)
    //     event=window.event;
    //     if(event)
    //     event.returnValue = msg;
    //     return msg;
    //     return confirm("Are you sure to quit this page?");
    // })
    //  $('a').click(function(en){
    //      //en.preventDefault()
    //      window.onbeforeunload=null;
    //  })
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
    // window.onbeforeunload= function(event){
    //     let msg='are u leaving?'
    //     if(typeof event == undefined)
    //     event=window.event;
    //     if(event)
    //     event.returnValue = msg;
    //     return msg;
    // }
})()
    </script>
@endsection
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
@endsection
