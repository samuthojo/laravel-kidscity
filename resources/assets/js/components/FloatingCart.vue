<style scoped>
    #floatingShoppingCart{
        width: 330px;
        position: fixed;
        bottom: 1em;
        right: 1em;
        background: #000;
        color: #fff;
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
        z-index: 1000;
        border-radius: 4px;
        transition: all 0.35s ease-out;
    }

    #floatingShoppingCart:not(.visible){
        transform: translateY(5%);
        opacity: 0;
        pointer-event: none;
    }

    #floatingShoppingCart .image{
        width: 35px; height:35px;
        border-radius:50%;
        background-color: #fff;
        background-size: 60%;
        background-position: center;
        background-repeat: no-repeat;
        overflow: hidden;
        margin-right: 3%
    }

    #cartHeader{
        padding: 0.55em 1.2em;
        border-bottom: 1px solid #333;
    }

    #cartCount{
        font-size: 0.8em;
        min-width: 30px;
        border-radius: 8px;
        text-align: center;
        background: #fff;
        color: #000;
        padding: 0.2em 0.7em;
        padding-top: 0.3em;
        letter-spacing: 1px;
    }

    #cartHeader button{
        background-color: transparent;
        border: none;
        font-size: 1.6em;
        color: #fff;
    }

    #cartBody{
        height: 0;
        overflow: hidden;
        transition: all 0.35s ease-out;
    }

    #cartBody.open{
        height: auto;
        padding: 1.2em;
        padding-bottom: 0.3em;
        border-bottom: 1px solid #333;
    }

    #cartButtons{
        padding: 0.55em 1.2em;
    }

    #cartButtons button{
        border-radius: 2px;
        background-color: rgba(255,255,255,0.2);
        text-transform: uppercase;
        font-size: 0.8em;
        line-height: 1;
        height: auto;
        padding: 0.4em 1em;
        padding-top: 0.65em;

    }

    #cartButtons button:first-child{
        margin-right: 0.4em;
    }

    .mini-cart-item{
        margin-bottom: 0.55em;
        transition: opacity 0.25s ease-out 0.25s;
    }

    #cartBody:not(.open) .mini-cart-item{
        opacity: 0 !important;
        transition: none;
    }

    .mini-cart-item .image{
        margin-right: 0.4em;
    }

    .mini-cart-item .image img{
        width: 100%;
    }

    .mini-cart-item span{
        margin-top: 0.2em;
        font-size: 0.8em;
        color: #ddd;
    }
</style>

<template>
    <div id="floatingShoppingCart" v-bind:class="{ visible : itemCount > 0 }">
        <div id="cartHeader" class="layout center justified">
            Shopping Cart

            <div class="layout center">
                <div id="cartCount">{{itemCount}} Item<span v-if="itemCount > 1">s</span></div>
                &nbsp;&nbsp;
                <button v-on:click="toggleOpen()" class="has-ripple ripple-light">
                    <i class="fa fa-angle-up" v-if="!cart_open"></i>
                    <i class="fa fa-angle-down" v-if="cart_open"></i>
                </button>
            </div>
        </div>
        <div id="cartBody" v-bind:class="{ open: cart_open }">
          <div v-for="(item, index) in items" class="mini-cart-item layout" v-if="index < 3">
            <div class="image" v-bind:style="{ backgroundImage: 'url('+item.image+')'}">
                <img v-bind:src="item.image" alt="" style="opacity: 0">
            </div>

            <div class="layout vertical flex">
                <h3>{{item.name}}</h3>
                <span>
                    @ {{item.price}}
                </span>
            </div>

            <div class="layout center" style="font-size: 1.2em; align-self: center">
                <span style="line-height: 0;font-size: 1.3em; padding: 8px; margin-bottom: 3px;">&#215;</span> {{item.qty}}
            </div>
          </div>

          <a v-bind:href="cart_url" style="display: block; padding:6px 0; font-size: 0.87em; text-decoration: underline;" v-if="items.length > 3 && cart_open">
              view {{items.length - 3}} more item<span v-if="items.length > 4">s</span>.
          </a>
        </div>
        <div id="cartButtons" class="layout center justified">
            <span><span style="opacity: 0.7; font-size: 0.8em">PRICE:</span> {{totalPrice}}</span>
            <a class="btn" v-bind:href="cart_url">VIEW CART</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            // basic type check (`null` means accept any type)
            itemCount: 0,
            totalPrice : "",
            items: Array,
        },
        data() {
            return {
                cart_open: false,
                cart_url: ""
            };
        },

        created() {
            //this.fetchCartItems();
            this.$emit('ready');
        },

        mounted() {
            this.cart_url = this.$attrs['href'];
        },

        methods: {
            toggleOpen() {
                this.cart_open = !this.cart_open
            }
        }
    }
</script>
