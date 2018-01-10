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
				transition: all 0.2s ease-out
			}

			#loginInfo:not(.loaded) #content h3,
			#loginInfo:not(.loaded) #content p,
			#loginInfo:not(.loaded) #content .btn{
				transform: translateY(20%);
				opacity: 0;
				transition: all 0.35s ease-out 1s;
			}

			#loginInfo:not(.loaded) #content:before{
				opacity: 0;
				transform: translateY(20%);
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
			}

			#loginInfo #content .btn{
				text-transform: uppercase;
				font-size: 20px;
				height: 50px;
				line-height: 50px;
			}
		</style>
		
		<div id="loginInfo" class="layout vertical end-justified">
			<div id="content">
				<h3>Login Required</h3>
				<p>
					To see your profile info, order history and other information.
				</p>

				<a href="{{url('/login')}}" class="btn large block accent">
					LOGIN
				</a>
			</div>
		</div>
	@endif

	<script>
		window.onload = function () {
            setTimeout(function () {
                console.log("Done after 400ms");
                document.querySelector("#loginInfo").classList.add("loaded");
            }, 400);
        }
	</script>
@endsection