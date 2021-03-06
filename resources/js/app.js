/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue';
import store from './store/index';

import 'slick-carousel';
import './bootstrap';
import './main';

//window.Vue = require('vue');



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app-mini-cart', require('./components/AppMiniCart').default);
Vue.component('app-cart', require('./components/AppCart').default);
Vue.component('app-product', require('./components/AppProduct').default);
Vue.component('app-product-extend', require('./components/AppProductExtend').default);
Vue.component('app-search', require('./components/AppSearch').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

store.dispatch('cart/load');


const app = new Vue({
    el: '#app',
    store,
});
