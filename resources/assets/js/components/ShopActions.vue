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

            <span v-if="productCount">
                Showing products 1 -
                <span v-if="productCount > perPage">{{perPage}}</span>
                <span v-else>{{productCount}}</span>
                of {{productCount}} product<span v-if="productCount > 1">s</span>
            </span>
        </div>

        <div id="sorter" class="layout center">
            <span>sort by : </span>
            &emsp;
            <select id="sorterInput" v-on:change="sortProducts(this.value)">
                <option value="new">New Arrivals</option>
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
            fromSearch: Boolean
        },
        data() {
            return {
                perPage: 12
            };
        },
        methods: {
            sortProducts: function(val) {
                console.log("Sort products by: " +  val);
            }
        }
    }
</script>
