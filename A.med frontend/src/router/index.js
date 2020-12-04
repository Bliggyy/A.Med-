import Vue from 'vue'
import VueRouter from 'vue-router'
//import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import SignUp from '../views/Signup.vue'
import DocVerify from '../views/DocVerification.vue'
import DocHome from '../views/DocHome.vue'
import PatientHome from '../views/PatientHome.vue'

Vue.use(VueRouter)

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
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  routes
})
router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  next()
})
export default router
