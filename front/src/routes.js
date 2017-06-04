import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/authentication/Login.vue'
import Register from './components/authentication/Register.vue'
import Dashboard from './components/Dashboard.vue'
import Category from './components/Category/Categories.vue'
import God from './components/Gods/Gods.vue'
import Sangrah from './components/Sangrahs/Sangrahs.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    routes : [
        {
            path : "/login",
            component : Login,
            meta : {
                forVisitors : true
            }
        },
        {
            path : "/register",
            component : Register,
            meta : {
                forVisitors : true
            }
        },
        {
            path : "/dashboard",
            component : Dashboard,
            meta : {
                forAuth : true
            }
        },
        {
            path : "/category",
            component : Category,
            meta : {
                forAuth : true
            }
        },
        {
            path : "/god",
            component : God,
            meta : {
                forAuth : true
            }
        },
        {
            path : "/sangrah",
            component : Sangrah,
            meta : {
                forAuth : true
            }
        }

    ]
})

export default router
