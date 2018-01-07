@extends('layouts.app')

@section('styles')
	<link href="{{asset('css/home.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div class="page-wrapper">
		{{-- ... SITE SUB SECTIONS --}}
		@include('home.banner')
		@include('home.card_ctas')
		@include('home.category_ctas')
		@include('home.brand_ctas')
		@include('home.featured')
	</div>

	@include('scripts')
@endsection