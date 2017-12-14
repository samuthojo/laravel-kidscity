<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- CSRF Token -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Buni,tanzania technology, innovation, girls in innovation">
    <meta name="description" content="A platform that aims to bridge the gap in innovation for women.">
    <meta name="author" content="iPF Softwares ">
    <meta charset="UTF-8">
    <link href="{{asset('fav.png')}}" rel="shortcut icon" type="image">
    <title>Kid City | Login</title>

    <!-- Styles -->
    <link href="{{asset('css/reset.css')}}" rel="stylesheet">
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="{{asset('css/flex.css')}}" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
    <style>
      .alert-danger {
        background-color: #f44336;
        font-weight: bold;
        text-align: center;
        padding: 20px;
        color: #fff;
        z-index: 1;
        opacity: 0.85;
      }
    </style>
</head>
<body>
	<div id="loginWrapper">
		<aside class="light" style="background-image: url(images/login-image2.jpg); background-size: cover; background-position: top center;">
			<div id="text" class="layout vertical">
				<div id="navbar" class="layout center">
					<div id="loginLogo">
						<a href="{{url('/')}}">
							<img src="{{asset('images/logo.png')}}" alt="">
						</a>
					</div>

					<a href="{{url('/')}}">
						HOME
					</a>
				</div>
				<div class="flex"></div>
				<p style="display: none; margin: auto;font-size: 1.6em; padding: 24px 40px 20px 40px; font-family: PT Light; border-top: 1px solid #888;">
					Let your kid shine with us.
				</p>
			</div>
		</aside>
		<main>
			<div id="otherLink" class="layout center end-justified">
				<h3>Don't have an account yet?</h3>
				<a href="{{url('/register')}}" class="btn">
					Register
				</a>
			</div>
			<div id="formWrapper" class="layout vertical center-justified">

        @if ($errors->any())
          <div class="alert alert-danger" style="display: inline-block;">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

				<h3 id="pageTitle">
					Sign In to Kidcity
				</h3>

				<form action="{{ route('login') }}" id="form" method="POST">
          {{ csrf_field() }}

					<label>PHONE NUMBER</label>
					<input type="text" class="input" placeholder="Enter phone number"
            name="phone_number" value="{{old('phone_number')}}" autofocus>
					<label>PASSWORD</label>
					<input type="password" class="input" placeholder="Your Password"
            name="password">
					<button class="btn block large">
						SUBMIT
					</button>
				</form>
			</div>
		</main>
	</div>
</body>
</html>
