@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/shop.css')}}" rel="stylesheet">
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
	<p>
		Shop page content......
	</p>
@endsection