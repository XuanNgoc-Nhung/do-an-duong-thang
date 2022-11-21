window.Vue = require('vue');
Vue.component('san-pham', require('./components/admin/sanPham').default);
new Vue({
    el: '#app'
});

