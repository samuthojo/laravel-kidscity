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
			#appBar{
				display: none;
			}

			#loginInfo{
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 60px;
			}

			#loginInfo #content{
				position: relative;
				height: 100%;
				padding: 40px 30px;
				color: #fff;
			}

			#loginInfo #content:before{
				content: "";
				position: absolute;
				left: 0;
				bottom: 0;
				height: 100%;
				width: 100%;
				background: rgba(0,0,0,0.8);
			}

			#loginInfo #content h3{
				font-family: "PT Bold", sans-serif;
				font-size: 2.1em;
				margin-bottom: 12px;
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
		</style>
		
		<div id="loginInfo">
			<div id="content" class="layout vertical center-center">
				<h3>Login Required</h3>
				<p>
					To see your profile info, order history and other information.
				</p>

				<form action="{{ route('login') }}" id="form" method="POST">
					{{ csrf_field() }}

					<input type="text" class="input" placeholder="Enter phone number"
						   name="phone_number" value="{{old('phone_number')}}" autofocus>

					<input type="password" class="input" placeholder="Your Password"
						   name="password">
					<button class="btn block large accent">
						SUBMIT
					</button>
				</form>
			</div>
		</div>
	@endif
@endsection