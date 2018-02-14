<a href="{{url('products/' . $item->id)}}" id="product-{{$item->model->id}}" class="mini-cart-item row">
	<div class="image col-md-2">
		<img src="{{asset('images/real_cloths/' . $item->model->image_url)}}" alt="">
	</div>

	<div class="layout vertical flex">
		<h3>{{$item->name}}</h3>
		<span>
			@ {{$item->model->present_price()}}
		</span>
	</div>
</a>
