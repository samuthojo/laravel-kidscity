<a id="product-{{$product->id}}" href="{{url('/mob/products/' . $product->id)}}"
   class="col-xs-6 col-sm-6 layout vertical a-product product-cell center {{ in_cart($product->id) ? 'added' : ''}}">
	<div class="product-image">
		@if(!isset($cart))
			<img src="{{$product->image()}}" alt="{{$product->name}}">
		@else
			<img src="{{$product->model->image()}}" alt="{{$product->name}}">
		@endif
	</div>
	<h3 class="name">{{$product->name}}</h3>

	@if(!isset($featured))
		<p class="price">
			{{present_price($product->price)}}
		</p>
		@include('mobile.tpl.product_btn')
	@endif
</a>
