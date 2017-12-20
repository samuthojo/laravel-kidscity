<div class="col-md-3">
	<a href="{{url('shop/brand/' . $brand->id)}}" class="product">
		<div class="image" style="background: #f5f5f5;">
			<img src="{{asset('images/brands/' . $brand->image_url)}}" alt="">
		</div>
		<h5 class="name">{{$brand->name}}</h5>
		<span class="price">{{$brand->product_count}} products</span>
		{{--<button class="btn accent">View Products</button>--}}
	</a>
</div>