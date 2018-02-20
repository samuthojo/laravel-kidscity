<style scoped>

</style>

<template>
    <div>
        <shop-actions :per-page="perPage" :cur-page="curPage" :page-title="pageTitle" :from-search="fromSearch" :product-count="products.length"></shop-actions>
        <product-list :page-title="pageTitle" :products="products" :initial-count=initialCount></product-list>
    </div>
</template>

<script>
    export default {
        props: {
            pageTitle: String,
            fromSearch: Boolean,
            initialCount: Number,
            products: Array,
            perPage: Number,
            curPage: Number
        },

        data() {
            return {
                sortBy: "",
                allProducts: []
            };
        },

        methods: {
            setProducts(products){
                this.allProducts = products;
            }
        }
    }
</script>
