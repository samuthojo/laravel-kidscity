<div id="actionBar" class="layout justified center">
	<div id="productsTitle">
		<h3>
			@if($selectedCategory != -1)
				{{$selectedCategoryName}}
				@if($selectedSubCategory != -1)
					({{$selectedSubCategoryName}})
				@endif
			@endif

			@if($selectedBrand != -1)
				{{$selectedBrandName}}
			@endif

			@if(request('search'))
				Showing results for "{{request('search')}}"		
			@elseif($selectedCategory == -1 && $selectedBrand == -1)
				All products
			@endif
		</h3>
		@if(count($products) > 0)
			<span>Showing products 1 - 9 of {{count($products)}}</span>
		@endif
	</div>

	<div id="sorter" class="layout center">
		<span>sort by: </span>
		&emsp;
		<select id="sorterInput" onchange="sortProducts(this.value)">
			<option value="new">New Arrivals</option>
			{{--<option value="popular">Most Popular</option>--}}
			<option value="price">Price</option>
		</select>
	</div>
</div>
<style>
	#productsGrid.is-empty #filterEmpty{
		display: block !important;
	}

	#productsGrid.is-empty #filterEmptyMain ~ #filterEmpty{
		display: none !important;
	}
</style>
<div id="productsGrid">
	<p id="filterEmptyMain" style="display: {{count($products) > 0 ? 'none' : ''}};">
		No products found for
		@if($selectedCategory != -1)
			{{$selectedCategoryName}}
			@if($selectedSubCategory != -1)
				({{$selectedSubCategoryName}})
			@endif
		@endif
		{{$selectedBrandName}}.
	</p>
	<div class="row">

		@foreach ($products as $product)
				<div class="col-md-4 product-item"
					 data-age="{{$product->product_age_range_id}}" data-gender="{{$product->gender}}"
					 data-date="{{$product->id}}" data-price="{{$product->price}}">
					@include('shop.product')
				</div>
		@endforeach

	</div>

	<p id="filterEmpty" style="display: none;">
		No products found, please change filter options.
	</p>
</div>
