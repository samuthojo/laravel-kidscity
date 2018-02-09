<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- CSRF Token -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Buni,tanzania technology, innovation, girls in innovation">
    <meta name="description" content="Kids Ecommerce platform.">
    <meta name="author" content="iPF Softwares ">
    <meta charset="UTF-8">
    <link href="{{asset('fav.png')}}" rel="shortcut icon" type="image">
    <title>Kid City | {{isset($page) ? $page : "Home"}}</title>

    <!-- Styles -->
    <link href="{{asset('css/reset.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/flex.css')}}" rel="stylesheet">
    <link href="{{asset('css/flexboxgrid.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/styles.css')}}" rel="stylesheet">

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
    <script src="{{asset('js/lib/jquery-3.1.0.min.js')}}"></script>

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
</head>
<body>
    <div id="alertMessage" class="animated">
        <i class="fa fa-check-circle"></i>
        <span id="alertMessageText">
                Thankyou, we have received your message.
            </span>
    </div>

    @include('nav.shop_nav')

    @yield('content')

    <script>
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({
            triggerElement: '.main-wrapper',
            triggerHook: -25
        })
            .setClassToggle("#mainNav", "shadowed")
            .addTo(controller);
    </script>
@include('footer')
