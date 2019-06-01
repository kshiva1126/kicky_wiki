import Vue from 'vue';
import VueRouter from 'vue-router';

import Top from './pages/TopComponent.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: Top
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
