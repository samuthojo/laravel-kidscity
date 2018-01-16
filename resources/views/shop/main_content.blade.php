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
		<select id="sorterInput">
			<option value="new">New Arrivals</option>
			<option value="popular">Most Popular</option>
			<option value="price">Price</option>
		</select>
	</div>
</div>
<div id="productsGrid">
	<p style="display: {{count($products) > 0 ? 'none' : ''}};">
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
				<div class="col-md-4">
					@include('shop.product')
				</div>
		@endforeach

	</div>
</div>
