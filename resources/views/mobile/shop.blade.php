@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/shop.css')}}" rel="stylesheet">
	<script src="{{asset('js/lib/jquery.scrollTo-min.js')}}"></script>

    <style>
        *{
            /*transition: none !important;*/
        }

        .found-results #mobSearchBar {
            background: #fff;
            border-bottom: 1px solid #ddd;
        }

        .found-results #mobSearchBar #backBtn{
            background: #eee;
        }

        .found-results #mobSearchBar #backBtn svg,
        .found-results #mobSearchBar #searchClearer svg {
            fill: #333 !important;
        }

        .found-results #mobSearchBar input{
            color: #333;
        }

        .found-results #mobSearchResults{
            background-color: #fff;
            color: #676767;
        }
    </style>
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
        var current = window.location.href;
        var url = window.location.hash;
        var search_query = url.match(/#(.*)$/);
        var search_listener = null;
        var actual_query;
        var query_submitted = false;

        if (search_query && search_query[1].indexOf('/search/') !== -1) {
            var q = search_query[1].split('/search/')[1];
            actual_query = q.replace(/%20/g, ' ');
            console.log("Searching on!!", actual_query);

            turnOnSearching(actual_query);
            search(actual_query);
        }

        function search(query) {
            window.location.href = current.match(/#(.*)$/) ? current.replace(/#(.*)$/, '#/search/'+query) : current + "#/search/" + query;

            if(search_listener === null)
                listen();

            if($("#mobSearchInput").val().toLowerCase() !== query.toLowerCase())
                $("#mobSearchInput").val(query).focus();
        }

        function getCurrent() {
            return window.location.hash;
        }

        function listen() {
            var current = getCurrent();
            var turn_off = false;

            if (current !== url) {
                console.log('URL changed to ' + current);
                url = current;
                search_query = url.match(/#(.*)$/);

                if (search_query && search_query[1].indexOf('/search/') !== -1) {
                    var q = search_query[1].split('/search/')[1];
                    actual_query = q.replace(/%20/g, ' ');
                    turnOnSearching(actual_query);
                    console.log(actual_query);

//                    if(actual_query.length < 1){
                        $("#mobSearchArea").removeClass('found-results');
                        document.getElementById("themeTag").setAttribute("content", "#f38536");
                        $("#theResults").html("");
//                    }
                }
                else {
                    console.log("Searching off!!");
                    turnOffSearching();

                    turn_off = true;
                }
            }

            if(!turn_off)
                search_listener = setTimeout(listen);
            else{
                clearTimeout(search_listener);
                search_listener = null;
            }
        }

		function queryChanged(val){
//            search(val);
            actual_query = val;

            if(query_submitted){
                cancelQuery();
                query_submitted = false;
            }
            console.log("Changed!!!");
            $("#mobSearchArea").removeClass('loading loaded-results found-results');
            document.getElementById("themeTag").setAttribute("content", "#f38536");
            $("#theResults").html("");
        }

        function startSearching(){
		    search("");
        }

        function turnOnSearching(query){
            document.body.classList.add("searching");
            $("#mainSiteContent").addClass("animating");

            setTimeout(function () {
                $("#mobSearchInput").focus();
            }, 350);
        }

        function turnOffSearching(){
            $("#mobSearchArea").removeClass('loading');
            $("#mobSearchArea").removeClass('found-results');
            $("#mobSearchInput").val("");

            document.body.classList.remove("searching");
            setTimeout(function () {
                $("#mainSiteContent").removeClass("animating");
            }, 600);
        }

        function stopSearching(){
            search("");
            $("#mobSearchArea").removeClass('loading loaded-results found-results');
            document.getElementById("themeTag").setAttribute("content", "#f38536");
            $("#theResults").html("");
        }

        function clearSearchInput() {
//            search("");
            $("#mobSearchInput").val("").focus();
            $("#mobSearchArea").removeClass('loading loaded-results found-results');
            document.getElementById("themeTag").setAttribute("content", "#f38536");
            $("#theResults").html("");
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

            $("#mobSearchBar").on("submit", function(e){
                e.preventDefault();
//                console.log("Search submitted!", actual_query);
                query_submitted = true;

                submitQuery();
            })
        });

        var fetch_timeout;

        function submitQuery(){
            $("#mobSearchInput").blur();

            if(actual_query && actual_query.length > 2)
                $("#mobSearchArea").addClass('loading');
            else
                $("#mobSearchArea").removeClass('loading');

            $("#theResults").html("");

            searchDb(actual_query, function(success, res){
                if(success){
                    console.log("Result from search...");
                    window.location.href = current.replace(/#(.*)$/, '') + '#/search/' + actual_query.trim().replace(/\s/g, '%20');
                    $("#mobSearchArea").addClass('loaded-results');
                    document.getElementById("themeTag").setAttribute("content", "#FFFFFF");

                    setTimeout(function(){
                        $("#mobSearchArea").removeClass('loading');
                        $("#mobSearchArea").removeClass('loaded-results');

                        $("#mobSearchArea").addClass('found-results');
                        $("#theResults").html(res);
                    }, 200);
                }else{
                    console.log("Error fetching resources!!!");
                }
            });
        }

        function cancelQuery(){
            console.log("Cancelling query!!!");
//            $("#mobSearchArea").removeClass('loading found-results');
//            clearTimeout(fetch_timeout);
        }

        function searchDb(query, callback){
            var url= window.Laravel.base_url + '/search?search=' + query;
//            $.get(url, callback);

            $.ajax({
                type		:'GET',
                url         :url,
                success     : function(res) {
                    callback(true, res);
                },
                error: function (err) {
                    console.log(err);
                    callback(false);
                }
            });
        }
	</script>
@endsection