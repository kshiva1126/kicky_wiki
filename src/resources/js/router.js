import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

import Top from './pages/TopComponent.vue';
import Post from './pages/PostComponent.vue';
import Detail from './pages/DetailComponent.vue';
import Put from './pages/PutComponent.vue';

Vue.use(VueRouter);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const routes = [
  {
    path: '/',
    component: Top
  },
  {
    path: '/post',
    component: Post
  },
  {
    path: '/put/:id',
    component: Put
  },
  {
    path: '/detail/:id',
    component: Detail
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
