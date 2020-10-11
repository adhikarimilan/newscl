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
              <h2>Create New Assignment</h2>
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
              
                <form action="{{route('teacher.assignments.store')}}" method="post" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Assignment name"><i class="fa fa-user"></i></div>
                            <input type="text" id="name" name="name" placeholder="Assignment name" class="form-control" value="{{old('name')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                          <textarea name="description" id="description" cols="30" rows="6" class="form-control" placeholder="Description"></textarea>
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
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose File"><i class="fa fa-user"></i></div>
                          <input type="file"  name="file"  style="padding: 5px;" >
                      </div>
                  </div>
                    
                    <div class="form-group">
                      <div class='input-group date' id='myDatepicker2'>
                        <span class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="final submission date">
                          <span class="fa fa-calendar"></span>
                       </span>
                          <input type='text' class="form-control" placeholder="Return date" name='submission_date' value="{{old('submission_date')}}" required/>
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
  <script >
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD',
    });
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
@section('extra-css')
<link href="{{asset('back/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
@endsection
