<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <link rel="manifest" href="{{asset('manifest.json')}}">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-color" content="#f38536">
    <meta name="keywords" content="Tanzania ecommerce, ecommerce, tanzania, kid ecommerce, kids shop, kids city">
    <meta name="description" content="Kids Ecommerce platform.">
    <meta name="author" content="iPF Softwares ">
    <meta charset="UTF-8">
    <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">
    <title>Kid City | {{isset($page) ? $page : "Home"}}</title>

    <!-- Styles -->
    <link href="{{asset('css/reset.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/flex.css')}}" rel="stylesheet">
    <link href="{{asset('css/flexboxgrid.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">

    <link href="{{asset('css/styles.css')}}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{asset('js/lib/jquery-3.1.0.min.js')}}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'base_url' => url('/')
        ]) !!};
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async defer="defer" src="https://www.googletagmanager.com/gtag/js?id=UA-70765388-8"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-70765388-8');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '260341067715329');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=260341067715329&ev=PageView
        &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <style>
        #alertMessage{
            position: fixed;
            top: 60px;
            right: 30px;
            padding: 16px 20px;
            border-radius: 3px;
            box-shadow: -2px 2px 12px rgba(0,0,0,0.3);
            background: #fefe03;
            color: #451f75;
            z-index: 99;
            max-width: 250px;
            line-height:23px;
            animation-duration: 0.35s;
        }

        #alertMessage i{
            display: inline-block;
            margin-right: 5px;
        }

        #alertMessage.slideOutUp{
            animation-duration: 0.05s;
        }

        #alertMessage:not(.slideInDown){
            opacity: 0;
            pointer-events: none;
        }
    </style>

    @yield('styles')
</head>
<body style="padding-top: 0;">
    <div id="alertMessage" class="animated">
        <i class="fa fa-check-circle"></i>
        <span id="alertMessageText">
            Thankyou, we have received your message.
        </span>
    </div>

    @include('nav.common_nav')

    @yield('content')

    <div id="bottomNav" class="for-mob layout center justified">
        <a href="{{url('/')}}" class="flex layout center-center vertical {{$page == 'home' ? 'active' : ''}}">
            <i class="fa fa-home"></i>
            Home
        </a>

        <a href="{{url('/shop')}}" class="flex layout center-center vertical {{$page == 'shop' ? 'active' : ''}}">
            <i class="fa fa-shopping-basket"></i>
            Shop
        </a>

        <a href="{{url('/cart')}}" class="flex layout center-center vertical {{$page == 'cart' ? 'active' : ''}}">
            <i class="fa fa fa-shopping-cart"></i>
            Cart
        </a>

        <a href="{{url('/profile')}}" class="flex layout center-center vertical {{$page == 'profile' ? 'active' : ''}}">
            <i class="fa fa-user"></i>
            Profile
        </a>
    </div>

    <div id="floatingShoppingCart">
        <div id="cartHeader" class="layout center justified">
            Shopping Cart

            <div class="layout center">
                <div id="cartCount" class="layou inline center-center">1</div>
                &nbsp;&nbsp;
                <button>
                    <i class="fa fa-angle-up"></i>
                </button>
            </div>
        </div>
        <div id="cartBody">

        </div>
        <div id="cartButtons" class="layout center end-justified">
            <button class="btn">VIEW CART</button>
            <button class="btn">CHECKOUT</button>
        </div>
    </div>

    @yield('scripts')

    @include('scripts')

    <script src="{{asset('js/scripts.js')}}"></script>

    <script>
        var alertMessage = document.getElementById("alertMessage");
        var alertMessageText = document.getElementById("alertMessageText");
        var alert_timeout = null;

        function showMessage(message){
            console.log(alert_timeout);
            if(alert_timeout !== null){
                closeMessage(message);
                return;
            }

            alertMessageText.innerText = message;
            alertMessage.classList.add("slideInDown");
            alert_timeout = setTimeout(function () {
                alertMessage.classList.add("slideOutUp");

                setTimeout(function (){
                    alertMessage.classList.remove("slideInDown");
                    alertMessage.classList.remove("slideOutUp");
                    alert_timeout = null;
                }, 300);
            }, 3200);
        }

        function closeMessage(message){
            clearTimeout(alert_timeout);
            alertMessage.classList.remove("slideInDown");
            alertMessage.classList.add("slideOutUp");

            if(message && message.length){
                setTimeout(function (){
                    alertMessage.classList.remove("slideOutUp");
                    alert_timeout = null;
                    showMessage(message);
                }, 100);
            }else{
                setTimeout(function (){
                    alertMessage.classList.remove("slideOutUp");
                    alert_timeout = null;
                }, 300);
            }
        }

        function enableScrollLocker() {
            var controller = new ScrollMagic.Controller();
            new ScrollMagic.Scene({
                triggerElement: '.page-wrapper',
                triggerHook: -1
            })
                .setClassToggle("#mainNav", "thin")
                .addTo(controller);
        }

//        if(window.innerWidth >= 680){
//            enableScrollLocker();
//        }
    </script>

    @include('footer')
</body>
</html>