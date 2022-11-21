window.Vue = require('vue');
Vue.component('nguoi-dung', require('./components/admin/nguoiDung').default);
new Vue({
    el: '#app'
});

