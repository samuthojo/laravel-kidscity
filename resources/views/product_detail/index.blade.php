<div id="productDetailPage">
	<div class="page-wrapper main-wrapper">
		<div class="row">
			<div id="productImage" class="col-md-4">
				<img src="{{asset('images/real_cloths/' . $product->image_url)}}" alt=""
				 height="600px">
			</div>
			<div id="productInfo" class="col-md col-md-offset-2">
				<h2>
					Product {{$product->id}}'s Brand name
				</h2>
				<span class="price">
					<span class="currency">Tshs.</span>
					<span class="number">
						{{number_format(round(rand(12000, 30000), -3))}}/-
					</span>
				</span>
				<div class="product-description">
					<h5>Description</h5>
					<p>
						{{$product->description}}
					</p>
				</div>

				<div class="tags-list">
					<p>Product tags</p>
					<span class="tag">Tag 1</span>
					<span class="tag">Tag 2</span>
					<span class="tag">Tag 3</span>
				</div>

				<span class="qty-title">
					Enter Quantity
				</span>
				<div class="layout center">
					<div class="qty-bar layout center">
						<button>
							<i class="fa fa-minus"></i>
						</button>
						<input type="text" value="1">
						<button>
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>

				<button id="addButton" class="btn accent large block">
					ADD TO CART
				</button>
			</div>
		</div>
	</div>
</div>
