@extends('front.layouts.app')
@section('content')
<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">	
    <div class="overlay overlay-bg"></div>
    <div class="container">				
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Contact Us				
                </h1>	
                <p class="text-white link-nav"><a href="{{url('/')}}">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="{{url('contact')}}"> Contact Us</a></p>
            </div>	
        </div>
    </div>
</section>
<!-- End banner Area -->				  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>
            <div class="col-lg-4 d-flex flex-column address-wrap">
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-home"></span>
                    </div>
                    <div class="contact-details">
                        <h5>Binghamton, New York</h5>
                        <p>
                            4343 Hinkle Deegan Lake Road
                        </p>
                    </div>
                </div>
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>
                    <div class="contact-details">
                        <h5>00 (958) 9865 562</h5>
                        <p>Mon to Fri 9am to 6 pm</p>
                    </div>
                </div>
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-envelope"></span>
                    </div>
                    <div class="contact-details">
                        <h5>support@myschool.com</h5>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>														
            </div>
            <div class="col-lg-8">
                <form class="form-area contact-form text-right" id="myForm" action="" method="post">
                    <div class="row">	
                        <div class="col-lg-6 form-group">
                            <input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="text" id="fullname">
                        
                            <input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email" id="email">

                            <input name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'" class="common-input mb-20 form-control" required="" type="text" id="subject">
                        </div>
                        <div class="col-lg-6 form-group">
                            <textarea class="common-textarea form-control" name="message" placeholder="Enter Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Messege'" required="" id="message"></textarea>				
                        </div>
                        <div class="col-lg-12">
                            <div class="alert-msg" style="text-align: left;" id="msg"></div>
                            <button class="genric-btn primary" style="float: right;" id="submit">Send Message</button>											
                        </div>
                    </div>
                </form>	
            </div>
        </div>
    </div>	
</section>
<!-- End contact-page Area -->
@endsection
@section('extra-js')
<script>
	$(function() {
	  //console.log( "ready!" );
  
	$('#submit').click(function() {
	 // $('#search_result').show();
	//console.log( "Handler for  called." );
    $('#submit').prop('disabled','true');
	$('#msg').empty();
	function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

	if( $.trim($('#email').val()).length==0 || $.trim($('#fullname').val()).length==0 || $.trim($('#subject').val()).length==0 || $.trim($('#message').val()).length==0 || !isEmail($('#email').val())){
	  
	  $('#msg').append("<p style='color:red;font-size:20px;margin:10px 2px;'>Plese fill the form properly</p>");
	  
	  if( !isEmail($('#email').val()) ){
	  $('#msg').append("<p style='color:red;font-size:20px;margin:10px 2px;'>Plese enter a valid email</p>");
	}
	}
	else{
	  var url="{{ route('savemsg') }}";
	  var name=$('#fullname').val();
	  var email=$('#email').val();
	  var subject=$('#subject').val();
	  var message=$('#message').val();
	  //alert('search');
	  $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': '{{ csrf_token() }}'
}
});
	  $.ajax({
	  type: 'POST',
	  url: url,
	  data: {
		name:name,
			email:email,
			subject:subject,
			message:message
	   },
	  cache: false, 
	  success: function(response){ 
	  //console.log(response);
	  $('input').val('');
	  $('textarea').val('');
	  if(response.data=='success'){
		$('#msg').append("<p style='color:blue;font-size:20px;margin:10px 2px;'>Message Sent Successfully</p>");
	  $("button").prop("disabled",true);
}
	 else{
	  $('#msg').append("<p style='color:red;font-size:20px;margin:10px 2px;'>Your message could not be sent we are working to fix that soon.</p>");
	 }
		
	
	  },
      error:function(error){ 
          console.error(error);
      },
	  dataType: 'json'
	  
  });
  
	}
  
  });
	   
	});
  </script> 
@endsection
@section('extra-css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection