<style scoped>

</style>

<template>
    <div>
        <shop-actions :page-title="pageTitle"
                      :from-search="fromSearch"
                      :start-page="startIndex"
                      :end-page="endIndex"
                      :product-count="products.length"
                      @changesorter="onSorterChanged"></shop-actions>

        <product-list :sorter="sorter"
                      :page-title="pageTitle"
                      :selected-genders = "selectedGenders"
                      :selected-ages = "selectedAges"
                      :products="products"
                      :initial-count=initialCount
                      :start-index="startIndex"
                      :end-index="endIndex"></product-list>

        <shop-footer :cur-page="curPage"
                     :per-page="perPage"
                     :product-count="products.length"
                     :pagination-buffer="paginationBuffer"
                     @changepage="onPageChanged"></shop-footer>
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
            paginationBuffer: Number
        },

        data() {
            return {
                sortBy: "",
                allProducts: [],
                selectedAges: [],
                selectedGenders: [],
                curPage : 0,
                sorter: "date"
            };
        },

        mounted() {
            this.curPage = parseInt(this.$attrs['page']);
        },

        methods: {
            setProducts(products){
                this.allProducts = products;
            },

            setSelectedAges(ages){
                this.$data.selectedAges = ages;
            },

            setSelectedGenders(genders){
                this.$data.selectedGenders = genders;
            },

            onPageChanged(page) {
                this.$data.curPage = page;
            },

            onSorterChanged(filter_option){
                this.$data.sorter = filter_option;
            }
        },

        computed: {
            startIndex: function() {
                if(!this.products || !this.products || !this.products.length)
                    return 0;
                else if(!this.curPage || this.curPage === 1)
                    return 1;
                else
                    return (this.perPage*(this.curPage - 1)) + 1;
            },
            endIndex: function() {
                if(!this.products || !this.products || !this.products.length)
                    return 0;
                let end = this.perPage > this.products.length ? this.products.length : this.perPage*this.curPage;

                console.log(end > this.products.length);
                console.log(end, this.products.length);

                if(end > this.products.length)
                    return this.products.length;
                else
                    return end;
            }
        }
    }
</script>
