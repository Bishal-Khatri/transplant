import Vue from 'vue';

window._ = require('lodash');

Vue.component('patient-list', require('./components/patient/PatientList.vue').default);
Vue.component('hospital-profile', require('./components/profile/HospitalProfile.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
