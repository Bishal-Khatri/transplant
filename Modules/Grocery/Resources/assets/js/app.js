require('./bootstrap');
import Vue from 'vue';
Vue.component('grocery-item-edit', require('./components/inventory/GroceryItemEdit.vue').default);
Vue.component('grocery-item-list', require('./components/inventory/GroceryItemList.vue').default);
// Vue.component('grocery-order-list', require('./components/order/GroceryOrderList.vue').default);
Vue.component('grocery-brand-list', require('./components/brand/BrandList.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
