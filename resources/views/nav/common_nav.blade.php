<div id="topNav" class="for-lg {{(isset($page) && $page == "home") ? '' : 'mini'}}">
	<div class="section-wrapper layout justified center">
		<a id="mainLogo" href="{{url('/')}}">
	        <img src="{{asset('images/logo.png')}}" alt="">
	    </a>

		<div id="navAd" class="flex">
			<img src="{{asset('images/wide-ad.png')}}" alt="">
		</div>

		@include('nav.right_nav')
	</div>
</div>

<nav id="mainNav" class="for-lg">
    <div class="section-wrapper layout center justified">
        <div id="navLinks" class="layout center justified">
            <?php
                $category_items = App\Category::with('subCategories')->get();
            ?>

            @foreach($category_items as $item)
                <div class="dropdown-menu">
                    <a href="{{url('/shop/?category=' . $item->id)}}">{{$item->name}}
                        @if(count($item->subCategories) > 0)
                            &nbsp;<i class="fa fa-angle-down"></i>
                        @endif
                    </a>

                    @if(count($item->subCategories) > 0)
                        <div class="dropdown">
                            @foreach($item->subCategories as $sub)
                                <a href="{{url('/shop/?category=' . $item->id . "&sub_category=") . $sub->id}}">
                                    {{$sub->name}}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <form id="searchBar" class="layout flex center"
					action="{{ route('search') }}">
        	<i class="fa fa-search"></i>
					@if(request('search'))
	        	<input name="search" type="search" placeholder="Search KidCity"
							value=" {{ request('search') }} ">
	        	<button>GO</button>
					@else
						<input name="search" type="search" placeholder="Search KidCity">
					@endif
        </form>
    </div>
</nav>

<div id="mainNavPlaceHolder" class="for-lg"></div>

<div id="appBar" class="for-mob">
    <div id="mainActionBar" class="layout center justified">
        @if(isset($back))
            <a id="mainLogo" href="{{ URL::previous() }}" class="layout center">
                <i class="fa fa-arrow-left" style="width: 24px; margin-right: 8px;"></i>
                @yield('page-title')
            </a>
        @else
            <a id="mainLogo" href="{{url('/')}}" class="layout center">
                <img src="{{asset('images/logo.png')}}" alt="">
                @yield('page-title')
            </a>
        @endif

        <div id="optionsMenu">
            <button><i class="fa fa-search"></i></button>
            <button><i class="fa fa-ellipsis-v"></i></button>
        </div>
    </div>

    @yield('appbar-content')
</div>
