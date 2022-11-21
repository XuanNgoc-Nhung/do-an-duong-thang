window.Vue = require('vue');
Vue.component('user-home', require('./components/user/home').default);
new Vue({
    el: '#user-home'
});

