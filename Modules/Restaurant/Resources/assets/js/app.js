require('./bootstrap');
import Vue from 'vue';

Vue.component('client-menu-list', require('./components/client/MenuList').default);
Vue.component('client-order-list', require('./components/client/OrderList').default);
Vue.component('restaurant-list', require('./components/RestaurantList.vue').default);
Vue.component('restaurant-edit', require('./components/RestaurantEdit.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
