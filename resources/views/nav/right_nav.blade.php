
<div id="navRightThings" class="layout center">
    <a href="{{url('/cart')}}" id="miniCartToggle" class="layout center">
        <i class="fa fa-shopping-basket"></i>
        <span class="count">{{Cart::count()}}</span>&nbsp; ITEM(S)
    </a>

    @guest()
    <a id="loginLink" href="{{url('/login')}}" class="layout center">
        <i class="fa fa-user"></i>
        SIGN IN
    </a>
    @else
        <a id="userLink" class="layout center" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
            SIGN OUT
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endguest
</div>