import Vue from 'vue';
import moment from 'moment'

window._ = require('lodash');

Vue.component('patient-list', require('./components/patient/PatientList.vue').default);
Vue.component('patient-preview', require('./components/patient/PatientPreview.vue').default);
Vue.component('patient-update', require('./components/patient/PatientUpdate.vue').default);
Vue.component('hospital-profile', require('./components/profile/HospitalProfile.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));


Vue.prototype.moment = moment;

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
