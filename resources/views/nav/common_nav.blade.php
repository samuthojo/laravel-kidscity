<div id="topNav" class="for-lg {{(isset($page) && $page == "home") ? '' : 'mini'}}">
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

<nav id="mainNav" class="for-lg">
    <div class="section-wrapper layout center justified">
        <div id="navLinks" class="layout center justified">
            <div class="dropdown-menu">
                <a href="{{url('/shop')}}">CLOTHING &nbsp;<i class="fa fa-angle-down"></i></a>
                <div class="dropdown">
                    <a href="{{url('/shop')}}">Girls</a>
                    <a href="{{url('/shop')}}">Boys</a>
                </div>
            </div>

            <div class="dropdown-menu">
                <a href="{{url('/shop')}}">BABY PRODUCTS &nbsp;<i class="fa fa-angle-down"></i></a>
                <div class="dropdown">
                    <a href="{{url('/shop')}}">Walkers</a>
                    <a href="{{url('/shop')}}">Car Seats</a>
                    <a href="{{url('/shop')}}">High Chairs</a>
                    <a href="{{url('/shop')}}">Strollers</a>
                </div>
            </div>

            <div class="dropdown-menu">
                <a href="{{url('/shop')}}">SCHOOL ITEMS &nbsp; <i class="fa fa-angle-down"></i></a>
                <div class="dropdown">
                    <a href="{{url('/shop')}}">Uniforms</a>
                    <a href="{{url('/shop')}}">Bags</a>
                    <a href="{{url('/shop')}}">Socks</a>
                </div>
            </div>

            <div class="dropdown-menu">
                <a href="{{url('/shop')}}">SHOES &nbsp; <i class="fa fa-angle-down"></i></a>
                <div class="dropdown">
                    <a href="{{url('/shop')}}">Running</a>
                    <a href="{{url('/shop')}}">Sandals</a>
                    <a href="{{url('/shop')}}">Slippers</a>
                    <a href="{{url('/shop')}}">Fancy</a>
                </div>
            </div>

            <div class="dropdown-menu">
                <a href="{{url('/shop')}}">TOYS & DOLLS &nbsp; <i class="fa fa-angle-down"></i></a>
                <div class="dropdown">
                    <a href="{{url('/shop')}}">Toys</a>
                    <a href="{{url('/shop')}}">Dolls</a>
                </div>
            </div>
        </div>

        <div id="searchBar" class="layout flex center">
        	<i class="fa fa-search"></i>
        	<input type="search" placeholder="Search KidCity">
        	<button>GO</button>
        </div>
    </div>
</nav>

<div id="mainNavPlaceHolder" class="for-lg"></div>

<div id="appBar" class="for-mob">
    <div id="mainActionBar" class="layout center justified">
        @if(isset($back))
            <a id="mainLogo" href="{{ URL::previous() }}" class="layout center">
                <i class="fa fa-arrow-left" style="width: 24px; margin-right: 8px;"></i>
                @yield('page-title')
            </a>
        @else
            <a id="mainLogo" href="{{url('/')}}" class="layout center">
                <img src="{{asset('images/logo.png')}}" alt="">
                @yield('page-title')
            </a>
        @endif

        <div id="optionsMenu">
            <button><i class="fa fa-search"></i></button>
            <button><i class="fa fa-ellipsis-v"></i></button>
        </div>
    </div>

    @yield('appbar-content')
</div>
