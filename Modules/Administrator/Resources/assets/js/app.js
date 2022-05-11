import Vue from 'vue';

window._ = require('lodash');

Vue.component('religion-index', require('./components/religion/ReligionIndex.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
