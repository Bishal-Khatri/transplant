import Vue from 'vue';

window._ = require('lodash');

Vue.component('hospital-index', require('./components/hospital/HospitalIndex.vue').default);
Vue.component('hospital-details', require('./components/hospital/HospitalView.vue').default);
Vue.component('hospital-create', require('./components/hospital/CreateHospital.vue').default);

Vue.component('patient-list', require('./components/patient/PatientList.vue').default);
Vue.component('patient-preview', require('./components/patient/PatientPreview.vue').default);
Vue.component('patient-update', require('./components/patient/PatientUpdate.vue').default);

Vue.component('religion-index', require('./components/religion/ReligionIndex.vue').default);
Vue.component('ethnic-groups-index', require('./components/ethnic_groups/EthnicGroupsIndex.vue').default);
Vue.component('disease-index', require('./components/disease/DiseaseIndex.vue').default);
Vue.component('education-level-index', require('./components/education_levels/EducationLevelIndex.vue').default);
Vue.component('occupation-index', require('./components/occupation/OccupationIndex.vue').default);
Vue.component('province-index', require('./components/province/ProvinceIndex.vue').default);
Vue.component('district-index', require('./components/district/DistrictIndex.vue').default);
Vue.component('local-level-index', require('./components/localLevel/LocalLevelIndex.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
