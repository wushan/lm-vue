<template lang="pug">
	main
		#main
			section#intro
				ul#scene
					li.layer(data-depth="0.00")
						.background
							//(style="background-image: url('../assets/images/parallax/background.jpg');")

					li.layer(data-depth="0.40")
						.people
							img(src="../assets/images/parallax/object.png")
			page-navigation
			section#intro-brand
				.table
					.block.table-c.t-5-10
						//(style="background-image: url('../assets/images/components/intro-brand-1.png');")
						img(src="../assets/images/components/intro-brand-1-placeholder.png")
						.overlay.track-animate
							h1 AT THE HEART OF THE<br>MACHINE TOOL INDUSTRY
					.block.table-c.t-5-10
						.title
							.container.restrict-small
								h1.track-animate ALL THE ANSWERS
						.container.restrict-small
							.context.track-animate
								p We know you wish not having to worry about half the things you worry about today.<br>We understand that suppliers delivering on-time and within your required specs is essential.<br>We realize that talking to someone who actually cares about you, let alone understands your language, is really important. And its even better if he has the answers to your questions.<br>We see that you want a wide choice of quality machines to choose from, all of which have been certified to be reliable and performant.

								p We get it.

								p Lymco is the answer to everything you have been looking for.
								p Lymco is almost certainly the CNC machine tool expert that will make your day a whole lot sweeter. With a deep understanding of how to make machines, we are constantly developing ahead of market trends and needs. We design, manufacture and supply within and beyond the specs of our clients; And we make sure that these machines continue to function for years to come.

								p Lymco brings you closer to what you have been looking for.
								p.green THE EASY CHOICE
			section#intro-product
				.container.restrict-small
					.product-image
						img(src="../assets/images/components/intro-product-1.png")
					h1.track-animate
						|	Horizontal Machining Center
						small.model.track-animate MCV-M11
					.description.track-animate
						p Oversized 40mm ball screw and five pieces bearing block direct driving on three axes, combined with massive 980mm column width to muscle the power and rigidity for wide variety of machining needs.

						p Spindle oil cooling with differential temperature control assure long term machining accuracy; which is much needed in standard machining centers for most machine shops.
					.call-action.right
						a.btn.btn-with-icon(href="javascript:;")
							span INQUIRY
							.fa.fa-plus.fa-lg
						a.btn.btn-with-icon(href="javascript:;")
							span DETAIL
							.fa.fa-plus.fa-lg
			section#intro-news
				.cover
				.container.restrict-large.middler-wrapper
					.middler
						h1.track-animate
							|	LATEST NEWS
							small
								a(href="javascript:;") MORE NEWS HERE &#9656;
						.news-list.track-animate
							each i in Array(4)
								article.news-item
									header
										.thumbnail
											a(href="javascript:;")
												img(src="../assets/images/components/intro-news-item.png")
											a.overlay(href="javascript:;")
												.title
													time July, 2016
													h4 Lymco at EMO 2016
									.content
										p Thanks to the attendants and partners who visiting Lymco and PerfectJet at EMO! This is an impressive and marvelous tradeshow experience for us.
									footer.footer.right
										span read more &#9656;
</template>

<script>
import Navigation from './Navigation.vue'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/parallax.js')
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  data () {
    // $('#scene').parallax()
    return {
      msg: 'Hello Vue'
    }
  },
  mounted () {
    $('#scene').parallax()
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
	@import "src/assets/styles/main/main";
</style>