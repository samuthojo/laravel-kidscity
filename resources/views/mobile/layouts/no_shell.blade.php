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
    <meta name="description" content="A platform that aims to bridge the gap in innovation for women.">
    <meta name="author" content="iPF Softwares ">
    <meta charset="UTF-8">
    <link href="{{asset('images/fav.png')}}" rel="shortcut icon" type="image">
    <title>Kid City</title>

    <!-- Styles -->
    <link href="{{asset('css/mobile/styles.css')}}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{asset('js/lib/jquery-3.1.0.min.js')}}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'base_url' => url('/')
        ]) !!};
    </script>

    <style>
        #alertMessage{
            position: fixed;
            bottom: 60px;
            left: 0;
            right: 0;
            padding: 16px 20px;
            box-shadow: 0 -1px 4px rgba(0,0,0,0.05);
            background: #333;
            color: #fff;
            z-index: 98;
            line-height:23px;
            animation-duration: 0.35s;
        }

        #alertMessage i{
            display: inline-block;
            margin-right: 5px;
        }

        #alertMessage.slideOutDown{
            /*animation-duration: 0.05s;*/
        }

        #alertMessage:not(.slideInUp):not(.slideOutDown){
            opacity: 0;
            pointer-events: none;
        }

        body{
            padding-top: 0;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="alertMessage" class="animated">
        {{--<i class="fa fa-check-circle"></i>--}}
        <span id="alertMessageText">
            Thankyou, we got yo message.
        </span>
    </div>

    @yield('content')

    <script src="{{asset('js/mob-scripts.js')}}"></script>
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
            alertMessage.classList.add("slideInUp");
            alert_timeout = setTimeout(function () {
                alertMessage.classList.add("slideOutDown");

                setTimeout(function (){
                    alertMessage.classList.remove("slideInUp");
                    alertMessage.classList.remove("slideOutDown");
                    alert_timeout = null;
                }, 300);
            }, 3200);
        }

        function closeMessage(message){
            clearTimeout(alert_timeout);
            alertMessage.classList.remove("slideInUp");
            alertMessage.classList.add("slideOutDown");

            if(message && message.length){
                setTimeout(function (){
                    alertMessage.classList.remove("slideOutDown");
                    alert_timeout = null;
                    showMessage(message);
                }, 100);
            }else{
                setTimeout(function (){
                    alertMessage.classList.remove("slideOutDown");
                    alert_timeout = null;
                }, 300);
            }
        }
    </script>
</body>
</html>