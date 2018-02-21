<style scoped>
    #shopFooter{
        margin-top: 1em;
        height: 50px;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }

    #pagination{
        padding: 0 0.5em;
    }

    #shopFooter button{
        padding: 0.2em 0.5em;
        margin: 0 0.1em;
        background-color: transparent;
        outline: none;
        border: none;
        font-size: 1.1em;
        cursor: pointer;
    }

    #pagination button,
    #shopFooter button.disabled,
    #pagination span{
        opacity: 0.4;
    }

    #shopFooter button.disabled,
    #shopFooter button.active {
        pointer-events: none;
    }

    #pagination button.active{
        opacity: 1;
        font-family:Bold, sans-serif;
        font-weight: bold;
    }
</style>

<template>
    <div id="shopFooter" class="layout end-justified center">
        <button title="First Page" v-bind:class="{ disabled : curPage === 1 }"
                v-on:click="goToPage(1)">
            <i class="fa fa-angle-double-left"></i>
        </button>

        <button title="Previous Page" v-bind:class="{ disabled : curPage === 1 }"
                v-on:click="goToPage(curPage - 1)">
            <i class="fa fa-angle-left"></i>
        </button>

        <div id="pagination" class="layout inline center">
            <div class="layout center" v-if="curPage > paginationBuffer">
                <button v-on:click="goToPage(1)">
                    1
                </button>
                <span>...</span>
            </div>

            <button v-for="page in pages"
                    v-bind:class="{ active : page === curPage }"
                    v-on:click="goToPage(page)">
                {{page}}
            </button>

            <div class="layout center" v-if="curPage < (lastPage - paginationBuffer)">
                <span>...</span>
                <button v-on:click="goToPage(lastPage)">
                    {{lastPage}}
                </button>
            </div>
        </div>

        <button title="Next Page" v-bind:class="{ disabled : curPage === lastPage }"
                v-on:click="goToPage(curPage + 1)">
            <i class="fa fa-angle-right"></i>
        </button>

        <button title="Last Page" v-bind:class="{ disabled : curPage === lastPage }"
                v-on:click="goToPage(lastPage)">
            <i class="fa fa-angle-double-right"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            productCount: Number,
            curPage: Number,
            perPage: Number,
            paginationBuffer: Number
        },
        methods: {
            goToPage: function(idx) {
                this.$emit('changepage', idx);
            }
        },
        computed: {
            pages: function(val) {
                let ar = [];

                for (let i = 1; i <= Math.ceil(this.productCount / this.perPage); i++){
                    ar.push(i);
                }

                return ar.filter((a) => {
                    let not_too_less = a <= this.curPage && a > this.curPage - this.paginationBuffer;
                    let not_too_great = a >= this.curPage && a < this.curPage + this.paginationBuffer;

                    return not_too_less || not_too_great;
                });
            },
            lastPage: function(){
                return Math.ceil(this.productCount / this.perPage);
            }
        }
    }
</script>
