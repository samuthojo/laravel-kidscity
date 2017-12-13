
	@extends('layouts.shopping')

	@section('content')
		<div class="main-wrapper">
			@include('shop.index')
			@include('scripts')
		</div>

		<script>
			var controller = new ScrollMagic.Controller();
		    new ScrollMagic.Scene({
		        triggerElement: '.main-wrapper',
		        triggerHook: -25
		    })
		    .setClassToggle("#mainNav", "shadowed")
		    .addTo(controller);
		</script>
	@endsection
