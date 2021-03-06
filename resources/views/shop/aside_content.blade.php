<div class="filter-group" style="display: none;">
	<div class="filter-title">
		<h3>Brands</h3>
	</div>
	<div class="filter-options">
		@php
			$all_brands_class =
                ($selectedBrand == -1) ? 'active' : '';
		@endphp

		<div id="brandInput">
			<input type="text" value="All">
			<div id="brandOptions">
				<a href="{{url('shop/')}}" class="option {{$all_brands_class}}">
					All
				</a>

				@foreach($brands as $brand)
					@php
						$brand_class =
                            ($brand->id == $selectedBrand) ? 'active' : '';
					@endphp

					<a href="{{url('shop/brand/' . $brand->id)}}"
					   class='{{"option " . $brand_class}}'>
						{{$brand->name}}
					</a>
				@endforeach
			</div>
		</div>
	</div>
</div>

<div class="filter-group" style="display: {{$selectedCategory != -1 ? 'none' : ''}}">
	<div class="filter-title">
		<h3>Category</h3>
	</div>
	<div class="filter-options">
		@php
			$all_categories_class =
                ($selectedCategory == -1) ? 'active' : '';
		@endphp

		<a href="{{url('shop/')}}" class="option {{$all_categories_class}}">
			All
		</a>

		@foreach($categories as $category)
			@php
				$category_class =
					($category->id == $selectedCategory) ? 'active' : '';
			@endphp
			<a href="{{url('shop/?category=' . $category->id)}}"
				class='{{"option " . $category_class}}'>
				{{$category->name}}
			</a>
		@endforeach
	</div>
</div>

@if(!is_null($sub_categories) && count($sub_categories) > 0)
	<div class="filter-group">
		<div class="filter-title">
			<h3>Sub Categories</h3>
		</div>
		<div class="filter-options">
			@php
				$all_sub_categories_class =
                    ($selectedSubCategory == -1) ? 'active' : '';
			@endphp

			<a href="{{url('shop/?category=' . $selectedCategory )}}" class="option {{$all_sub_categories_class}}">
				All
			</a>

			@foreach($sub_categories as $sub_category)
				@php
					$sub_category_class =
                        ($sub_category->id == $selectedSubCategory) ? 'active' : '';
				@endphp

				<a href="{{url('shop/?category=' . $selectedCategory . "&sub_category=" . $sub_category->id)}}"
				   class='{{"option " . $sub_category_class}}'>
					{{$sub_category->name}}
				</a>
			@endforeach
		</div>
	</div>
@endif


<div class="filter-group">
	<div class="filter-title">
		<h3>Age Range</h3>
	</div>
	<div class="filter-options age-filters">
		@foreach($age_ranges as $range)
			<div class="option-wrapper">
				<input type="checkbox" data-filter-what="age" class="filter-input" name="ageRange" id="ageRange{{$range->id}}" value="{{$range->id}}">
				<label for="ageRange{{$range->id}}" class="option">
					<i class="fa fa-home"></i>
					{{$range->range}}
				</label>
			</div>
		@endforeach
	</div>
</div>

<div class="filter-group">
	<div class="filter-title">
		<h3>Gender</h3>
	</div>
	<div class="filter-options">
		<div class="option-wrapper">
			<input type="checkbox" data-filter-what="gender" class="filter-input" name="gender" id="gender1" value="1">
			<label for="gender1" class="option">
				<i class="fa"></i>
				Girls
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox"  data-filter-what="gender" class="filter-input" name="gender" id="gender0" value="0">
			<label for="gender0" class="option">
				<i class="fa"></i>
				Boys
			</label>
		</div>
	</div>
</div>