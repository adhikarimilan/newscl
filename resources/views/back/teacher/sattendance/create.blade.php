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
            <h2>Take Students Attendance </h2>
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
              <form action="" method="get">
                <div id="class-section">
                  <div class="form-group">
                      <div class="input-group">
                          <div class="input-group-addon" data-toggle="tooltip" data-placement="right"  data-original-title="Choose Class"><i class="fa fa-home"></i></div>
                          <select name="class" id="class" class="form-control" title="Choose Class">
                              <option value="">Choose Class</option>
                              @foreach ($classes as $class)
                          <option value="{{$class->id}}" 
                            @if (request('class')==$class->id)
                                selected
                                @php
                                  $sclass=$class;  
                                @endphp
                            @endif
                            >{{$class->name}}</option> 
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
                              @if (isset($sclass) && $sclass->sections)
                                @foreach ($sclass->sections as $section)
                                <option value="{{$section->id}}" 
                                  @if (request('section')==$section->id)
                                      selected
                                  @endif
                                  >{{$section->name}}</option>    
                                @endforeach  
                              @endif
                          </select>
                      </div>
                  </div>
                  
              </div>
              </div>
              <div class="form-actions form-group"><button type="submit" class="btn btn-success btn">Submit</button></div>
            </form>
            @if (isset($students))
    

                <form action="{{route('teacher.studentattendances.store')}}" method="post" class="">
                    @csrf
                    <table width='100%' style="border: 1px;" class="table table-bordered mt-5">
                      <thead>
                        <tr>
                          <th>pic</th>
                          <th>name</th>
                          <th>present</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($students))
                      
                        @foreach ($students as $student)
          <tr>
              <td><img src="{{$student->avatar ? asset($student->avatar) 
                : asset('img/default.jpeg')}}" alt="" style="width:90px;"></td>
              <td> <label for="{{'present_'.$student->id }}">{{$student->name }}</label></td>
              <td> <input type="checkbox" name="present[]" id="{{'present_'.$student->id }}" value="1" style="transform: scale(1.5)" onchange="changed({{$student->id }})">
                <input type="checkbox" name="present[]" id="{{'absent_'.$student->id }}" value="0" style="transform: scale(1.5);display:none;" checked>
              <input type="hidden" name="tid[]" value="{{$student->id }}">
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="form-actions form-group"><button type="submit" class="btn btn-success btn">Submit</button></div>
          @else
          <tr>
            <td colspan="4">No students available</td>
          </tr>
        </tbody>
      </table>
          @endif
                      
                </form>
                @endif
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
function changed(id){
        let pid="#present_"+id;
        let pcb=$(pid);
        //$('#checkbox').prop('checked');
        if(pcb.prop('checked') == true){
          $("#absent_"+id).removeAttr('checked');
        }else
        $("#absent_"+id).prop('checked',true);
        console.log(pcb);
      }
    (function(){
      
})()
    </script>



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