<a id="product-{{$product->id}}" href="{{url('/mob/products/' . $product->id)}}" class="layout product {{ in_cart($product->id) ? 'added' : ''}}">
	<div class="image">
		<img src="{{asset('images/real_cloths/' . $product->image_url)}}" alt="">
	</div>
	<div class="flex">
		<h5 class="name">{{$product->name}}</h5>
		<span class="price">
			<span>{{$product->present_price()}}</span>
		</span>
	</div>

	<span class="actions">
		<button class="actionBtn has-ripple" onclick="addToCart(event, '{{$product->id}}', 1)">
			<span>
				@include('mobile.tpl.cart_icon')
				ADD
			</span>
			<span>LOADING</span>
			<span>IN CART</span>
		</button>
	</span>
</a>
