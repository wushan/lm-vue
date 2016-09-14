import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import App from './App.vue'
import Index from './components/Index.vue'
import Post from './components/Post.vue'
// Page Scripts
// Expose Jquery Globally.
import $ from 'jquery'
window.$ = $
import OnScreen from 'onscreen'
import Parallax from './assets/js/parallax'
window.Parallax = Parallax

console.log(Parallax)
Vue.use(VueResource)
Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/', component: Index },
    { path: '/post', component: Post },
    { path: '/post/:id', component: Post }
  ]
})

new Vue({
  router: router,
  components: {
    App
  },
  created: function () {
    console.log(this)
  }
}).$mount('#app')

// Onscreen
const os = new OnScreen({
  tolerance: 100,
  debounce: 100,
  container: window
})

os.on('enter', '.track-animate', (element) => {
  // element.style.translateX = 'red';
  console.log(element.style)
  element.classList.add('os')
  // element.style.transform = "translateY(0px)";
})

os.on('leave', '.track-animate', (element) => {
  element.classList.remove('os')
})

const scene = document.getElementById('scene')
const parallax = new Parallax(scene)

$(document).ready(function () {

})
