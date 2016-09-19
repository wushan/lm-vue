<template lang="pug">
	main
		#main
			page-navigation
			#news
				section#news-slider
					.container.restrict-large
						h1
							|	LATEST
							span.bold NEWS
						.restrict-mid
							#slider
								each i in Array(3)
									.item
										.block
											img(src="../assets/images/components/news-slide-1.png")
										.block
											.content
												time June, 2008
												h2 Lymco at EMO 2016
												.context
													p The stock list has been updated in the dealer's portal. Our latest stock includes the DV-3000MT vertical platform lathe, the RAL seies vertical lathe, and the MH-500 horizontal machining center with auto pallet changer.
												.call-action.right
													a.btn.bordered(href="javascript:;") READ MORE &#9656;

				section#news-list
					.cover
					.container.restrict-large.middler-wrapper
						.middler
							.news-list
								article.news-item(v-for="news in data")
									header
										.thumbnail
											//- a(v-bind:href="'/news/' + news.id")
											router-link(:to="'/news/' + news.id")
												img(v-bind:src="news.thumbnail")
											//- a.overlay(v-bind:href="'/news/' + news.id")
											router-link.overlay(:to="'/news/' + news.id")
												.title
													time {{news.updated_time}}
													h4 {{news.title}}
									.content {{news.excerpt}}
									footer.footer.right
										a(v-bind:href="'/news/' + news.id")
											span read more &#9656;
				section#discover
					a(href="javascript:;") DISCOVER MORE
							
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
require('imports?$=jquery!../assets/vendor/slick.min.js')

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
    $('#slider').slick({
      dots: true,
      arrows: false
    })
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
	@import "src/assets/styles/general/helper/helper";
	
	#news {}
	#news-slider {
		color: $white;
		background-color: $darkestgray;
		background-image: url('../assets/images/components/news-bg-1.png');
		background-repeat: no-repeat;
		background-position: center top; 
		h1 {
			font-size: 3.6em;
			line-height: 1; 
			span {
				display: block;
			}
		}
		.item {
			@extend .clr;
			.block {
				position: relative;
				&:first-child {
					margin-bottom: 3em;
					&:after {
						content: '';
						border: 1px solid $main;
						display: block;
						width: 100%;
						height: 100%;
						position: absolute;
						top: 1em;
						left: 1em;
					}
				}
				img {
					width: 100%;
					position: relative;
					z-index: 1;
				}
			}
			h2 {
				margin: 0;
			}
			time {
				color: $main;
			}
			@include breakpoint(768px) {
				.block {
					@include span(6 of 12 2);
					&:last-child {
						@include last;
					}
				}
			}
		}
		#slider {
			margin: 2em 0;
			height: 100%; 
			.item {
				height: 100%; 
				position: relative;
			}
			.slick-list, .slick-track {
				height: 100%;
			}
			.slick-dots {
				li {
					width: 40px;
					height: 6px;
					button {
						width: 40px;
						height: 6px;
						padding: 0;
						&:before {
							content: '';
							width: 40px;
							height: 6px;
							color: $main;
							border: 1px solid $main;
							background-color: transparent;
							opacity: 1; 
						}
						&:hover {
							&:before {
								background-color: $main;
							}
						}
					}
					&.slick-active {
						button {
							&:before {
								background-color: $main;
							}
						}
					}
				}
			}
		}
	}
	#news-list {
		background-color: $smokygray;
		background-image: url('../assets/images/components/news-bg-2.png');
		background-repeat: no-repeat;
		background-position: top right; 
		padding: 2em 0;
	}
	#discover {
		text-align: center;
		padding: 4em 0;
		background-image: url('../assets/images/components/footer-gray-bg.png');
		background-size: 100% 100%;
		background-repeat: no-repeat;
		a {
			display: inline-block;
			vertical-align: middle;
			color: $white;
			position: relative;
			&:after {
				content: '';
				display: block;
				border-bottom: 2px solid $main;
				position: absolute;
				bottom: -1em;
				left: 0;
				right: 0;
				width: 20%;
				margin: auto; 
			}
		}
	}
</style>