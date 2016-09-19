import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import App from './App.vue'
import Index from './components/Index.vue'
import About from './components/About.vue'
import News from './components/News.vue'
import NewsSingle from './components/NewsSingle.vue'
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
    { path: '/news', component: News },
    { path: '/news/:id', component: NewsSingle },
    { path: '/post', component: Post },
    { path: '/post/:id', component: Post }
  ]
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
  }
}).$mount('#app')

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
