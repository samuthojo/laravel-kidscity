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
                <a href="https://www.algolia.com" class="layout center">
                    <img src="images/algolia.svg" alt="" style="margin-left: 0.5rem;width:120px" v-if="fromSearch">
                </a>
            </div>
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
            fromSearch: Boolean,
            perPage: Number,
            curPage: Number
        },
        data() {
            return {

            };
        },
        methods: {
            sortProducts: function(val) {
                console.log("Sort products by: " +  val);
            }
        },
        computed: {
            subtitle: function(val) {
                var msg = "Showing products ";

                if(!this.curPage || this.curPage === 0 || this.curPage === 1) {
                    msg += "1 - ";
                    msg += (this.productCount > this.perPage) ? this.perPage : this.productCount;
                }else{
                    var start_value = (this.perPage*(this.curPage - 1)) + 1;
                    msg +=  start_value;
                    msg += " - ";
                    msg += this.perPage*(this.curPage - 1);
                }

                msg += " of ";
                msg += this.productCount > this.perPage ? this.productCount : this.perPage;

                return msg;
            }
        }
    }
</script>
