<button class="has-ripple accent" onclick="addToCart(event, '{{$product->id}}', 1)">
    <span>
        @include('mobile.tpl.cart_icon')
        ADD
    </span>
    <span>LOADING</span>
    <span>IN CART</span>
</button>