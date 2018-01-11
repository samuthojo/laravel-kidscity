@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/cart.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Your Cart
@endsection

@section('appbar-menu')
	{{--<button style="font-size: 14px; margin-right: 58px;">CHECKOUT</button>--}}
@endsection

@section('content')
	<div id="cartItems" class="{{Cart::count() < 1 ? 'is-empty' : ''}}">
		@foreach(Cart::content() as $item)
			@include('mobile.tpl.cart_item')
		@endforeach

		<div id="emptyMessage" class="layout vertical fill center-center">
			<img src="{{asset('images/empty-state/cart_orange_faded.png')}}" alt="">
			<h3>Your cart's empty</h3>
			<p>
				You have no items in your cart.
			</p>
			<a href="{{url('/mob/shop')}}" class="btn large">CONTINUE SHOPPING</a>
		</div>

		<div id="cartItemsSummary" class="layout center justified">
			<div >
				<h3>Total Cost</h3>
				<p id="cartSubTotal">
					{{--{{present_price(Cart::subtotal())}}--}}
					Tshs.<span class="amount">{{number_format(Cart::subtotal())}}</span>/=
				</p>
			</div>

			<button class="btn large">
				CHECKOUT
			</button>
		</div>
	</div>

	<script>
        $("body").addClass('has-cart-summary');
	</script>
@endsection