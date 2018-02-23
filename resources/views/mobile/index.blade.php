@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/home.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	KidCity
@endsection

@section('content')
	<div id="banner">
		<a href="{{url('/mob/shop')}}" class="title scrim" style="background-image: url({{App\MainBanner::current()->image()}});">
			<div class="layout vertical center-center fill" style="display: none;">
				<h1>
					YOUR VERY OWN <br>
					SUPERSTAR
				</h1>
				<a class="btn med accent" href="{{url('/mob/shop')}}">
					START SHOPPING
				</a>
			</div>
		</a>
	</div>

	@if(count($brands) > 0)
		<div class="featured-section">
			<div class="featured-title layout center justified">
				<h3>Top Brands</h3>
				<a href="{{url('/mob/brands/')}}" class="btn link accent">VIEW ALL</a>
			</div>

			<div class="row">
				@foreach($brands as $brand)
					@include('mobile.tpl.brand')
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

	@if(!is_null($categories))
		<div class="featured-section">
			@foreach($categories as $category)
				<div class="featured-title layout center justified">
					<h3>{{$category->name}}</h3>
					<a href="{{url('/mob/shop/?category='.$category->id)}}" class="btn link accent">VIEW ALL</a>
				</div>

				<div class="row">
					@if(!is_null($category))
						@foreach($category->products as $product)
							@if($loop->index < 4)
								@include('mobile.tpl.product_cell')
							@endif
						@endforeach
					@endif
				</div>
			@endforeach
		</div>
	@endif

	@if(Cart::count() > 0)
		<div class="featured-cta orange" style="margin-bottom: 0.3em;">
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