@extends('mobile.layouts.no_shell')

@section('styles')
	<link href="{{asset('css/mobile/product_detail.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div id="appBar" class="for-mob" style="background-color: rgba(0,0,0,0.2); box-shadow: none">
		<div id="mainActionBar" class="layout center justified" style="z-index: 1;">
			<a id="mainLogo" href="{{ URL::previous() }}" class="layout center">
				<svg fill="#000000" height="28" viewBox="0 0 24 24" width="28" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 0h24v24H0z" fill="none"/>
					<path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
				</svg>

			</a>
		</div>
	</div>

	<div id="product-{{$product->id}}" class="product-infos {{in_cart($product->id) ? 'added' : ''}}">
		<div id="productImage">
			<img src="{{asset('images/real_cloths/' . $product->image_url)}}" alt=""
				 width="100%">
		</div>

		<div id="productInfo" class="col-md col-md-offset-1" style="max-width: 600px;">
			<h2>
				{{$product->name}}
			</h2>
			<span class="price">
				<span class="currency">Tshs.</span>
				<span class="number">
					{{number_format(round(rand(12000, 30000), -3))}}/-
				</span>
			</span>
			<div class="product-description">
				<h5>Description</h5>
				<p>
					{{$product->description}}
				</p>
			</div>
		</div>

		<div id="addProductBar">
			<button id="addButton" class="btn add-btn large block accent" onclick="addItem(event, '{{$product->id}}')">
				ADD TO CART
			</button>

			<button id="removeButton" class="btn remove-btn large block danger"
					onclick="removeFromCart(event, '{{$product->id}}')">
				REMOVE FROM CART
			</button>
		</div>
	</div>

	<script>
		var det_qty = 1;

		function addItem(e, id) {
			addToCart(e, id, det_qty);
		}

		function reduceQty(id){
			console.log($("#"+id).find("input").val());
			if(det_qty > 1){
				det_qty -= 1;
				$("#"+id).find("input").val(det_qty);

				if(det_qty === 1){
					$("#"+id).find("button:first").attr("disabled", "disabled");
				}
			}
		}

		function addQty(id){
			console.log($("#"+id).find("input").val());
			det_qty += 1;
			$("#"+id).find("input").val(det_qty);

			$("#"+id).find("button:first").removeAttr("disabled");
		}
	</script>
@endsection