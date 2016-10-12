import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

import App from './App.vue'
import Index from './components/Index.vue'
import About from './components/About.vue'
import News from './components/News.vue'
import NewsSingle from './components/NewsSingle.vue'
import Contact from './components/Contact.vue'
import Series from './components/Series.vue'
import Product from './components/Product.vue'
import Inquiry from './components/Inquiry.vue'
import Privacy from './components/Privacy.vue'
import Dealers from './components/Dealers.vue'
import ErrorShooting from './components/ErrorShooting.vue'

import Post from './components/Post.vue'

// Page Scripts
import OnScreen from 'onscreen'
// window.Parallax = Parallax
// $('#scene').Parallax()
// console.log(Parallax)
Vue.use(VueResource)
Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/', component: Index },
    { path: '/about', component: About },
    { path: '/news', redirect: '/news/1' },
    { path: '/news/single', redirect: '/news' },
    { path: '/news/:page', component: News },
    { path: '/news/single/:id', component: NewsSingle },
    { path: '/product/series', component: Series },
    { path: '/product/single', redirect: '/product/series' },
    { path: '/product/single/:id', component: Product },
    { path: '/product/inventory', component: Series, name: 'inventory' },
    { path: '/inquiry', component: Inquiry, name: 'inquiry' },
    { path: '/privacy', component: Privacy, name: 'privacy' },
    { path: '/dealers', component: Dealers, name: 'dealers' },
    { path: '/post', component: Post },
    { path: '/post/:id', component: Post },
    { path: '/contact', component: Contact },
    { path: '/errorshooting', component: ErrorShooting },
    { path: '/errorshooting/:model/:errorcode', component: ErrorShooting }
  ],
  scrollBehavior (to, from, savedPosition) {
    if (to.hash) {
      return {
        selector: to.hash
      }
    }
  }
})

new Vue({
  router: router,
  components: {
    App
  },
  created () {
    this.$on('toggle', function () {
      if (this.$children[0].$data.isActive) {
        this.$children[0].$data.isActive = false
      } else {
        this.$children[0].$data.isActive = true
        console.log('gg')
      }
    })
    // Onscreen
    const os = new OnScreen({
      tolerance: 100,
      debounce: 100,
      container: window
    })

    os.on('enter', '.track-animate', (element) => {
      element.classList.add('os')
    })

    os.on('leave', '.track-animate', (element) => {
      element.classList.remove('os')
    })
  },
  mounted () {
    console.log('root')
  }
}).$mount('#app')
