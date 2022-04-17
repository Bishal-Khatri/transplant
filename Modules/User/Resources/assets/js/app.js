require('./bootstrap');
import Vue from 'vue';

Vue.component('user-list', require('./components/UserList.vue').default);
Vue.component('role-list', require('./components/RoleList.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
