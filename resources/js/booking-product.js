window.Vue = require('vue');
Vue.component('booking-product', require('./components/user/bookingProduct').default);
new Vue({
    el: '#user-home'
});

