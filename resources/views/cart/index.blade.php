<div id="cartPage">
	<div class="section-wrapper">
		<div class="row">
			<div id="cartItems" class="col-md-8">
				<h2>Cart Items</h2>
				@include('cart.cart_items')
			</div>
			<div class="col-md-4">
				@include('cart.checkout_form')
			</div>
		</div>
	</div>
</div>
