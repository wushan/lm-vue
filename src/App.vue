<template lang="pug">
  #application(v-on:click="toggleMenu", v-bind:class="{ off_canvas_on: isActive }")
    #wrapper
      transition(name="fade", mode="out-in")
        router-view
      footer#footer
        .footer-inner
          .block
            a(href="javascript:;") Privacy
            a(href="javascript:;") Term of use
          .block
            span
              | Lywentech, Co., Ltd. All rights reserved. | Designed by 
              a(href="javascript:;") SUBKARMA
      transition(name="drop", mode="out-in")
        subscription(v-if="subscription")

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
import Subscription from './components/Subscription.vue'
export default {
  components: {
    'subscription': Subscription
  },
  data () {
    return {
      isActive: false,
      subscription: false
    }
  },
  created () {
    this.$on('openSubscription', function (res) {
      console.log('1111')
      this.subscription = true
    })
    this.$on('leaveSubscription', function (res) {
      console.log('222')
      this.subscription = false
    })
  },
  methods: {
    toggleMenu () {
      if (this.$data.isActive) {
        this.$data.isActive = false
        console.log('pp')
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
    gutters: 1,
    math: fluid,
  );
  @import "src/assets/styles/general/general";
  @import "src/assets/styles/font-awesome/font-awesome";
  @import "src/assets/styles/footer/footer";
  @import "src/assets/styles/slick/slick";
  @import "src/assets/styles/slick/slick-theme";
  
</style>
