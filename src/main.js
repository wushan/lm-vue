import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import App from './App.vue'
import Post from './components/Post.vue'

Vue.use(VueResource)
Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
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
