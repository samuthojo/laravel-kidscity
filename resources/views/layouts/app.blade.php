<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- CSRF Token -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Buni,tanzania technology, innovation, girls in innovation">
    <meta name="description" content="A platform that aims to bridge the gap in innovation for women.">
    <meta name="author" content="iPF Softwares ">
    <meta charset="UTF-8">
    <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">
    <title>Kid City</title>

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
        ]) !!};
    </script>

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

        <a href="{{url('/')}}" class="flex layout center-center vertical {{$page == 'profile' ? 'active' : ''}}">
            <i class="fa fa-user"></i>
            Profile
        </a>
    </div>

    @include('scripts')

    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
        var alertMessage = document.getElementById("alertMessage");
        var alertMessageText = document.getElementById("alertMessageText");

        function showMessage(message){
            alertMessageText.innerText = message;
            alertMessage.classList.add("slideInDown");
            setTimeout(function () {
                alertMessage.classList.add("slideOutUp");

                setTimeout(function (){
                    alertMessage.classList.remove("slideInDown");
                    alertMessage.classList.remove("slideOutUp");
                }, 300);
            }, 3200);
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

        if(window.innerWidth >= 680){
            enableScrollLocker();
        }
    </script>
@include('footer')
