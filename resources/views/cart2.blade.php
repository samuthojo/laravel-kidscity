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

	// SITE SUB SECTIONS
	@include('shop.index');

	@include('scripts');

	@include('footer');
