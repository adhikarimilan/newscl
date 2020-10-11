@if(Session::has('success'))
<div class="alert  alert-success alert-dismissible fade show" role="alert">
    <span class="rounded-circle badge badge-success "><i class="fa fa-check"></i></span> {{Session::get('success')}}
    @if(Session::has('link'))
      <a href="{{Session::get('link')}}" class="ml-1">view</a>   
    @endif
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif


@if(Session::has('error'))
<div class="alert  alert-danger alert-dismissible fade show" role="alert">
    <span class="rounded-circle badge badge-danger "><i class="fa fa-exclamation"></i></span> {{Session::get('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if ($errors->any())
    <div class="alert alert-warning">
        <ul style="list-style-type:square;padding:5px 10px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif