require('./bootstrap');

import Vue from 'vue';
import router from './router';

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use(CKEditor);

import App from './App.vue';

const app = new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App />'
});
