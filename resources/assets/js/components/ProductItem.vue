<style scoped>

</style>

<template>
        <div class="product" v-bind:class="{ added : product.in_cart }">
            <a v-bind:href="product.url">
                <div class="image">
                    <img v-bind:src="product.image" alt="">
                </div>
                <h5 class="name">{{product.name}}</h5>
                <span class="price">
                <span>{{product.price}}</span>
                    <span>(In Cart)</span>
                </span>
            </a>

            <button class="btn accent add-btn" v-on:click="addToCart(event, product.id, 1)">
                Add to cart
            </button>

            <button class="btn danger remove-btn" v-on:click="removeFromCart(event, product.id)">
                remove
            </button>
        </div>
</template>

<script>
    export default {
        props: {
            product: Object
        },

        methods: {
            addToCart() {
                this.product.in_cart = true;
            },

            removeFromCart() {
                this.product.in_cart = false;
            }
        }
    }
</script>
