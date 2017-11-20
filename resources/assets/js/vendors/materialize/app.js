
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//var focus = require('vue-focus');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-home', require('./components/App-home.vue'));
Vue.component('home-sliders', require('./components/Home-sliders.vue'));
Vue.component('products', require('./components/Products.vue'));
Vue.component('app-search', require('./components/Search.vue'));

const app = new Vue({
    el: '#app',
    mounted(){
      console.log('Component mounted.')
      Echo.private(`order.${orderId}`)
          .listen('NewOrderCreated', (e) => {
              console.log("Order created");
          });
    }
});
