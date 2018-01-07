<div id="productDetailPage">
	<div class="page-wrapper main-wrapper">
		<div id="product-{{$product->id}}" class="row product-infos {{in_cart($product->id) ? 'added' : ''}}">
			<div id="productImage" class="col-md-4">
				<img src="{{asset('images/real_cloths/' . $product->image_url)}}" alt=""
				 height="600px">
			</div>
			<div id="productInfo" class="col-md col-md-offset-2">
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

				<div class="tags-list" style="display: none;">
					<p>Product tags</p>
					<span class="tag">Tag 1</span>
					<span class="tag">Tag 2</span>
					<span class="tag">Tag 3</span>
				</div>

				<span class="qty-title">
					Enter Quantity
				</span>
				<div class="layout center">
					<div id="detailQty" class="qty-bar layout center">
						<button onclick="reduceQty('detailQty')">
							<i class="fa fa-minus"></i>
						</button>
						<input type="text" value="1" readonly>
						<button onclick="reduceQty('detailQty')">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>

				<button id="addButton" class="btn remove-btn large block danger"
						onclick="removeFromCart(event, '{{$product->id}}')">
					REMOVE FROM CART
				</button>

				<button id="addButton" class="btn add-btn large block accent" onclick="addItem(event, '{{$product->id}}')">
					ADD TO CART
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	var det_qty = 1;

	function addItem(e, id) {
		addToCart(e, id, det_qty);
    }

	function reduceQty(id){
	    if(det_qty > 1){
            det_qty -= 1;
            $("#"+id).find("input").val(det_qty);

            if(det_qty === 1){
                $("#"+id).find("button:first").attr("disabled", "disabled");
			}
		}
	}

    function addQty(id){
        if(det_qty > 1){
            det_qty += 1;
            $("#"+id).find("input").val(det_qty);

            $("#"+id).find("button:first").removeAttr("disabled");
        }
    }
</script>
