<a href="{{url('shop/brand/' . $brand->id)}}"
   class="col-xs-6 col-sm-6 layout vertical brand a-product product-cell center">
	<div class="product-image layout center-center">
		<img src="{{asset('images/brands/' . $brand->image_url)}}" alt="">
	</div>
	<h3 class="name">{{$brand->name}}</h3>

	@if($brand->product_count == 1)
		<p class="price">{{$brand->product_count}} product</p>
	@else
		<p class="price">{{$brand->product_count}} products</p>
	@endif
</a>
