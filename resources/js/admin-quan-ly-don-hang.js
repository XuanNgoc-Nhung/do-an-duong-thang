window.Vue = require('vue');
Vue.component('don-hang', require('./components/admin/donHang').default);
new Vue({
    el: '#app'
});

