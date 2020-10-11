@extends('back.admin.layout.index')
@section('content')
<div class="right_col" role="main">
    <div class="">
<div class="row">
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2><strong class="card-title">All Students</strong>
        </h2>
        <a href="{{route('students.create')}}" class="btn btn-success pull-right btn-sm">Add New Student</a>
      <ul class="nav navbar-right panel_toolbox">
        
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
        <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
              @include('msg.msg')
      <p class="text-muted font-13 m-b-30">
      </p>
      @if(isset($statuserr))
<div class="alert  alert-danger alert-dismissible fade show" role="alert">
    <span class="rounded-circle badge badge-danger "><i class="fa fa-exclamation"></i></span> {{$statuserr}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
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
    @if(isset($students))
      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
              <th>&nbsp;</th>
              @php 
              if(isset($reqdate) && $reqdate){
                    $ndays=$d;
                    if($reqdate==date("Y-m-"))
                    $ndays=date("d");
                    $reqdate=explode('-', $reqdate);
                    //dd($reqdate);
                    $y=$reqdate[0];$m=$reqdate[1];}
                    else {
                      $ndays=date('d');
                      $y=date('Y');$m=date('m'); 
                    }
              @endphp
              <th><?php echo $y."-".$m ;?> -><br>Student name</th>
              @for ($i = 0; $i < $ndays ; $i++)
              <th>{{$i+1}}</th>   
              @endfor
          </tr>
      </thead>
      <tbody>
      @if(Count($students))
      @foreach ($students as $student)
          <tr>
              <td><img src="{{$student->avatar ? asset($student->avatar) 
                : asset('img/default.jpeg')}}" alt="" style="width:30px;"></td>
              <td>{{$student->name }}</td>
              
              @for ($i = 0; $i < $ndays; $i++)
              @php
                  $attendances=$student->stdattendance;
                  //echo "<br>";
                  //print_r($attendances);
              @endphp
               @foreach ($attendances as $k=>$item)
               
               @php
                  
                   // print_r($k);
                    $date=explode(' ', $item->created_at);
                   $date=array_shift($date);
                   $j=$i+1;
                   $ckd=date_create($y.'-'.$m.'-'.$j);
                   $wday=date_format($ckd,"w");
                   $found=0;
                   
               @endphp
               @if($date==date_format($ckd,"Y-m-d"))
               @php
               unset($attendances[$k]);
                $found=1;   
               @endphp
               @if($item->present)
               <th @if($wday=='6') class="bg-danger" @endif> P</th>
               @else
            <th @if($wday=='6') class="bg-danger" @endif> A</th>
                @endif
                @php
                    break;
                @endphp
                @endif

               @endforeach
            @if (!$found)
                <th @if($wday=='6') class="bg-danger" @endif>-</th>
            @endif
              @endfor 
            
          </tr>
      @endforeach
      @else 
      <tr>
        <td colspan="<?=$i?>">No data available</td>
      </tr>  
      @endif
      </tbody>
      </table>
      @endif
    </div>
  </div>
</div>
</div>

<iframe src="https://www.hamropatro.com/widgets/calender-medium.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:295px; height:385px;" allowtransparency="true"></iframe>

<div id='calendar'></div>
<script>
 

var d=document.getElementById("myform");
console.log(d); 
</script>
  </div>
</div>
</div></div>
</div>

@endsection

@section('extra-js')
<!-- FullCalendar -->
    <script src="{{asset('back/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('back/vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>

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
      $('#spinner').addClass('d-none');
    //console.log(response.data);
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
<!-- FullCalendar -->
    <link href="{{asset('back/vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('back/vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">

@endsection