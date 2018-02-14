<div id="product-{{$product->id}}"
	 class="product {{ in_cart($product->id) ? 'added' : ''}}">
	<a href="{{url('products/' . $product->id)}}">
		<div class="image">
			<img src="{{asset($product->image())}}" alt="">
		</div>
		<h5 class="name">{{$product->name}}</h5>
		<span class="price">
			<span>{{$product->present_price()}}</span>
			<span>(In Cart)</span>
		</span>
	</a>

	<button class="btn accent add-btn" onclick="addToCart(event, '{{$product->id}}', 1)">
		Add to cart
	</button>

	<button class="btn danger remove-btn" onclick="removeFromCart(event, '{{$product->id}}')">
		remove
	</button>
</div>
