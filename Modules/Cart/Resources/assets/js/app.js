require('./bootstrap');
import Vue from 'vue';
Vue.component('grocery-image-order', require('./components/order/ImageOrderList.vue').default);
Vue.component('grocery-order-list', require('./components/order/OrderList.vue').default);
Vue.component('grocery-order-edit', require('./components/order/EditOrder.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
