@extends('layouts.app')

@section('styles')
	<link href="{{asset('css/home.css')}}" rel="stylesheet">
@endsection

@section('content')
	{{-- ... SITE SUB SECTIONS --}}
	@include('home.banner')
	@include('home.card_ctas')
	@include('home.category_ctas')
	@include('home.featured')

	@include('scripts')

	<script>
		var controller = new ScrollMagic.Controller();
	    new ScrollMagic.Scene({
	        triggerElement: '#sectionBanner',
	        triggerHook: -1
	    })
	    .setClassToggle("#mainNav", "thin")
	    .addTo(controller);
	</script>
@endsection