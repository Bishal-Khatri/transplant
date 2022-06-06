require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import FileManager from 'laravel-file-manager'

Vue.use(Vuex);
const store = new Vuex.Store();

Vue.use(FileManager, {store});

Vue.component('register-hospital', require('./frontend/RegisterHospital.vue').default);
Vue.component('page-edit', require('./components/page/Edit.vue').default);
Vue.component('gallery-index', require('./components/gallery/GalleryIndex.vue').default);
Vue.component('gallery-images', require('./components/gallery/GalleryImages.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

export const EventBus = new Vue();

const app = new Vue({
    store,
    el: '#app',
});
