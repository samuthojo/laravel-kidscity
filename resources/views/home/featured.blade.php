<div class="section-wrapper">
	<h3 id="featuredTitle">Featured Products</h3>
	<div id="productsGrid">
		<div class="row featured-row">
			<div class="col-md-4">
				<div class="feature-section-title layout vertical end-justified">
					<div class="title-text">
						<h3>FOR BOYS</h3>
						<p>
							Wanna see your handsome champ look mighty fly? Okay then, let's do it.
						</p>
					</div>
				</div>
			</div>

			@foreach($boysProducts as $product)
				<div class="col-md-4">
					@include('shop.product')
				 </div>
			@endforeach
		</div>

		<div class="row featured-row">
			<div class="col-md-4">
				<div class="feature-section-title layout vertical end-justified">

					<div class="title-text">
						<h3>FOR GIRLS</h3>
						<p>
							Wanna see your prettly little princess glitter? Well of course you do.
						</p>
					</div>
				</div>
			</div>

			@foreach($girlsProducts as $product)
				<div class="col-md-4">
					  @include('shop.product')
				</div>
			@endforeach
		</div>
	</div>
</div>
