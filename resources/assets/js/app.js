
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('floating-cart', require('./components/FloatingCart.vue'));

Vue.component('shop-app', require('./components/ShopApp.vue'));
Vue.component('shop-actions', require('./components/ShopActions.vue'));
Vue.component('product-list', require('./components/ProductList.vue'));
Vue.component('product-item', require('./components/ProductItem.vue'));
Vue.component('shop-footer', require('./components/ShopFooter.vue'));

window.vue_app = new Vue({
    el: '#kidCityApp',
    data: {
        cart_count: 0,
        total_price: 0,
        cart_items: [],
        products: []
    },
    computed: {
        cartLinkHtml: function () {
            var html = '<i class="fa fa-shopping-basket"></i>';
            html += `<span class="count">${this.cart_count}</span>&nbsp; ITEM`;

            if(this.cart_count > 1 || this.cart_count < 1)
                html+='S';
            return html;    
        }
    },
    created(){
        this.$on('add', function(data) {
            var url= window.Laravel.base_url + '/addToCart';
            axios.post(url,  data).then((response)=>{
                var res = response.data;
                this.addItem(res.added_item, res.subtotal);
                this.setCount(res.count);
                this.setPrice(res.subtotal);
            this.$emit('added');
            }).catch((error)=>{
                    console.log(error.response.data)
            });
        });

        this.$on('remove', function(data) {
            var url= window.Laravel.base_url + '/removeFromCart';
            axios.post(url,  data).then((response)=>{
                var res = response.data;
                this.removeItem(res.removed_item_id, res.subtotal);
                this.setCount(res.count);
                this.setPrice(res.subtotal);
            this.$emit('removed');
            }).catch((error)=>{
                console.log(error.response.data)
            });
        });
    },
    methods: {
        setCount: function(count){
            this.$data.cart_count = count;
        },
        setPrice: function(price){
            this.$data.total_price = price;
        },
        setItems: function(list) {
            this.cart_items = list.items;
        },

        addItem: function(item, price) {
            this.cart_items.push(item);
        },
        removeItem: function(id,  price) {
            var item_id = this.cart_items.findIndex(item => item.id == id);
            if(item_id != -1){
                this.cart_items.splice(item_id, 1);
            }
        },
        changeQty: function(id, new_qty) {
            var item_id = this.cart_items.findIndex(item => item.id == id);
            if(item_id != -1){
                this.cart_items[item_id].qty = new_qty;
            }
        },
        setProducts: function(data){
            console.log(data);
            this.$data.products = data.products;
        }
    }
});