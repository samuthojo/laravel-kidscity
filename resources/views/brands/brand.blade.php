<div class="col-md-3">
	<a href="{{url('shop/brand/' . $brand->id)}}" class="brand">
		<div class="image" style="background: #f5f5f5;">
			<img src="{{asset('images/brands/' . $brand->image_url)}}" alt="">
		</div>
		<h5 class="name">{{$brand->name}}</h5>
		@if($brand->product_count == 1)
			<span class="price">{{$brand->product_count}} product</span>
		@else
			<span class="price">{{$brand->product_count}} products</span>
		@endif
	</a>
</div>