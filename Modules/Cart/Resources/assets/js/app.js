require('./bootstrap');
import Vue from 'vue';
Vue.component('grocery-order-list', require('./components/order/GroceryOrderList.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
