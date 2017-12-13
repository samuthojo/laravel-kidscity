<a href="{{url('products/' . $product->id)}}" class="product">
	<div class="image">
		<img src="{{asset('images/real_cloths/' . $product->image_url)}}" alt="">
	</div>
	<h5 class="name">{{$product->name}}</h5>
	<span class="price">Tshs. {{number_format($product->price)}}/-</span>
	<button class="btn accent">Add to cart</button>
</a>
