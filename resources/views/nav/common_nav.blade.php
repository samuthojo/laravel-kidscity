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
            <a href="{{url('/shop')}}">SHOP</a>
            <a href="{{url('/brands')}}">BRANDS</a>
            <a href="#">CATEGORIES</a>
            <a href="#">BY GENDER</a>
            <a href="#">NEW ARRIVALS</a>
        </div>

        <div id="searchBar" class="layout center">
        	<i class="fa fa-search"></i>
        	<input type="search" placeholder="Search KidCity">
        	<button>GO</button>
        </div>
    </div>
</nav>
