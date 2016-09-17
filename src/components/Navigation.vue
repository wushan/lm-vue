<template lang="pug">
	nav.navigation.sticker
		.container.restrict-large
			ul.menu
				li
					router-link(to='/about', activeClass="active") ABOUT US
				li
					router-link(to='javascript:;', activeClass="active") PRODUCTS
				li
					router-link(to='/news', activeClass="active") NEWS
				li
					router-link(to='javascript:;', activeClass="active") CONTACTS
				li
					router-link(to='/', activeClass="active")
						img(src="../assets/images/components/lymco-brand.png")
				li
					router-link(to='javascript:;', activeClass="active") DEALER'S PORTAL
				li
					router-link(to='javascript:;', activeClass="active") ERROR SHOOTING
				li
					router-link(to='javascript:;', activeClass="active") INQUIRY(3)
				li
					router-link(to='javascript:;', activeClass="active") SUBSCRIPTION
			a#mobile-trigger(href="javascript:;", v-on:click.stop="toggleMenu")
				.fa.fa-bars.fa-2x
  
</template>

<script>
export default {
  methods: {
    toggleMenu () {
      this.$root.$emit('toggle', 1)
    }
  },
  data () {
    return {
      msg: 'Hello Vue'
    }
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
	@import "src/assets/styles/navigation/320";
	@import "src/assets/styles/navigation/1280";
</style>