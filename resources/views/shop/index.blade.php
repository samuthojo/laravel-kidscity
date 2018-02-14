@extends('layouts.app')

@section('styles')
	<link href="{{asset('css/shop.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Shop
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
	<div class="page-wrapper main-wrapper for-lg">
		<div id="shopPage">
			<div class="section-wrapper">
				<div class="row">
					<div id="shopFilters" class="col-sm-3">
						@include('shop.aside_content')
					</div>
					<div id="shopContent" class="col-sm-9">
						<shop-app :page-title="'{{$pageTitle}}'"
								  :initial-count={{(int) count($products)}}
								  :from-search="{{request('search') ? 'true' : 'false'}}"
								  :products="products"></shop-app>
{{--						@include('shop.main_content')--}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{asset('js/shop.js')}}"></script>
	<script>
		vue_app.setProducts({!! format_products($products) !!});

//        vue_app.$refs.floater.addItem(res.added_item, res.count, res.subtotal);
	</script>
@endsection