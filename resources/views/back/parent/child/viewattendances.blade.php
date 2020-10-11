@extends('back.parent.layout.index')
@section('content')
<div class="right_col" role="main">
    <div class="">
<div class="row">
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2><strong class="card-title">Attendances</strong>
        </h2>
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
              <div class="card-box">
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
@php 
              if(isset($reqdate) && $reqdate){
                    $ndays=$d;
                    if($reqdate==date("Y-m-"))
                    $ndays=date("d");
                    $reqdate=explode('-', $reqdate);
                    //dd($reqdate);
                    $y=$reqdate[0];$m=$reqdate[1];
                    $d=date_create($y.'-'.$m);
                    $m=date_format($d,'m');
                    $mal=date_format($d,'M');
                  }
                    else {
                      $ndays=date('d');
                      $y=date('Y');$m=date('m'); 
                      $mal=date('M');
                    }
              @endphp
      <form action="" method="get">
        
      <div class="form-row pb-2">
        <div class="col-md-6">
          <select name="y" class="form-control">
            <option value="">Select year</option>
            <option value="2020" @if ($y=='2020')
               selected 
            @endif>2020</option>
            <option value="2021" @if ($y=='2021')
            selected 
         @endif>2021</option>
          </select>
        </div>
        <div class="col-md-6">
          <select name="m" class="form-control">
            <option value="">Select month</option>
            <option value="1" @if ($m=='1')
            selected 
         @endif>Jan</option>
            <option value="2" @if ($m=='2')
            selected 
         @endif>Feb</option>
            <option value="3" @if ($m=='3')
            selected 
         @endif>Mar</option>
            <option value="4" @if ($m=='4')
            selected 
         @endif>Apr</option>
            <option value="5" @if ($m=='5')
            selected 
         @endif>May</option>
            <option value="6" @if ($m=='6')
            selected 
         @endif>Jun</option>
            <option value="7" @if ($m=='7')
            selected 
         @endif>Jul</option>
            <option value="8" @if ($m=='8')
            selected 
         @endif>Aug</option>
            <option value="9" @if ($m=='9')
            selected 
         @endif>Sep</option>
            <option value="10" @if ($m=='10')
            selected 
         @endif>Oct</option>
            <option value="11" @if ($m=='11')
            selected 
         @endif>Nov</option>
            <option value="12" @if ($m=='12')
            selected 
         @endif>Dec</option>
          </select>
        </div>
      </div>
      
      
      <div class="form-actions form-group"><button type="submit" class="btn btn-success btn">Submit</button></div>
    </form>
    
    @if(isset($students))
    <div class="table-responsive">
      <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
              <th>&nbsp;</th>
              
              <th><?php echo $y."-".$mal ;?> -><br>Student name</th>
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
                  $j=$i+1;
                   $ckd=date_create($y.'-'.$m.'-'.$j);
                   $wday=date_format($ckd,"w");
                   $found=0;
                  //dump($attendances);
                  //echo "<br>";
                  //print_r($attendances);
              @endphp
              @if ($attendances)
               @foreach ($attendances as $k=>$item)
               
               @php
                  
                   // print_r($k);
                    $date=explode(' ', $item->created_at);
                   $date=array_shift($date);
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

               @endforeach @endif
            @if (!$found)
                <th @if($wday=='6') class="bg-danger" @endif>-</th>
            @endif
              @endfor 
            
          </tr>
      @endforeach
      @else 
      <tr>
        <td colspan="<?=$i+2?>">No data available</td>
      </tr>  
      @endif
      </tbody>
      </table>
    </div>
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


@endsection

@section('extra-css')
<!-- FullCalendar -->
    <link href="{{asset('back/vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('back/vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">

@endsection