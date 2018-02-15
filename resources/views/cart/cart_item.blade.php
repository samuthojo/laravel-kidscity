<div id="product-{{$item->model->id}}" class="cart-item row">
	<div class="item-image col-md-1">
		<a href="{{url('products/' . $item->id)}}">
			<img src="{{asset($item->model->image())}}" alt="">
		</a>
	</div>
	<div class="layout flex center">
		<div class="item-name col-md">
			<a href="{{url('products/' . $item->id)}}">
				<h3>
					{{$item->name}}
				</h3>
			</a>
		</div>
		<div class="item-qty-bar item-qty layout center-center">
			<button onclick="changeCartItemQty('{{$item->model->id}}', false)" class="{{$item->qty < 2 ? 'disabled' : ''}}">
				<i class="fa fa-minus"></i>
			</button>
			<img src="{{asset('images/loader.gif')}}" alt="" class="loader" style="width: 30px; margin: 0 8px;">
			<input class="qty-input-area" type="text" value="{{$item->qty}}" readonly>
			<button onclick="changeCartItemQty('{{$item->model->id}}', true)">
				<i class="fa fa-plus"></i>
			</button>
		</div>
		<span style="padding: 0 32px;">
			@ {{$item->model->present_price()}}
		</span>

		<button class="btn" onclick="removeFromCart(event, '{{$item->model->id}}')">REMOVE</button>
	</div>
</div>
