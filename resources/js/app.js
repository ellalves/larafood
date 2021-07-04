require('./bootstrap');

window.Vue = require('vue').default;
import VueToastify from "vue-toastify";
Vue.use(VueToastify);

// import VueTheMask from 'vue-the-mask'
// Vue.use(VueTheMask)

Vue.component('point-sale', require('./components/Sales/PointSale.vue').default);
Vue.component('addresses-user', require('./components/Addresses/AddressesUser.vue').default);
Vue.component('orders-tenant', require('./components/Orders/OrdersTenant.vue').default);

const app = new Vue({
    el: '#app'
});