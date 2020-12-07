/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './components/App.vue'
//import Home from '../views/Home.vue'
import Login from './components/Login.vue'
import SignUp from './components/Signup.vue'
import DocVerify from './components/DocVerification.vue'
import DocHome from './components/DocHome.vue'
import PatientHome from './components/PatientHome.vue'

Vue.use(VueRouter)

require('./bootstrap');

window.Vue = require('vue');

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
Vue.component('App', require('./components/App.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
    {
      path: '/',
      redirect: {
        name: 'Login',
      }
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: { title: 'Login | A.med' }
    },
    {
      path: '/Signup',
      name: 'Signup',
      component: SignUp,
      meta: { title: 'Signup | A.med' }
    },
    {
      path: '/Signup/Doctor-Verification',
      name: 'DocVerify',
      component: DocVerify,
      meta: { title: 'Signup | A.med' }
    },
    {
      path: '/Doctor-Home',
      name: 'DocHome',
      component: DocHome,
      meta: { title: 'Home | A.med' }
    },
    {
      path: '/Patient-Home',
      name: 'PatientHome',
      component: PatientHome,
      meta: { title: 'Home | A.med' }
    },
    // {
    //   path: '/',
    //   name: 'Home',
    //   component: Home
    // },
    {
      path: '/about',
      name: 'About',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './components/About.vue')
    }
  ]

const router = new VueRouter({
    mode: 'history',
    routes
})
router.beforeEach((to, from, next) => {
document.title = to.meta.title
next()
})
export default router

const app = new Vue({
    el: '#app',
    components: { 
        App 
    },
    router
});
