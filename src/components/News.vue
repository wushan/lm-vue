<template lang="pug">
	main
		#main
			page-navigation
			section#news
				.container.restrict
					h2 News List
					

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
  mounted () {}
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