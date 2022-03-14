import Vue from 'vue';

Vue.component('restaurant-list', require('./components/RestaurantList.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
