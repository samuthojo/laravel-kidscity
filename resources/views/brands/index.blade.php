@extends('layouts.shopping')

@section('styles')
	<link href="{{asset('css/brands.css')}}" rel="stylesheet">
@endsection

@section('nav_items')
	<a href="{{url('/shop')}}">HOME</a>
@endsection

@section('content')
	<div class="main-wrapper">
		<div id="brandsPage">
			<div class="section-wrapper">
				<div class="row">
					@foreach ($brands as $brand)
						@include('brands.brand')
					@endforeach
				</div>
			</div>
		</div>

		@include('scripts')
	</div>
@endsection
