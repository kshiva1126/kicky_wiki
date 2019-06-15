require('./bootstrap');

import Vue from 'vue';
import router from './router';

import App from './App.vue';

const app = new Vue({
    el: '#app',
    router,
    components: { App },
    template: '<App />'
});
