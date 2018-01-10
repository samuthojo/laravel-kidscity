@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/shop.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Shop
@endsection

@section('appbar-menu')
	<button>
		<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</svg>
	</button>

	<button>
		<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 0h24v24H0z" fill="none"/>
			<path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
		</svg>
	</button>
@endsection

@section('appbar-content')
	<div id="cateGoryTabs" style="overflow-x: auto;">
		<div class="layout center">
			<a href="{{url('shop')}}" class="active layout center-center">All</a>

			@foreach($categories as $category)
				<a href="{{url('shop/?category='. $category->id)}}" class="layout center-center">{{$category->name}}</a>
			@endforeach
		</div>
	</div>
@endsection

@section('content')
	<div id="productsList">
		@foreach($products as $product)
			@include('mobile.tpl.product')
		@endforeach
	</div>
@endsection