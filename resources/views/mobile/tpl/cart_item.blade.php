<div id="product-{{$item->model->id}}" class="cart-item product-{{$item->model->id}}">
	<div class="layout">
		<div class="item-image">
			<a href="{{url('/mob/products/' . $item->id)}}">
				<img src="{{asset('images/real_cloths/' . $item->model->image_url)}}" alt="" width="100%">
			</a>
		</div>
		<div class="col layout vertical flex" style="margin-left: 16px;">
			<div class="item-name col-md">
				<h3>
					{{$item->name}}
				</h3>
			</div>

			<span class="price">
				@ {{$item->model->present_price()}}
			</span>

			<div class="layout center justified">
				<div class="item-qty-bar item-qty layout inline center">
					<button onclick="changeCartItemQty('{{$item->model->id}}', false)"
							class="{{$item->qty < 2 ? 'disabled' : ''}} has-ripple">
						<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
							<path d="M19 13H5v-2h14v2z"/>
							<path d="M0 0h24v24H0z" fill="none"/>
						</svg>
					</button>
					<img src="{{asset('images/loader.gif')}}" alt="" class="loader" style="width: 30px; margin: 0 8px;">
					<input class="qty-input-area" type="text" value="{{$item->qty}}" readonly>
					<button onclick="changeCartItemQty('{{$item->model->id}}', true)" class="has-ripple">
						<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
							<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
							<path d="M0 0h24v24H0z" fill="none"/>
						</svg>
					</button>
				</div>
			</div>
		</div>
	</div>

	<button class="btn remove-btn has-ripple" style="background-color: #f5f5f5;" onclick="removeFromCart(event, '{{$item->model->id}}')">
		<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
			<path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</svg>
	</button>
</div>
