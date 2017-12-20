<div class="filter-group">
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

<div class="filter-group">
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
			<a href="{{url('shop/category/' . $category->id)}}"
				class='{{"option " . $category_class}}'>
				{{$category->name}}
			</a>
		@endforeach
	</div>
</div>

<div class="filter-group">
	<div class="filter-title">
		<h3>Gender</h3>
	</div>
	<div class="filter-options">
		<div class="option-wrapper">
			<input type="checkbox" name="" id="group1" value="girls">
			<label for="group1" class="option">
				<i class="fa fa-home"></i>
				Girls
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox" name="" id="group2" value="boys">
			<label for="group2" class="option">
				<i class="fa fa-home"></i>
				Boys
			</label>
		</div>
	</div>
</div>


<div class="filter-group">
	<div class="filter-title">
		<h3>Color</h3>
	</div>
	<div class="filter-options">
		<div class="option-wrapper">
			<input type="checkbox" name="" id="flock1">
			<label for="flock1" class="option">
				<i class="fa fa-home"></i>
				Red
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox" name="" id="flock2">
			<label for="flock2" class="option">
				<i class="fa fa-home"></i>
				Green
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox" name="" id="flock3">
			<label for="flock3" class="option">
				<i class="fa fa-home"></i>
				Blue
			</label>
		</div>
	</div>
</div>
