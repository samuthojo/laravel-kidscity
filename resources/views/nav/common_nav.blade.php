<div id="topNav">
	<div class="section-wrapper layout justified center">
		<a id="mainLogo" href="{{url('/')}}">
	        <img src="{{asset('images/logo.png')}}" alt="">
	    </a>

		<div id="navAd" class="flex">
			<img src="{{asset('images/wide-ad.png')}}" alt="">
		</div>

	    <div id="navRightThings" class="layout center">
	    	<a id="loginLink" href="{{url('/login')}}" class="layout center">
	    		<i class="fa fa-user"></i>
	    		SIGN IN
	    	</a>

	    	<a href="{{url('/cart')}}" id="miniCartToggle" class="layout center">
	    		<i class="fa fa-shopping-basket"></i>
	    		4 ITEM(S)
	    	</a>
	    </div>
	</div>
</div>

<nav id="mainNav">
    <div class="section-wrapper layout center justified">
        <div id="navLinks" class="layout center justified">
            <a href="{{url('/shop')}}">SHOP</a>
            <a href="#">BRANDS</a>
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
