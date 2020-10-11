<html>
  <head>
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
<body id="LoginForm">
<div class="container">
  <div class="login-form">
    <div class="main-div">
      <div class="panel">
       <h4>Forgot your password?</h4>
       <p>Enter your email address and we will send you instructions on how to reset your password.</p>
       @if (session('status'))
       <div class="alert alert-success" role="alert">
           {{ session('status') }}
       </div>
   @endif
       @include('msg.msg')
      </div>
      <form method="POST" action="{{ route('teacherpassword.reset')}}">
        @csrf
        <div class="form-group">
            <label for="inputEmail">Enter email address</label>
            <input id="inputEmail" type="email" class="form-control" placeholder="Email address" name="email" value="{{old('email')}}" autofocus required="required">
         @if ($errors->has('email'))
             <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
             </span>
         @endif         
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Reset Password</button>
      </form>
       
    </div>
  </div>
</div>
</body>
</html>
