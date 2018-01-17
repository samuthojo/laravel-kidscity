<nav id="mainNav" class="fixed">
    <div class="section-wrapper layout center justified">
        <div class="layout center">
            <a href="{{url('/')}}" id="logo" style="margin-right: 12px">
                <img src="{{asset('images/logo.png')}}" alt="" style="height: 40px;">
            </a>

            <div id="navLinks" class="layout center justified">
                @yield('nav_items')
            </div>
        </div>

        <div class="flex layout center-center">
            <div id="searchBar" class="layout flex center">
                <i class="fa fa-search"></i>
                <input type="search" placeholder="Type to search">
                <!-- <button>GO</button> -->
            </div>
        </div>

        @include('nav.right_nav')
    </div>
</nav>
