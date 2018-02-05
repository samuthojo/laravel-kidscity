<div id="appBar" class="for-mob">
    <div id="mainActionBar" class="an-action-bar layout center justified">
        @if(isset($back))
            <a id="mainLogo" href="{{ URL::previous() }}" class="layout center action-bar-title">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>

                @yield('page-title')
            </a>
        @else
            <a id="mainLogo" href="javascript:void(0);" class="layout center action-bar-title">
                <img src="{{asset('images/logo.png')}}" alt="">
                @yield('page-title')
            </a>
        @endif

        <div id="optionsMenu" class="options-menu">
            @yield('appbar-menu')

            <a href="tel:+255715938686" id="phoneBtn" class="action-button has-ripple">
                <svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                </svg>
            </a>

            <a href="mailto:TotoJunctionTZ@gmail.com" id="mailBtn" class="action-button has-ripple">
                <svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </a>
            &nbsp;
        </div>
    </div>

    @yield('appbar-content')
</div>