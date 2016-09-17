<template lang="pug">
	main
		.loading(v-if="loading") Loading...
		#main(v-if="data")
			section#intro
				ul#scene
					li.layer(data-depth="0.00")
						.background

					li.layer(data-depth="0.40")
						.people
							img(src="../assets/images/parallax/object.png")
			page-navigation
			section#intro-brand
				.table
					.block.table-c.t-5-10
						img(src="../assets/images/components/intro-brand-1-placeholder.png")
						.overlay.track-animate
							h1(v-html="data.introbrand.title")
					.block.table-c.t-5-10
						.title
							.container.restrict-small
								h1.track-animate(v-html="data.introbrand.contentheader")
						.container.restrict-small
							.context.track-animate(v-html="data.introbrand.content")
			section#intro-product
				.container.restrict-small
					.product-image
						img(v-bind:src="data.introproduct.image")
					h1.track-animate
						|	{{data.introproduct.name}}
						small.model.track-animate {{data.introproduct.model}}
					.description.track-animate {{data.introproduct.description}}
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
							article.news-item(v-for="news in data.intronews")
								header
									.thumbnail
										a(href="javascript:;")
											img(v-bind:src="news.thumbnail")
										a.overlay(href="javascript:;")
											.title
												time {{news.updated_time}}
												h4 {{news.title}}
								.content {{news.excerpt}}
								footer.footer.right
									a(v-bind:href="'/news/' + news.id")
										span read more &#9656;
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
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
    return {
      loading: false,
      data: null,
      error: null
    }
  },
  mounted () {
    this.fetchData()
  },
  updated () {
    $('#scene').parallax()
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
  },
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      Api.getHome((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.data = data
        }
      })
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
	@import "src/assets/styles/main/main";
</style>