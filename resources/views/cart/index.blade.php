@extends('layouts.app')

@section('styles')
	<link href="{{asset('css/cart.css')}}" rel="stylesheet">
@endsection

@section('nav_items')
	<a href="{{url('/shop')}}">SHOP</a>
@endsection

@section('content')
	<div class="page-wrapper main-wrapper">
		<div id="cartPage">
			<div class="section-wrapper">
				<div class="row">
					<div id="cartItems" class="col-md-8 {{Cart::count() < 1 ? 'is-empty' : ''}}">
						<h2>Cart Items</h2>
						@foreach(Cart::content() as $item)
							@include('cart.cart_item')
						@endforeach

						<p style="color: #999" class="empty-cart-message">There are no items in your cart.</p>

						<div id="cartItemsSummary">
							<div class="layout">
								<div class="flex"></div>
								<div>
									<h3>Total Price</h3>
									<p id="cartSubTotal">
										{{present_price(Cart::subtotal())}}
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						@include('cart.checkout_form')
					</div>
				</div>
			</div>
		</div>@include('scripts');
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