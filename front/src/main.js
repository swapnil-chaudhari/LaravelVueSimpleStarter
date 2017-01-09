// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import Router from './routes.js'
import VueReource from 'vue-resource'

import '../bootstrap/css/bootstrap.min.css'
// import '../bootstrap/css/sb-admin.css'
import '../bootstrap/font-awesome/css/font-awesome.min.css'
// import '../bootstrap/css/form-elements.css'
import '../bootstrap/js/jquery.js'
import '../bootstrap/js/bootstrap.min.js'

Vue.use(VueReource)

/* eslint-disable no-new */
new Vue({
  el : '#app',
  template : '<App/>',
  components : { App },
  router : Router
})
