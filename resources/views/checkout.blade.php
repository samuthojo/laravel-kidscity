@php
	$page = "shop";
@endphp

	@include('header');
	@include('nav.shop_nav');

@php
	if(!isset($_GET['category']))
		$category = 0;
	else
		$category = $_GET['category'];

	$categories = ["All", "Kids Wear", "School Uniforms", "Accessories"];
@endphp

<div class="main-wrapper">
		@include('shop.index');
		@include('scripts');
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

	@include('footer');
