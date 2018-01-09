@extends('layouts.app')

@section('styles')
	<link href="{{asset('css/home.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	KidCity
@endsection

@section('content')
	<div class="page-wrapper for-lg">
		{{-- ... SITE SUB SECTIONS --}}
		@include('home.banner')
		@include('home.card_ctas')
		@include('home.category_ctas')
		@include('home.brand_ctas')
		@include('home.featured')
	</div>

    @verbatim
	<script>
        // var CLIENT_ID = "949057dfe8594cccb08bb0c8f00d7ab1";
        // accessToken: '94764.1677ed0.c6256a27eddf41709ddf29af3469a4e5',
        // userId: 94764,

        var CLIENT_ID = "3fa87b3a894243cdb641147b2759913e";
        var feed = new Instafeed({
            get: 'user',
            // userId: 2281507809,
            userId: 365389321,
            limit: '4',
            resolution: 'standard_resolution',
            // target: 'instagram',
            // links: 'false',
            accessToken: '365389321.3fa87b3.12e7697c6c37422e9c072d013a1bc0e7',
            sortby: 'random',
            template: '<a href="{{link}}" target="_blank" comments="{{comments}}" likes="{{likes}}" class="image layout center-center"><img src="{{image}}" /></a>',
            after: function() {
                console.log("Insta Loading complete!");
                // $("#instafeed .temp").each(function () {
                //     $(this).remove();
                // })
                $(".image.temp").remove();
            }
        });

        window.onload = function() {
            // feed.run();
        };
	</script>
    @endverbatim
@endsection