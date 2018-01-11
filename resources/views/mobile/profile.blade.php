@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/profile.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Profile
@endsection

@section('content')
	@if(Auth::guest())
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
        setTimeout(function () {
            console.log("Done after 400ms");
            document.querySelector("#loginInfo").classList.add("loaded");
        }, 400);
	</script>
@endsection