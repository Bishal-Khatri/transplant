import Vue from 'vue';
Vue.component('register-hospital', require('./frontend/RegisterHospital.vue').default);

Vue.component('page-edit', require('./components/page/Edit.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
