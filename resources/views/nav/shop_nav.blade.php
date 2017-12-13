<nav id="mainNav" class="fixed">
    <div class="section-wrapper layout center justified">
        <div class="layout center">
            <a href="{{url('/')}}" id="logo" style="margin-right: 12px">
                <img src="{{asset('images/logo.png')}}" alt="" style="height: 40px;">
            </a>

            <div id="navLinks" class="layout center justified">
                <a href="{{url('/')}}">HOME</a>
            </div>
        </div>

        <div class="flex layout center-center">
            <div id="searchBar" class="layout flex center">
                <i class="fa fa-search"></i>
                <input type="search" placeholder="Type to search">
                <!-- <button>GO</button> -->
            </div>
        </div>

        <div id="navRightThings" class="layout center">
            <a id="loginLink" href="login.php" class="layout center">
                <i class="fa fa-user"></i>
                SIGN IN
            </a>

            <a href="cart.php" id="miniCartToggle" class="layout center">
                <i class="fa fa-shopping-basket"></i>
                4 ITEM(S)
            </a>
        </div>
    </div>
</nav>
