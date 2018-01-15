@extends('mobile.layouts.app')

@section('styles')
	<link href="{{asset('css/mobile/cart.css')}}" rel="stylesheet">
@endsection

@section('page-title')
	Your Cart
@endsection

@section('appbar-menu')
	{{--<button style="font-size: 14px; margin-right: 58px;">CHECKOUT</button>--}}
@endsection

@section('content')
	<div id="cartItems" class="{{Cart::count() < 1 ? 'is-empty' : ''}}">
		@foreach(Cart::content() as $item)
			@include('mobile.tpl.cart_item')
		@endforeach

		<div id="emptyMessage" class="layout vertical fill center-center">
			<img src="{{asset('images/empty-state/cart_orange_faded.png')}}" alt="">
			<h3>Your cart's empty</h3>
			<p>
				You have no items in your cart.
			</p>
			<a href="{{url('/mob/shop')}}" class="btn large has-ripple ripple-light">CONTINUE SHOPPING</a>
		</div>

		<div id="cartItemsSummary" class="layout center justified">
			<div >
				<h3>Total Cost</h3>
				<p id="cartSubTotal">
					{{--{{present_price(Cart::subtotal())}}--}}
					Tshs.<span class="amount">{{number_format(Cart::subtotal())}}</span>/=
				</p>
			</div>

			<a href="{{url('/mob/checkout')}}" class="btn large has-ripple ripple-light">
				CHECKOUT
			</a>
		</div>
	</div>

	<script>
        $("body").addClass('has-cart-summary');

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
                    $("#cartSubTotal .amount").text(res.subtotal_num);
                    input.val(qty);
                    inputBar.removeClass("loading");

                    if(qty === 1){
                        $(inputBar).find("button:first").addClass("disabled");
                    }else{
                        $(inputBar).find("button:first").removeClass("disabled");
                    }

                    if($("#cartCount").get(0)){
                        $("#cartCount").get(0).setAttribute("data-badge", res.count);
                        $("#cartCount").removeClass("tada");
                        setTimeout(function () {
                            $("#cartCount").addClass("tada");
                        }, 1)
                    }
                }
            })
        }
	</script>
@endsection