<div class="section-wrapper">
	<h3 id="featuredTitle">Popular Products</h3>
	<div class="home-grid">
		<div class="row featured-row">
			@foreach($boysProducts as $product)
				@if($loop->index < 2)
					<div class="col-md-3">
						@include('shop.product')
					 </div>
				@endif
			@endforeach

			@foreach($girlsProducts as $product)
				@if($loop->index < 2)
					<div class="col-md-3">
						@include('shop.product')
					</div>
				@endif
			@endforeach
		</div>
	</div>
</div>
