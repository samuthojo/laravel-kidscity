<div id="productDetailPage">
	<div class="section-wrapper">
		<div id="product-{{$product->id}}" class="row product-infos {{in_cart($product->id) ? 'added' : ''}}">
			<div id="productMedia">
				<div id="mediaScroller" class="layout">
					<div id="productImage" class="layout">
						@if(count($product->real_pictures()) > 1)
							<div id="imageOptions">
								@foreach($product->real_pictures() as $picture)
									<div class="{{$loop->index == 0 ? 'active' : ''}} image-option layout center-center" data-image="{{$picture}}">
										<img src="{{$picture}}" alt="">
									</div>
								@endforeach
							</div>
						@endif
						<div id="image" class="layout center-center">
							<img id="bigPicture" src="{{$product->image()}}" alt=""
								 style="min-width: 40%; max-width: 80%; max-height: 95%">
						</div>
					</div>

					@if(!is_null($product->video_url))
						<div id="productVideo" class="layout center-justified start">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/{{$product->video_url}}?rel=0&amp;controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
					@endif
				</div>

				@if(!is_null($product->video_url))
					<div id="mediaTabs">
						<button class="has-ripple" onclick="switchMediaTab(0)">PRODUCT IMAGE</button>
						<button class="has-ripple" onclick="switchMediaTab(1)">PRODUCT VIDEO</button>
					</div>
				@endif
			</div>
			<div id="productInfo" class="col-md" style="max-width: 600px;">
				<h2>
					{{$product->name}} 
				</h2>
				<span class="price">
					<span class="currency">Tshs.</span>
					<span class="number">
						{{present_price($product->price)}}
					</span>
				</span>

				<div class="tags-list" style="display: none;">
					<p>Product tags</p>
					<span class="tag">Tag 1</span>
					<span class="tag">Tag 2</span>
					<span class="tag">Tag 3</span>
				</div>

				<div id="addForm">
					<span class="qty-title">
						Enter Quantity
					</span>
					<div class="layout center">
						<div id="detailQty" class="qty-bar layout center">
							<button disabled onclick="reduceQty('detailQty')">
								<i class="fa fa-minus"></i>
							</button>
							<input type="text" value="1" readonly>
							<button onclick="addQty('detailQty')">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>

					<button id="addButton" class="btn add-btn large block accent" onclick="addItem(event, '{{$product->id}}')">
						ADD TO CART
					</button>
				</div>

				<button id="addButton" class="btn remove-btn large block danger"
						onclick="removeFromCart(event, '{{$product->id}}')">
					REMOVE FROM CART
				</button>
			</div>
		</div>

		<div id="productDescription">
			<div class="row">
				<div id="description" class="col-md-7">
					<h5>Description</h5>
					<p>
						{!! $product->description !!}
					</p>
				</div>

				<div class="col-md-3 col-md-offset-1">
					<div class="info-line layout center">
						<h5>Dimensions : </h5>&nbsp;
						@if(!is_null($product->dimensions))
							<p>{{$product->dimensions}}</p>
						@else
							<p>Not available</p>
						@endif
					</div>

					<div class="info-line layout center">
						<h5>Weight : </h5>&nbsp;
						@if(!is_null($product->weight))
							<p>{{$product->weight}}</p>
						@else
							<p>Not available</p>
						@endif
					</div>
				</div>
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
