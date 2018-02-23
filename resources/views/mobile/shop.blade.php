@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/shop.css')}}" rel="stylesheet">
	<script src="{{asset('js/lib/jquery.scrollTo-min.js')}}"></script>
@endsection

@section('page-title')
	Shop
@endsection

@section('above-appbar-content')
	@include('mobile.tpl.search_area')
@endsection

@section('appbar-menu')
	<button id="searchTrigger" class="action-button" onclick="startSearching()">
		<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</svg>
	</button>
@endsection

@section('appbar-content')
	<div id="cateGoryTabs" style="overflow-x: auto;">
		<div class="layout center">
			@php
				$all_categories_class =
                    ($selectedCategory == -1) ? 'active' : '';
			@endphp

			<a href="{{url('/mob/shop/')}}" class="product-category has-ripple ripple-light layout center-center {{$all_categories_class}}">
				All
			</a>

			@foreach(get_valid_cats() as $category)
				@php
					$category_class =
                        ($category->id == $selectedCategory) ? 'active' : '';
				@endphp

				<a id="prodCat{{$category->id}}" href="{{url('/mob/shop/?category='. $category->id)}}"
				   class="product-category has-ripple ripple-light layout center-center {{$category_class}}">
					{{$category->name}}
				</a>
			@endforeach

			@if($selectedCategory != -1)
				<script>
					document.getElementById('prodCat{{$selectedCategory}}').scrollIntoView(true);
				</script>
			@endif
		</div>
	</div>
@endsection

@section('content')
	@include('mobile.tpl.products_list')

	<script>
		function loadResults(val){
		    if(val && val.length > 2)
				$("#mobSearchArea").addClass('loading');
			else
                $("#mobSearchArea").removeClass('loading');
        }

        function startSearching(){
            document.body.classList.add("searching");
            $("#mainSiteContent").addClass("animating");

            setTimeout(function () {
                $("#mobSearchInput").focus();
            }, 350);
        }

        function stopSearching(){
            $("#mobSearchArea").removeClass('loading');
            $("#mobSearchArea").removeClass('found-results');
            $("#mobSearchInput").val("");

            document.body.classList.remove("searching");
            setTimeout(function () {
                $("#mainSiteContent").removeClass("animating");
            }, 600)
        }

        function clearSearchInput() {
            $("#mobSearchInput").val("").focus();
            loadResults("");
        }

        $(document).ready(function () {
            $(".product-category").click(function(e) {
                return;
                e.preventDefault();
                el = $(this);

                $(".product-category.active").removeClass("active");

                setTimeout(function(){
                    el.addClass("active");
				}, 100);

                $('#cateGoryTabs').scrollTo($(this));
                return false;
			});
        })
	</script>
@endsection