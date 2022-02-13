window.Vue = require('vue').default;

Vue.component('example', require('./Example.vue').default);

const app = new Vue({
    el: '#grocery-app',
});
