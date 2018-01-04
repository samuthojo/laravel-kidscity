<div class="cart-item row">
	<div class="item-image col-md-1">
		<img src="{{asset('images/cart/' . $product->id . '.png')}}" alt="">
	</div>
	<div class="layout flex center">
		<div class="item-name col-md">
			<h3>
				{{$product->name}}
			</h3>
		</div>
		<div class="item-qty-bar item-qty layout center-center">
			<button>
				<i class="fa fa-minus"></i>
			</button>
			<input type="text" value="{{$quantity}}">
			<button>
				<i class="fa fa-plus"></i>
			</button>
		</div>
		<span style="padding: 0 32px;">
			Tshs. {{number_format($product->price * $quantity)}}/=
		</span>
		<button class="btn">REMOVE</button>
	</div>
</div>
