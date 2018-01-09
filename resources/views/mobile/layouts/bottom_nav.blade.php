<div id="bottomNav" class="layout center justified">
    <a href="{{url('/')}}" class="flex layout center-center vertical {{$page == 'home' ? 'active' : ''}}">
        <i class="fa fa-home"></i>
        Home
    </a>

    <a href="{{url('/mob/shop')}}" class="flex layout center-center vertical {{$page == 'shop' ? 'active' : ''}}">
        <i class="fa fa-shopping-basket"></i>
        Shop
    </a>

    <a href="{{url('/mob/cart')}}" class="flex layout center-center vertical {{$page == 'cart' ? 'active' : ''}}">
        <i class="fa fa fa-shopping-cart"></i>
        Cart
    </a>

    <a href="{{url('/mob/profile')}}" class="flex layout center-center vertical {{$page == 'profile' ? 'active' : ''}}">
        <i class="fa fa-user"></i>
        Profile
    </a>
</div>