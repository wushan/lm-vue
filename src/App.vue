<template lang="pug">
  #application(v-on:click="toggleMenu", v-bind:class="{ off_canvas_on: isActive }")
    #wrapper
      transition(name="fade", mode="out-in")
        router-view(v-bind:inquiryLength="inquiryLength", :isAuth="isAuth")
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
            router-link(to='javascript:;', activeClass="active") PRODUCTS
          li
            router-link(to='javascript:;', activeClass="active") NEWS
          li
            router-link(to='javascript:;', activeClass="active") CONTACTS
          li
            router-link(to='/', activeClass="active")
              img(src="./assets/images/components/lymco-brand.png")
          li
            router-link(to='javascript:;', activeClass="active") DEALER'S PORTAL
          li
            router-link(to='javascript:;', activeClass="active") ERROR SHOOTING
          li
            router-link(to='javascript:;', activeClass="active") INQUIRY(3)
          li
            router-link(to='javascript:;', activeClass="active") SUBSCRIPTION
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
      isAuth: false
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
  },
  mounted () {
    this.inquiryLength = Inquiry.getLength()
  },
  methods: {
    toggleMenu () {
      if (this.$data.isActive) {
        this.$data.isActive = false
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
