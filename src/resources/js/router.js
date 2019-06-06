import Vue from 'vue';
import VueRouter from 'vue-router';

import Top from './pages/TopComponent.vue';
import Post from './pages/PostComponent.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: Top
    },
    {
        path: '/post',
        component: Post
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
