import Vue from 'vue';

Vue.component('grocery-item-list', require('./components/inventory/GroceryItemList.vue').default);
Vue.component('grocery-order-list', require('./components/GroceryOrderList.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
