<div id="topNav">
	<div class="section-wrapper layout justified center">
		<a id="mainLogo" href="{{url('/')}}">
	        <img src="{{asset('images/logo.png')}}" alt="">
	    </a>

		<div id="navAd" class="flex">
			<img src="{{asset('images/wide-ad.png')}}" alt="">
		</div>

		@include('nav.right_nav')
	</div>
</div>

<nav id="mainNav">
    <div class="section-wrapper layout center justified">
        <div id="navLinks" class="layout center justified">
            <a href="{{url('/shop')}}">CLOTHING &nbsp;<i class="fa fa-angle-down"></i> {{--girls, boys, by age--}}</a>
            <a href="{{url('/shop')}}">BABY PRODUCTS &nbsp;<i class="fa fa-angle-down"></i> {{--walker, car seats, high chairs, stroller, by age--}}</a>
            <a href="{{url('/shop')}}">SCHOOL ITEMS &nbsp; <i class="fa fa-angle-down"></i> {{--uniforms, bags, socks--}}</a>
            <a href="{{url('/shop')}}">SHOES &nbsp; <i class="fa fa-angle-down"></i> {{--running, sandals, slippers, fancy--}}</a>
            <a href="{{url('/shop')}}">TOYS & DOLLS &nbsp; <i class="fa fa-angle-down"></i> {{--toys, dolls--}}</a>
        </div>

        <div id="searchBar" class="layout center">
        	<i class="fa fa-search"></i>
        	<input type="search" placeholder="Search KidCity">
        	<button>GO</button>
        </div>
    </div>
</nav>
