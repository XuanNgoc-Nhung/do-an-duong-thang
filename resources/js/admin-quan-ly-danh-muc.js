window.Vue = require('vue');
Vue.component('danh-muc', require('./components/admin/danhMuc').default);
new Vue({
    el: '#app'
});

