<style scoped>

</style>

<template>
    <div id="productsGrid">
        <p id="filterEmptyMain" v-if="initialCount < 1">
            No products found for {{pageTitle}}.
        </p>

        <div class="row">
            <div class="col-md-4 product-item" v-for="(product, index) in filtered_products">
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
                filterEmpty: false,
                selectedGenders: [],
                selectedAges: []
            };
        },

        computed: {
            filtered_products: function(){
                return this.products
                    .filter(item => !this.selectedGenders.length || this.selectedGenders.indexOf(item) !== -1)
                    .filter(item => !this.selectedAges.length || this.selectedAges.indexOf(item) !== -1);
            }
        },

        methods: {

        }
    }
</script>
