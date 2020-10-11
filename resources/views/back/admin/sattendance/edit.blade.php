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
              <h2>Edit Student Attendance</h2>
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
              
                <form action="{{route('studentattendances.update',[$students[0]])}}" method="post" class="">
                    @csrf
                    {{method_field('put')}}
                    <table width='100%' style="border: 1px;" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>pic</th>
                          <th>name</th>
                          <th>present</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($students as $student)
          <tr>
              <td><img src="{{$student->avatar ? asset($student->avatar) 
                : asset('img/default.jpeg')}}" alt="" style="width:90px;"></td>
              <td> <label for="{{'present_'.$student->id }}">{{$student->name }}</label></td>
              <td> <input type="checkbox" name="present[]" id="{{'present_'.$student->id }}" value="1" style="transform: scale(1.5)" onchange="changed({{$student->id }})" 
               @if ($student->tstdattendance[0]->present)
                   checked
               @endif>
                <input type="checkbox" name="present[]" id="{{'absent_'.$student->id }}" value="0" style="transform: scale(1.5);display:none;" @if (!$student->tstdattendance[0]->present)
                checked
            @endif >
              <input type="hidden" name="tid[]" value="{{$student->id }}">
              <input type="hidden" name="taid[]" value="{{$student->tstdattendance[0]->id }}">
              </td>
          </tr>
          @endforeach
                      </tbody>
                    </table>

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
@endsection