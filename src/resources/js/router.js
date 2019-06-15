import Vue from 'vue';
import VueRouter from 'vue-router';

import Top from './pages/TopComponent.vue';
import Post from './pages/PostComponent.vue';
import Detail from './pages/DetailComponent.vue';

Vue.use(VueRouter);

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
    path: '/detail/:id',
    component: Detail
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
