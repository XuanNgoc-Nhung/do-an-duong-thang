window.Vue = require('vue');
Vue.component('detail-product', require('./components/user/detailProduct').default);
new Vue({
    el: '#user-home'
});

