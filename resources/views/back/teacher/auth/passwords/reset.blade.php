<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reset Your Password</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <style type="text/css">
    body#LoginForm{ background-color:grey; background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;
    display: flex;
    align-items: center;justify-content: center;}

    .form-heading { color:#fff; font-size:23px;}
    .panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
    .panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
    
    .main-div {
      background: #ffffff none repeat scroll 0 0;
      border-radius: 2px;
      margin: 10px auto 30px;
      padding: 50px 70px 70px 71px;
      width: 60%;
    }
    @media only screen and (max-width: 780px) {
      .main-div {
      width:90%;
    }
}
    
    .forgot a {
      color: #777777;
      font-size: 14px;
      text-decoration: underline;
    }
    
    .forgot {
      text-align: left; margin-bottom:30px;
    }
  </style>

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class=" main-div card card-login mx-auto mt-5">
        <div class="card-header">Reset Password</div>
        <div class="card-body">
        @if(Session::has('status'))	        
	        <div class="alert alert-success alert-dismissible">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            {{Session::get('status')}}
	        </div>
        @endif
          <form class="form-signin" role="form" method="POST" action="{{ route('teacherpasswordreset') }}">
              {{csrf_field()}}
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="login-wrap">
                  <div class="user-login-info">
                     <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                       <label for="email" class="control-label">E-Mail Address</label>       
                      <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                       @if ($errors->has('email'))
                           <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                           </span>
                       @endif
                     </div>  
                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                       @if ($errors->has('password'))
                           <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                     </div>
                     <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      
                        <label for="password-confirm" class="control-label">Confirm Password</label>    
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                     </div>
                  </div>
                
                  <button class="btn btn-block btn-secondary" type="submit">Reset Password</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <script src="{{asset('assets/private/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/private/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/private/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  </body>

</html>
