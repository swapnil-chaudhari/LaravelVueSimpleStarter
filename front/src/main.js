import Vue from 'vue'
import App from './App'
import Router from './routes.js'
import VueReource from 'vue-resource'
import Auth from './packages/auth/auth.js'

import '../bootstrap/css/bootstrap.min.css'
import '../bootstrap/css/sb-admin.css'
import '../bootstrap/font-awesome/css/font-awesome.min.css'
// import '../bootstrap/css/form-elements.css'
import '../bootstrap/js/jquery.js'
import '../bootstrap/js/bootstrap.min.js'

Vue.use(VueReource)
Vue.use(Auth)

Vue.http.options.root = 'http://127.0.0.1:8000/'
Vue.http.headers.common['Authorization'] = 'Bearer ' + Vue.auth.getToken()

Router.beforeEach(
    (to, from, next) => {
        if (to.matched.some(record => record.meta.forVisitors)) {
            if (Vue.auth.isAuthenticated()){
                next({
                    path : '/dashboard'
                })
            } else next()
        }
        else if (to.matched.some(record => record.meta.forAuth)) {
            if (! Vue.auth.isAuthenticated()){
                next({
                    path : '/login'
                })
            } else next()
        } else {
            next({
                path : '/login'
            })
        }
        // alert("hi")

    }
)

/* eslint-disable no-new */
new Vue({
  el : '#app',
  template : '<App/>',
  components : { App },
  router : Router
})
