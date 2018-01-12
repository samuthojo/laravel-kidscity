<a id="product-{{$product->id}}" href="{{url('/mob/products/' . $product->id)}}" class="layout a-product product {{ in_cart($product->id) ? 'added' : ''}}">
	<div class="image">
		<img src="{{$product->image()}}" alt="">
	</div>
	<div class="flex">
		<h5 class="name">{{$product->name}}</h5>
		<span class="price">
			<span>{{$product->present_price()}}</span>
		</span>
	</div>

	<span class="actions">
		@include('mobile.tpl.product_btn')
	</span>
</a>
