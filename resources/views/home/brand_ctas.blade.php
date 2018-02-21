<div class="section-wrapper">
	<h3 id="featuredTitle">Top Brands</h3>
	<div class="home-grid">
		<div class="row featured-row featured-brand" style="flex-wrap: nowrap">
			@foreach($brands as $brand)
				@if($loop->index < 4)
					@include('brands.brand')
				@endif
			@endforeach
		</div>
	</div>
</div>
