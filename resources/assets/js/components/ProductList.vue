<style scoped>

</style>

<template>
    <div id="productsGrid">
        <p id="filterEmptyMain" v-if="initialCount < 1">
            No products found for {{pageTitle}}.
        </p>

        <div class="row">
            <div class="col-md-4 product-item"  v-for="(product, index) in products">
                <product-item :product="product"></product-item>
            </div>
        </div>

        <p id="filterEmpty" v-if="filterEmpty">
            No products found, please change filter options.
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            products: Array,
            pageTitle: String,
            initialCount: Number
        },

        data() {
            return {
                filterEmpty: false
            };
        },

        methods: {

        }
    }
</script>
