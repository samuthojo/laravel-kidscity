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