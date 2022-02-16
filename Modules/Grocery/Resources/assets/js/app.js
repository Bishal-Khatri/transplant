import Vue from 'vue';
// require('./bootstrap');
Vue.component('grocery', require('./components/Grocery.vue').default);


const app = new Vue({
    el: '#app',
});
