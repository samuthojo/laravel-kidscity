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

            <button :disabled="product.loading" class="btn accent add-btn" v-on:click="addToCart()">
                <span v-if="product.loading">Adding</span>
                <span v-if="!product.loading">Add to cart</span>
            </button>

            <button :disabled="product.loading" class="btn danger remove-btn" v-on:click="removeFromCart()">
                <span v-if="product.loading">removing</span>
                <span v-if="!product.loading">remove</span>
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
                this.product.loading = true;
                this.$root.$emit('add', {'id': this.product.id, 'qty' : 1});
                this.$root.$on('added', () => {
                    this.product.loading = false;
                    this.product.in_cart = true;
                    this.$root.$off('added');
                });
            },

            removeFromCart() {
                var url= window.Laravel.base_url + '/removeFromCart';
                this.product.loading = true;
                this.$root.$emit('remove', {'id': this.product.id});


                this.$root.$on('removed', () => {
                    this.product.loading = false;
                    this.product.in_cart = true;
                    this.$root.$off('removed');
                });

                axios.post(url,  {'id': this.product.id})
                    .then((response)=>{
                        console.log(response);
                        this.product.loading = false;
                        this.product.in_cart = false;
                    }).catch((error)=>{
                        console.log(error.response.data)
                    });
            }
        }
    }
</script>
