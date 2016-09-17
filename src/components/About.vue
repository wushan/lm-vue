<template lang="pug">
	main
		#main
			page-navigation
			section#about
				.container.restrict
					h2 TO BE THE HEART OF THE MACHINE TOOL INDUSTRY.
					p.
						At Lymco we are dedicated to being the Number One manufacturing and supplying partner to dealers of CNC machining centers and other CNC machine tools around the world. Quality is our top priority in every step of the production of our CNC machining centers, in the sourcing of machine tool solutions for every application, and in the service we provide to our partners.

					p.
						We strive to not just meet but to exceed our customers' expectations, to satisfy dealers' needs with immediate service and full support, and to deliver value and enhance our dealers' profits through systems efficiencies. From this commitment to superior service and product quality, we will continue building partnerships with machine tool dealers for generations to come. 
					

</template>

<script>
import Navigation from './Navigation.vue'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  data () {
    return {
      msg: 'Hello Vue'
    }
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
  }
}
</script>

<style lang="scss">
	// Global Styles
	@import "bower_components/bourbon/app/assets/stylesheets/bourbon";
	@import "bower_components/susy/sass/susy";
	@import "bower_components/breakpoint-sass/stylesheets/breakpoint";
	@import "src/assets/styles/general/variable/variable";
	@import "src/assets/styles/general/base/base";
	
	#about {
		background-color: $darkestgray;
		color: $white;
	}
</style>