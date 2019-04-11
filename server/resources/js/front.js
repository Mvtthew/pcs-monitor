// Load Vue.js
window.Vue = require('vue');

// Auth
Vue.component('auth-login', require('./components/auth/Login.vue').default);

// User
Vue.component('user-dashboard', require('./components/user/Dashboard.vue').default);

// INC.
Vue.component('navbar', require('./components/Navbar.vue').default);


// Init Vue
const app = new Vue({
    el: '#app'
});