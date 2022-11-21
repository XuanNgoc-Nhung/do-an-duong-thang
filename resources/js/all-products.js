window.Vue = require('vue');
Vue.component('all-products', require('./components/user/allProducts').default);
new Vue({
    el: '#user-home'
});

