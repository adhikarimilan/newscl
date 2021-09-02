@extends('front.layouts.app')
@section('content')

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">	
    <div class="overlay overlay-bg"></div>
    <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Events
                </h1>	
                <p class="text-white link-nav"><a href="{{url('/')}}">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="{{url('events')}}"> Events</a></p>
            </div>	
        </div>
    </div>
</section>
<!-- End banner Area -->	

<!-- Start event-details Area -->
<section class="event-details-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 event-details-left">
                <div class="main-img">
                    <img class="img-fluid" src="img/event-details-img.jpg" alt="">
                </div>
                <div class="details-content">
                    <a href="#">
                        <h4>{{$event->name}}</h4>
                    </a>
                    <img src="{{asset($event->pic)}}" class="img img-responsive">
                    <p>
                        {{$event->description}}
                    </p>
                    
                </div>
                <div class="social-nav row no-gutters">
                    <div class="col-lg-6 col-md-6 ">
                        <ul class="focials">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6 navs">
                        <a href="#" class="nav-prev"><span class="lnr lnr-arrow-left"></span>Prev Event</a>
                        <a href="#" class="nav-next">Next Event<span class="lnr lnr-arrow-right"></span></a>									
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-4 event-details-right">
                <div class="single-event-details">
                    <h4>Details</h4>
                    <ul class="mt-10">
                        <li class="justify-content-between d-flex">
                            <span>Event date</span>
                            <span>{{date("jS  F Y ",strtotime($event->event_date))}}</span>
                        </li>
                        {{-- <li class="justify-content-between d-flex">
                            <span>End date</span>
                            <span>18th April, 2018</span>
                        </li>
                        <li class="justify-content-between d-flex">
                            <span>Ticket Price</span>
                            <span>Free of Cost</span>
                        </li>														 --}}
                    </ul>
                </div>
                {{-- <div class="single-event-details">
                    <h4>Venue</h4>
                    <ul class="mt-10">
                        <li class="justify-content-between d-flex">
                            <span>Place</span>
                            <span>Main Hallroom</span>
                        </li>
                        <li class="justify-content-between d-flex">
                            <span>Street</span>
                            <span>Bullevard Street</span>
                        </li>
                        <li class="justify-content-between d-flex">
                            <span>City</span>
                            <span>Santa Monica</span>
                        </li>														
                    </ul>
                </div>
                <div class="single-event-details">
                    <h4>Organiser</h4>
                    <ul class="mt-10">
                        <li class="justify-content-between d-flex">
                            <span>Company</span>
                            <span>Colorlib</span>
                        </li>
                        <li class="justify-content-between d-flex">
                            <span>Street</span>
                            <span>Bullevard Street</span>
                        </li>
                        <li class="justify-content-between d-flex">
                            <span>City</span>
                            <span>Santa Monica</span>
                        </li>														
                    </ul>
                </div>														 --}}
            </div>
        </div>
    </div>	
</section>
<!-- End event-details Area -->
@endsection