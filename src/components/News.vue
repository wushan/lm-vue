<template lang="pug">
	main
		#main
			page-navigation
			section#news-slider
				.container.restrict
					h2 News List
			section#news-list
				.cover
				.container.restrict-large.middler-wrapper
					.middler
						.news-list
							article.news-item(v-for="news in data")
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
      Api.getNewsHome((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.data = data
          console.log(this.data)
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
	
	#about {
		background-color: $darkestgray;
		color: $white;
	}
</style>