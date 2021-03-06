import Vue from 'vue';
import Router from 'vue-router';

import Register from './views/Register.vue';
import Dashboard from './views/Dashboard.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Register
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
        }
    ]
});
