@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/profile.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Profile
@endsection

@section('content')
	@if(Auth::guest())
		<style>
			body{
				padding-top: 0;
				background-position: -30px 0;
				background-image: url({{asset('../images/login-image.jpg')}});
			}
			
			#appBar, #bottomNav{
				display: none;
			}

			#loginInfo{
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
			}

			#loginInfo #content{
				position: relative;
				height: 100%;
				padding: 40px 30px;
				color: #fff;
			}

			#loginInfo:before{
				content: "";
				position: absolute;
				left: 0;
				bottom: 0;
				height: 100vh;
				width: 100%;
				background: rgba(0,0,0,0.5);
				z-index: 0;
			}

			#loginInfo #content h1{
				font-family: "PT Bold", sans-serif;
				font-size: 2.1em;
				margin-top: 0.8em;
				margin-bottom: 0.8em;
			}

			#loginInfo #content p{
				font-family: Futura, sans-serif;
				font-size: 1.4em;
				line-height: 1.2em;
				margin-bottom: 28px;
				text-align: center;
			}

			#loginInfo #content input{
				width: 100%;
				margin-bottom: 8px;
			}

			#loginInfo #content .btn{
				text-transform: uppercase;
				font-size:18px;
				height: 50px;
				line-height: 50px;
			}

			.input-group i{
				display: inline-block;
				margin-right: 0.2em;
				margin-top: -0.2em;
				font-size: 1.4em;
				min-width: 1.2em;
			}
		</style>
		
		<div id="loginInfo">
			<div id="content" class="layout vertical center-center">
				<img src="{{asset('images/logo.png')}}" alt="" height="80px">
				<h1>Kid City Login</h1>

				<form action="{{ route('register') }}" id="form" method="POST">
					{{ csrf_field() }}

					<label>FULL NAME</label>
					<input type="text" class="input" placeholder="Enter your name"
						   name="name" value="{{old('name')}}" autofocus>

					<label>PHONE NUMBER</label>
					<input type="phone" class="input" placeholder="Enter phone number"
						   name="phone_number" value="{{old('phone_number')}}">

					<label>PASSWORD</label>
					<input type="password" class="input" placeholder="Your Password"
						   name="password">

					<label>CONFIRM PASSWORD</label>
					<input type="password" class="input" placeholder="Confirm Password"
						   name="password_confirmation">

					<button class="btn block large">
						SUBMIT
					</button>
					<br><br><br><br>
				</form>
			</div>
		</div>
	@endif
@endsection