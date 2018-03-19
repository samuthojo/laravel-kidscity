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
			}
			#appBar{
				display: none;
			}
		</style>

		<div id="loginInfo" class="layout vertical end-justified">
			<div id="content">
				<h3>Login Required</h3>
				<p>
					To see your profile info, order history and other information.
				</p>

				<a href="{{url('/mob/login')}}" class="btn large block accent">
					LOGIN
				</a>
			</div>
		</div>

		<script>
            setTimeout(function () {
                console.log("Done after 400ms");
                document.querySelector("#loginInfo").classList.add("loaded");
            }, 400);
		</script>
	@else
		@php
			$user = Auth::user();
		@endphp

		<style>
			body{
				padding-top: 56px;
				background: #f8f8f8;
			}

			#appBar{
				box-shadow: none;
			}

			#profileTopBar{
				background: #fff2e9;
				background: #f38536;
				padding: 3em 1.5em;
			}

			#profileTopBar span{
				font-size: 1em;
				font-family: Futura, sans-serif;
			}

			#profileTopBar h3{
				font-size: 1.5em;
				margin-bottom: 0.4em;
			}

			#profileTopBar h5{
				font-size: 1em;
				margin-bottom: 1em;
			}

			#card{
				padding: 1.7em;
				padding-bottom: 0.6em;
				box-shadow: 1px 1px 0 rgba(0,0,0,0.1);
				margin-bottom: -7em;
				background: #fff;
			}

			#customerOrders{
				padding: 2em 1.5em;
				margin-top: 4em;
			}

			#customerOrders #ordersTitle{
				margin-bottom: 1.2em;
				padding-bottom: 0.8em;
				border-bottom: 1px solid #ddd;
			}

			#customerOrders #ordersTitle p{
				font-size: 1.2em;
				font-family: Futura, sans-serif;
			}

			.order-item h3{
				font-size: 1.2em;
			}
			.order-item h6{
				font-family: Futura, sans-serif;
				font-size: 1.3em;
				margin-bottom: 0.1em;
			}
			.order-item p{
				font-family: Futura, sans-serif;
			}
		</style>
		<div id="profileTopBar">
			<div id="card">
				<h5>PERSONAL DETAILS</h5>
				<span>FULL NAME:</span>
				<h3>{{$user->name}}</h3>
				<span>PHONE NUMBER:</span>
				<h3>{{$user->phone_number}}</h3>
			</div>
		</div>

		<div id="customerOrders">
			@if($user->orders()->count() < 1)
				<div style="text-align: center;">
					<br>
					<h5 style="padding: 0 1.3em;font-size: 1.3em; line-height: 1.3em">Hello there, it seems you haven't made any orders yet.
						</h5> <br>
					<a href="{{url('/mob/shop')}}" class="btn large accent">
						START SHOPPING
					</a>
				</div>
			@else

				<div id="ordersTitle">
					<h5>Past Orders</h5>
					<p>
						Here is your full order history.
					</p>
				</div>

				@foreach($user->orders as $order)
					<div class="order-item">
						<h3>{{$order->created_at}}</h3>
						<h6>Location: {{$order->delivery_location_id}}</h6>
						<p>Subtotal: 34, 0000/=</p>
					</div>
				@endforeach
			@endif
		</div>
	@endif
@endsection