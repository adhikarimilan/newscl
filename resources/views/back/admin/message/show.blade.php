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
			  <h2>All Messages</h2>
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
			  
				<div class="row">
					<div class="col-sm-12">
						<div class="main-card card p-3">
							<h3 class="box-title m-b-0">{{$message->name}}</h3>
							<div class="panel-body">
								<div class="container mt-5">
								<h5>Email: {{ $message->email}}</h5>
									<h5>Subject: {{$message->subject}}</h5>
								   <h5>Message: {{$message->message}}</h5>
								   <br>
								   <h4>sent by: {{$message->name}} on {{$message->created_at}}</h4>         
							</div>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <!-- /page content -->
@endsection
