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

		<div id="emptyMessage" class="layout fill center-center">
			You have no items in your cart. <br>
			<a href="{{url('/shop')}}" class="btn large">GO SHOPPING</a>
		</div>

		<div id="cartItemsSummary" class="layout center">
			<div >
				<h3>Total Price</h3>
				<p id="cartSubTotal">
					{{present_price(Cart::subtotal())}}
				</p>
			</div>

			<button class="btn large">
				CHECKOUT
			</button>
		</div>
	</div>
@endsection