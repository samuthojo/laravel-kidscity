@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/home.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	KidCity
@endsection

@section('content')
	<div id="banner">
		<div class="title scrim" style="background-image: url({{url('images/kidstar.jpg')}});">
			<div class="layout vertical center-center fill">
				<h1>
					WE HAVE PRODUCTS <br>
					FOR YOUR KIDS
				</h1>
				<a class="btn med accent" href="{{url('/mob/shop')}}">
					START SHOPPING
				</a>
			</div>
		</div>
	</div>

	@if(count($clothes) > 0)
		<div class="featured-section">
			<div class="featured-title layout center justified">
				<h3>Kids Clothing</h3>
				<a href="{{url('/mob/shop/?category=1')}}" class="btn link accent">VIEW ALL</a>
			</div>

			<div class="row">
				@foreach($clothes as $product)
					@include('mobile.tpl.product_cell')
				@endforeach
			</div>
		</div>
	@endif

	@if(count($baby_products) > 0)
		<div class="featured-section">
			<div class="featured-title layout center justified">
				<h3>Baby Products</h3>
				<a href="{{url('/mob/shop/?category=2')}}" class="btn link accent">VIEW ALL</a>
			</div>

			<div class="row">
				@foreach($baby_products as $product)
					@include('mobile.tpl.product_cell')
				@endforeach
			</div>
		</div>
	@endif

	<div class="featured-cta">
		<div class="content">
			<div class="featured-title layout center justified">
				<h3>Poplar Products</h3>
				<a href="{{url('/mob/shop')}}" class="btn link accent">VIEW ALL</a>
			</div>

			<div class="layout">
				<div class="layout center-justified"
					 style="width: 40%; padding: 12px; flex-shrink: 0; perspective: 1000px;">
					<svg fill="#bdd1ff" height="94" width="94" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path d="M0 0h24v24H0z" fill="none"/>
						<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
					</svg>
				</div>
				@foreach($popular as $product)
                    <?php $featured = true; ?>
					@include('mobile.tpl.product_cell')
				@endforeach
			</div>
		</div>
	</div>

	@if(count($school_items) > 0)
		<div class="featured-section">
			<div class="featured-title layout center justified">
				<h3>Kids Clothing</h3>
				<a href="{{url('/mob/shop/?category=3')}}" class="btn link accent">VIEW ALL</a>
			</div>

			<div class="row">
				@foreach($school_items as $product)
					@include('mobile.tpl.product_cell')
				@endforeach
			</div>
		</div>
	@endif

	@if(Cart::count() > 0)
		<div class="featured-cta orange">
			<div class="content">
				<div class="featured-title layout center justified">
					<h3>In your cart</h3>
					<a href="{{url('/mob/cart')}}" class="btn link accent">VIEW CART</a>
				</div>

				<div class="layout">
					<div class="layout center-justified"
						 style="width: 40%; padding: 12px; flex-shrink: 0; perspective: 1000px;">
						<svg fill="#ecceb8" height="94" width="94" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
							<path d="M0 0h24v24H0z" fill="none"/>
						</svg>
					</div>
					@foreach(Cart::content() as $product)
						<?php $cart = true; ?>
						@include('mobile.tpl.product_cell')
					@endforeach
				</div>
			</div>
		</div>
	@endif
@endsection