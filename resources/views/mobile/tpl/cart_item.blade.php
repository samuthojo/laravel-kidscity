<div id="product-{{$item->model->id}}" class="cart-item layout">
	<div class="item-image col-xs-2">
		<a href="{{url('/mob/products/' . $item->id)}}">
			<img src="{{asset('images/real_cloths/' . $item->model->image_url)}}" alt="" width="100%">
		</a>
	</div>
	<div class="col layout flex center">
		<div class="item-name col-md">
			<a href="{{url('/mob/products/' . $item->id)}}">
				<h3>
					{{$item->name}}
				</h3>
				<span class="price" style="padding: 12px 0; margin-top: 12px;">
					@ {{$item->model->present_price()}}
				</span>
			</a>
		</div>

		<span class="flex"></span>

		<button class="btn" style="background-color: #f5f5f5;" onclick="removeFromCart(event, '{{$item->model->id}}')">
			<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
				<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
				<path d="M0 0h24v24H0z" fill="none"/>
			</svg>
		</button>

		<div class="item-qty-bar item-qty layout center-center" style="display: none;">
			<button onclick="changeCartItemQty('{{$item->model->id}}', false)" class="{{$item->qty < 2 ? 'disabled' : ''}}">
				<i class="fa fa-minus"></i>
			</button>
			<img src="{{asset('images/loader.gif')}}" alt="" class="loader" style="width: 30px; margin: 0 8px;">
			<input class="qty-input-area" type="text" value="{{$item->qty}}" readonly>
			<button onclick="changeCartItemQty('{{$item->model->id}}', true)">
				<i class="fa fa-plus"></i>
			</button>
		</div>
	</div>
</div>
