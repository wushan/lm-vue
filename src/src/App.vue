<template lang="pug">
  #application(v-on:click="toggleMenu", v-bind:class="{ off_canvas_on: isActive }")
    #wrapper
      transition(name="fade", mode="out-in")
        router-view(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu", :isAuth="isAuth")
      footer#footer
        .footer-inner
          .block
            router-link(:to="'/privacy'") Privacy | Term of use
          .block
            span
              | Lywentech, Co., Ltd. All rights reserved. | Designed by
              a(href="javascript:;") SUBKARMA
      transition(name="drop", mode="out-in")
        subscription(v-if="subscription")
        login(v-if="login")

    .off-canvas
      nav.off-canvas-navigation
        ul.menu
          li
            router-link(to='/about', activeClass="active") ABOUT US
          li
            router-link(to='/product/series', activeClass="active") PRODUCTS
          li
            router-link(to='/news', activeClass="active") NEWS
          li
            router-link(to='/contact', activeClass="active") CONTACTS
          li
            router-link(to='/', activeClass="active")
              img(src="./assets/images/components/lymco-brand.png")
          li
            router-link(to='/dealers', activeClass="active") DEALER'S PORTAL
          li
            router-link(to='/errorshooting', activeClass="active") ERROR SHOOTING
          li
            router-link(to='/inquiry', activeClass="active") INQUIRY(3)
          li
            a(v-on:click.stop.prevent="toggleSubscription", href="javascript:;", activeClass="active") SUBSCRIPTION
</template>

<script>
import Inquiry from './cart/inquiry'
// Main Components
// import About from './components/About.vue'
// import News from './components/News.vue'
// import NewsSingle from './components/NewsSingle.vue'
import Contact from './components/Contact.vue'
// import Series from './components/Series.vue'
// import Product from './components/Product.vue'
// import Inquiry from './components/Inquiry.vue'
// Side Effect
import Subscription from './components/Subscription.vue'
import Login from './components/Login.vue'
import Store from './assets/vendor/store'
import Auth from './auth/auth'
import Api from './api'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
export default {
  components: {
    'contact': Contact,
    'subscription': Subscription,
    'login': Login
  },
  data () {
    return {
      isActive: false,
      subscription: false,
      login: false,
      inquiryLength: 0,
      isAuth: false,
      submenu: null
    }
  },
  beforeCreate () {
    if (!Store.enabled) {
      window.alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.')
      return
    }
    var user
    if (Store.get('lymco-auth')) {
      user = Store.get('lymco-auth')
      Auth.check(user.id, user.is_login, (err, data) => {
        if (err) {
          this.error = err.toString()
        } else {
          console.log(data)
          if (data === 'success') {
            this.isAuth = true
            this.login = false
          }
        }
      })
    }
  },
  created () {
    this.$on('openSubscription', function (res) {
      this.subscription = true
    })
    this.$on('leaveSubscription', function (res) {
      this.subscription = false
    })
    this.$on('showLogin', function (res) {
      this.login = true
    })
    this.$on('leaveLogin', function (res) {
      this.login = false
    })
    this.$on('updateInquiry', function () {
      this.inquiryLength = Inquiry.getLength()
    })
    this.$on('isLogin', function () {
      this.isAuth = true
      this.login = false
    })
    // Check Login Stats
    this.fetchData()
  },
  mounted () {
    this.inquiryLength = Inquiry.getLength()
  },
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      // Api.getGeneral((err, data) => {
      //   this.loading = false
      //   if (err) {
      //     this.error = err.toString()
      //   } else {
      //     this.submenu = data.category
      //   }
      // })
      Api.getCategories((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.submenu = data.categories
          console.log(data.categories)
        }
      })
    },
    toggleMenu () {
      if (this.$data.isActive) {
        this.$data.isActive = false
        $('html, body').css({
          position: 'static',
          overflow: 'auto',
          height: 'auto'
        })
      }
    },
    toggleSubscription () {
      if (this.subscription) {
        this.subscription = false
      } else {
        this.subscription = true
        this.isActive = false
      }
    }
  }
}
</script>

<style lang="scss">
  // Transitions
  .fade-enter-active, .fade-leave-active {
    transition: .3s all ease;
  }
  .fade-enter, .fade-leave-active {
    opacity: 0;
    transform: translateX(40%);
  }
  // Transitions
  .drop-enter-active, .drop-leave-active {
    transition: .3s all ease;
  }
  .drop-enter, .drop-leave-active {

    transform: translateY(-100%);
  }
  // Global Styles
  @import "bower_components/bourbon/app/assets/stylesheets/bourbon";
  @import "bower_components/susy/sass/susy";
  @import "bower_components/breakpoint-sass/stylesheets/breakpoint";
  //Normalize
  @import "src/assets/styles/normalize";
  // Susy Global
  $susy: (
    columns: 12,
    gutters: .5,
    math: fluid,
  );
  @import "src/assets/styles/general/general";
  @import "src/assets/styles/font-awesome/font-awesome";
  @import "src/assets/styles/footer/footer";
  @import "src/assets/styles/slick/slick";
  @import "src/assets/styles/slick/slick-theme";

</style>
