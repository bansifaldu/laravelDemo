// const jquery_validation = require('jquery-validation');
//  var $= require("jquery");
  window.$ = window.jQuery = require('jquery');


// window.$ = require('jquery');
// global.$ = global.jQuery = require('jquery');
//global.$ = global.jQuery = require('jquery');

// try{
//     //var $= require("jquery");
//     window.$ = window.jQuery = require('jquery');

//     // window.$ = window.jQuery = require('jquery');
//     // import $ from 'jquery';
//     // window.$ = window.jQuery = $;
//     }catch(e) {}
require("jquery-validation");
 

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;


import 'vuejs-datatable/dist/themes/bootstrap-4.esm';
import { VuejsDatatableFactory } from 'vuejs-datatable';
Vue.use( VuejsDatatableFactory );

import DataTable from 'laravel-vue-datatable';
 
Vue.use(DataTable);
 
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
Vue.component('categorylist-component', require('./components/CategorylistComponent.vue').default,'categorylist-component');
Vue.component('categoryedit-component', require('./components/CategoryeditComponent.vue').default,'categoryedit-component');
Vue.component('categorycreate-component', require('./components/CategorycreateComponent.vue').default,'categorycreate-component');

Vue.component('bloglist-component', require('./components/bloglistComponent.vue').default,'bloglist-component');
Vue.component('blogcreate-component', require('./components/blogcreateComponent.vue').default,'blogcreate-component');
Vue.component('blogedit-component', require('./components/blogeditComponent.vue').default,'blogedit-component');
Vue.component('validation_demo-component', require('./components/validation_demo.vue').default,'validation_demo');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
