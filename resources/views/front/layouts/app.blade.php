<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<link rel="icon" href="{{asset('img/logo1.png')}}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="{{ asset('front/css/linearicons.css') }}">
			<link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
			<link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
			<link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
			<link rel="stylesheet" href="{{ asset('front/css/nice-select.css') }}">							
			<link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">
			<link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css') }}">			
			<link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">			
			<link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
			@yield('extra-css')
</head>
<body>
<header id="header" id="home">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row">
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
			  				<ul>
								<li><a href="{{$contact->facebookUrl ?? '#'}}"><i class="fa fa-facebook"></i></a></li>
								<li><a href="{{$contact->twitterUrl ?? '#'}}"><i class="fa fa-twitter"></i></a></li>
								<li><a href="{{$contact->instagramUrl ?? '#'}}"><i class="fa fa-instagram"></i></a></li>
								
			  				</ul>			
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
			  				<a href="tel:+953 012 3654 896"><span class="lnr lnr-phone-handset"></span> <span class="text">{{$contact->contactNumber ?? '+977021461245'}}</span></a>
			  				<a href="mailto:{{$contact->email ?? 'support@myschool.com'}}"><span class="lnr lnr-envelope"></span> <span class="text">{{$contact->contactNumber ?? 'support@myschool.com'}}</span></a>			
			  			</div>
			  		</div>			  					
	  			</div>
			</div>
		    <div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			        <a href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" alt="" title="" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
			          <li><a href="{{url('/')}}">Home</a></li>
			          <li><a href="about.html">About</a></li>
			          <li><a href="courses.html">Courses</a></li>
			          <li><a href="events.html">Events</a></li>
			          <li><a href="gallery.html">Gallery</a></li>
			          <li class="menu-has-children"><a href="">Blog</a>
			            <ul>
			              <li><a href="blog-home.html">Blog Home</a></li>
			              <li><a href="blog-single.html">Blog Single</a></li>
			            </ul>
			          </li>	
			          <li class="menu-has-children"><a href="">Pages</a>
			            <ul>
		              		<li><a href="course-details.html">Course Details</a></li>		
		              		<li><a href="event-details.html">Event Details</a></li>		
			                <li><a href="elements.html">Elements</a></li>
					          <li class="menu-has-children"><a href="">Level 2 </a>
					            <ul>
					              <li><a href="#">Item One</a></li>
					              <li><a href="#">Item Two</a></li>
					            </ul>
					          </li>					                		
			            </ul>
			          </li>					          					          		          
			          <li><a href="{{url('/contact')}}">Contact</a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->		    		
		    	</div>
		    </div>
		  </header><!-- #header -->

          @yield('content')

          <!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>{{$contact->footertext ?? 'About Us'}}</h4>
								<p>{{$contact->footertextdesc ?? 'We are group of qualified teachers who take care of your children with full responsibility.'}}</p>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Quick links</h4>
								<ul>
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Brand Assets</a></li>
									<li><a href="#">Investor Relations</a></li>
									<li><a href="#">Terms of Service</a></li>
								</ul>								
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Features</h4>
								<ul>
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Brand Assets</a></li>
									<li><a href="#">Investor Relations</a></li>
									<li><a href="#">Terms of Service</a></li>
								</ul>								
							</div>
						</div>
																	
					</div>
					<div class="footer-bottom row align-items-center justify-content-between">
						<p class="footer-text m-0 col-lg-6 col-md-12">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </p>
						<div class="col-lg-6 col-sm-12 footer-social">
							<a href="{{$contact->facebookUrl ?? '#'}}"><i class="fa fa-facebook"></i></a>
							<a href="{{$contact->twitterUrl ?? '#'}}"><i class="fa fa-twitter"></i></a>
							<a href="{{$contact->instagramUrl ?? '#'}}"><i class="fa fa-instagram"></i></a>
						</div>
					</div>						
				</div>
			</footer>	
			<!-- End footer Area -->	

            {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
			<script src="{{asset('front/js/vendor/jquery-2.2.4.min.js')}}"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="{{ asset('front/js/vendor/bootstrap.min.js') }}"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="{{ asset('front/js/easing.min.js') }}"></script>			
			<script src="{{ asset('front/js/hoverIntent.js') }}"></script>
			<script src="{{ asset('front/js/superfish.min.js') }}"></script>	
			<script src="{{ asset('front/js/jquery.ajaxchimp.min.js') }}"></script>
			<script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>	
    		<script src="{{ asset('front/js/jquery.tabs.min.js') }}"></script>						
			<script src="{{ asset('front/js/jquery.nice-select.min.js') }}"></script>	
			<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>									
			<script src="{{ asset('front/js/mail-script.js') }}"></script>	
			<script src="{{ asset('front/js/main.js') }}"></script>

			@yield('extra-js')
</body>
</html>
