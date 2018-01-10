<div id="appBar" class="for-mob">
    <div id="mainActionBar" class="layout center justified">
        @if(isset($back))
            <a id="mainLogo" href="{{ URL::previous() }}" class="layout center">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                @yield('page-title')
            </a>
        @else
            <a id="mainLogo" href="{{url('/')}}" class="layout center">
                <img src="{{asset('images/logo.png')}}" alt="">
                @yield('page-title')
            </a>
        @endif

        <div id="optionsMenu">
            @yield('appbar-menu')
        </div>
    </div>

    @yield('appbar-content')
</div>