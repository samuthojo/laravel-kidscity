
@extends('layouts.shopping')

	{{--$products = ["Boy Jeans", "Girl Fur Coat", "Awakii Uniforms"];--}}

@section('content')
<div class="main-wrapper">
	@include('cart.index');
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

    new ScrollMagic.Scene({
        triggerElement: '.main-wrapper',
        triggerHook: 0.1,
        duration: document.querySelector(".main-wrapper").offsetHeight - 490
    })
    .setPin("#checkoutArea")
    .addTo(controller);
</script>
@endsection
