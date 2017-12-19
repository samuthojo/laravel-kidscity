@extends('layouts.shopping')

@section('styles')
	<link href="{{asset('css/shop.css')}}" rel="stylesheet">
@endsection

@section('nav_items')
	<a href="{{url('/')}}">HOME</a>
@endsection

@section('content')
	<div class="main-wrapper">
		<div id="shopPage">
			<div class="section-wrapper">
				<div class="row">
					<div id="shopFilters" class="col-sm-3">
						@include('shop.aside_content')
					</div>
					<div id="shopContent" class="col-sm-9">
						@include('shop.main_content')
					</div>
				</div>
			</div>
		</div>

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
