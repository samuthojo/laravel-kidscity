<style scoped>
    #productsGrid{
        min-height: 50vh;
    }
    #productsGrid > p{
        padding: 1em 0;
    }
</style>

<template>
    <div id="productsGrid">
        <p id="filterEmptyMain" v-if="!initialCount || initialCount < 1 || !products.length">
            No products found for {{pageTitle}}.
        </p>

        <p v-if="products.length && !filtered_products.length">
            No products found, please change filter options.
        </p>

        <div class="row">
            <div class="col-md-4 product-item" v-for="(product, index) in filtered_products">
                <product-item :product="product"></product-item>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            products: Array,
            pageTitle: String,
            initialCount: Number,
            startIndex: Number,
            endIndex: Number,
            selectedGenders: Array,
            selectedAges: Array,
            sorter: String
        },

        data() {
            return {
                filterEmpty: false
            };
        },

        computed: {
            filtered_products: function(){
                return this.products.sort((a, b) => {
                        if(!this.sorter || this.sorter === "date"){
                            if (a.time < b.time)
                                    return 1;
                            if (a.time > b.time)
                                return -1;
                            return 0;
                        }

                        else if(!this.sorter || this.sorter === "price"){
                            if (a.price < b.price)
                                return -1;
                            if (a.price > b.price)
                                return 1;

                            return 0;
                        }
                        else{
                            if (a.time < b.time)
                                return 1;
                            if (a.time > b.time)
                                return -1;

                            return 0;
                        }
                    })
                    .filter((item, key) => key >= this.startIndex && key <= this.endIndex)
                    .filter(item => !this.selectedGenders.length || this.selectedGenders.indexOf(item.gender) !== -1)
                    .filter(item => !this.selectedAges.length || this.selectedAges.indexOf(item.gender) !== -1);
            }
        },

        methods: {

        }
    }
</script>
