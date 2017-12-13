
	@include('header')

	@include('nav.common_nav')

	{{-- ... SITE SUB SECTIONS --}}
	@include('home.banner')
	@include('home.card_ctas')
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

	@include('footer')
