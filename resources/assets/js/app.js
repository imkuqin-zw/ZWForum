
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import { sync } from 'vuex-router-sync'
import NProgress from 'vue-nprogress'
// import ElementUI from 'element-ui'
// import 'element-ui/lib/theme-default/index.css'
import VeeValidate from 'vee-validate';

import App from './App.vue'
import router from './router'
import store from './store'

import 'admin-lte/plugins/slimScroll/jquery.slimscroll.min'
import 'admin-lte/dist/js/app.min.js'

Vue.use(NProgress)
Vue.use(VeeValidate)
// Vue.use(ElementUI)


sync(store, router)

const nprogress = new NProgress({ parent: '.nprogress-container' })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const { state } = store

Vue.component('app', App)
Vue.component('vue-table',require('components/Table.vue'))
Vue.component('error-alert',require('components/errorAlert.vue'))
Vue.component('success-alert',require('components/successAlert.vue'))


const app = new Vue({
  el: '#app',
  template: '<app></app>',
  router,
  store,
  nprogress,
});
