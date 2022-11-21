window.Vue = require('vue');
Vue.component('booking-list', require('./components/user/listBooking').default);
new Vue({
    el: '#user-home'
});

