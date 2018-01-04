
@extends('layouts.shopping')

@section('styles')
	<link href="{{asset('css/cart.css')}}" rel="stylesheet">
@endsection

@section('nav_items')
	<a href="{{url('/shop')}}">SHOP</a>
@endsection

@section('content')
	<div class="main-wrapper">
		<div id="cartPage">
			<div class="section-wrapper">
				<div class="row">
					<div id="cartItems" class="col-md-8">
						<h2>Cart Items</h2>
						@foreach($cart_items as $item)
							<?php
								$product = $item['item'];
								$quantity = $item['quantity'];
							?>

							@include('cart.cart_item')
						@endforeach
					</div>
					<div class="col-md-4">
						@include('cart.checkout_form')
					</div>
				</div>
			</div>
		</div>

		@include('scripts');
	</div>

	<script>
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({
            triggerElement: '.main-wrapper',
            triggerHook: -25
        })
            .setClassToggle("#mainNav", "shadowed")
            .addTo(controller);

        new ScrollMagic.Scene({
            triggerElement: '.main-wrapper',
            triggerHook: 0.1,
            duration: document.querySelector(".main-wrapper").offsetHeight - 490
        })
            .setPin("#checkoutArea")
            .addTo(controller);
	</script>
@endsection