import Vue from 'vue';

window._ = require('lodash');

Vue.component('religion-index', require('./components/religion/ReligionIndex.vue').default);
Vue.component('ethnic-groups-index', require('./components/ethnic_groups/EthnicGroupsIndex.vue').default);
Vue.component('disease-index', require('./components/disease/DiseaseIndex.vue').default);
Vue.component('education-level-index', require('./components/education_levels/EducationLevelIndex.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
});
