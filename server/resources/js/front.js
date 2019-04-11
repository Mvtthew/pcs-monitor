// Load Vue.js
window.Vue = require('vue');


Vue.component('auth-login', require('./components/auth/Login.vue').default);


// Init Vue
const app = new Vue({
    el: '#app'
});