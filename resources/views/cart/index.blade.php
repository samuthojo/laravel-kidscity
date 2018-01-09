@extends('layouts.app')

@section('styles')
	<link href="{{asset('css/cart.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Your Cart
@endsection

@section('content')
	<div class="page-wrapper main-wrapper for-lg">
		<div id="cartPage">
			<div class="section-wrapper">
				<div class="row">
					<div id="cartItems" class="col-md-8 {{Cart::count() < 1 ? 'is-empty' : ''}}">
						<h2>Cart Items</h2>

						@if(!empty(Session::get('error')))
							<p style="margin-bottom: 12px; display: inline-block; padding: 12px; background: #E00; color: white;">{{ Session::get('error')}}</p>
						@endif

						@if(!empty(Session::get('success')))
							<p style="margin-bottom: 12px; display: inline-block; padding: 12px; background: #0a0; color: white;">{{ Session::get('success')}}</p>
						@endif

						@foreach(Cart::content() as $item)
							@include('cart.cart_item')
						@endforeach

						<p style="color: #999" class="empty-cart-message">
							There are no items in your cart. <br>
							<a href="{{url('/shop')}}" class="btn large accent" style="text-transform: uppercase; margin-top: 12px;">CONTINUE SHOPPING</a>
						</p>

						<div id="cartItemsSummary">
							<div class="layout">
								<div class="flex"></div>
								<div>
									<h3>Total Price</h3>
									<p id="cartSubTotal">
										{{present_price(Cart::subtotal())}}
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						@include('cart.checkout_form')
					</div>
				</div>
			</div>
		</div>@include('scripts');
	</div>

	<script>
        var controller = new ScrollMagic.Controller();
        new ScrollMagic.Scene({
            triggerElement: '.main-wrapper',
            triggerHook: -25
        })
            .setClassToggle("#mainNav", "shadowed")
            .addTo(controller);

        new ScrollMagic.Scene({
            triggerElement: '.main-wrapper',
            triggerHook: 0.1,
            duration: document.querySelector(".main-wrapper").offsetHeight - 490
        })
            .setPin("#checkoutArea")
            .addTo(controller);


        function changeCartItemQty(id, add){
            var parent = $("#product-"+id);
            var input = parent.find(".qty-input-area");
            var init_qty = parseInt(input.val());
            var inputBar = parent.find(".item-qty-bar");
            inputBar.addClass("loading");

            if(add)
            	qty = init_qty + 1;
            else{
                if(init_qty === 1){
                    return;
				}

                qty = init_qty - 1;
			}

            setQty(id, qty, function (success, res) {
                if(!success)
                    return;

                console.log((init_qty === 1), res.success);

                if(res.success){
                    $("#miniCartToggle .count").text(res.count);
                    $("#cartSubTotal").text(res.subtotal);
                    input.val(qty);
                    inputBar.removeClass("loading");

                    if(qty === 1){
                        $(inputBar).find("button:first").addClass("disabled");
                    }else{
                        $(inputBar).find("button:first").removeClass("disabled");
					}
				}
            })
		}
	</script>
@endsection