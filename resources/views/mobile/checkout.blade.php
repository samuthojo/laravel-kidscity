@extends('mobile.layouts.no_shell')

@section('styles')
	<link href="{{asset('css/mobile/checkout.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div id="appBar" class="for-mob product-bar">
		<div id="mainActionBar" class="an-action-bar layout center" style="z-index: 1;">
			<a id="mainLogo" href="{{ URL::previous() }}" class="action-button has-ripple" style="margin-left: 12px;">
				<svg style="fill: #000 !important;" fill="#000000" height="28" viewBox="0 0 24 24" width="28" xmlns="http://www.w3.org/2000/svg">
					<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
					<path d="M0 0h24v24H0z" fill="none"/>
				</svg>
			</a>

			<span class="action-bar-title">
				Checkout Order
			</span>
		</div>
	</div>


	<form id="checkoutForm" action="{{route('checkout')}}" method="POST">
		{{csrf_field()}}

		<input type="text" required class="input" placeholder="Your Full Name" name="name" {{Auth::user() ? 'readonly' : ''}}
		value="{{Auth::user() ? Auth::user()->name : ''}}">

		<input type="text" required class="input" placeholder="Your Phone Number" name="phone_number"
			   {{Auth::user() ? 'readonly' : ''}}
			   value="{{Auth::user() ? Auth::user()->phone_number : ''}}">

		<select id="" required class="input" name="delivery_location_id">
			<option value="">Choose delivery Location</option>

			@foreach($locations as $location)
				<option value="{{$location->id}}">{{$location->location}}</option>
			@endforeach
		</select>

		<button type="submit" class="btn accent large block" style="text-transform: uppercase;">
			SUBMIT ORDER
		</button>
	</form>
@endsection