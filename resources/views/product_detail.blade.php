@extends('layouts.app')

@section('styles')
    <link href="{{asset('css/product_detail.css')}}" rel="stylesheet">
@endsection

@section('page-title')
    {{$product->name}}
@endsection

@section('content')
    <div class="main-wrapper for-lg">
        @include('product_detail.index')
    </div>
@endsection

@section('scripts')
    @include('scripts')

    <script>
        var medias = document.getElementById("productMedia");

        $(".image-option").on("click", function(){
            var src = $(this).data('image');
            $(".image-option.active").removeClass('active');
            $(this).addClass('active');
            $("#bigPicture").attr('src', src);
        });

        function switchMediaTab(state){
            if(state){
                medias.classList.add("show-video");
            }else{
                medias.classList.remove("show-video");
            }
        }
    </script>
@endsection