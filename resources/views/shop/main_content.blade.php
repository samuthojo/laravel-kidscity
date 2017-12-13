<div id="actionBar" class="layout justified center">
	<div id="productsTitle">
		<h3><?php echo $categories[$category]; ?></h3>
		<span>Showing products 1 - 12 of 30</span>
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
	<p style="display: none;">
		No products found.
	</p>
	<div class="row">

		@foreach ($products as $product)
				<div class="col-md-4">
					@include('shop.product')
				</div>
		@endforeach

	</div>
</div>
