<style scoped>
    #sorter span{
        margin-right: -0.4em;
    }
</style>

<template>
    <div id="actionBar" class="layout justified center">
        <div id="productsTitle">
            <h3>
                <em v-if="fromSearch">Showing results for "{{pageTitle}}"</em>
                <em v-else>{{pageTitle}}</em>
            </h3>

            <div class="layout center">
                {{subtitle}}
                <a href="https://www.algolia.com" class="layout center" v-if="fromSearch">
                    <img :src="algolia_image" alt="" style="margin-left: 0.5rem;width:120px">
                </a>
            </div>
        </div>

        <div id="sorter" class="layout center">
            <span>sort by : {{filter_by}}</span>
            &emsp;
            <select id="sorterInput" v-on:change="sortProducts(this.value)"  v-model="filter_by">
                <option value="date">New Arrivals</option>
                <!--<option value="popular">Most Popular</option>-->
                <option value="price">Price</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            pageTitle: String,
            productCount: Number,
            fromSearch: Boolean,
            startPage: Number,
            endPage: Number
        },
        data() {
            return {
                filter_by: "date",
                algolia_image: window.Laravel.asset_url + "/algolia.svg"
            };
        },
        methods: {
            sortProducts: function(e) {
                console.log("Sorter: ", this.$data.filter_by);
                this.$emit('changesorter', this.$data.filter_by);
            }
        },
        computed: {
            subtitle: function(val) {
                var msg = "Showing products " + this.startPage + " - " + this.endPage + " of ";
                msg += this.productCount;

                return msg;
            }
        }
    }
</script>
