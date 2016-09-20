<template lang="pug">
	main
		#main
			page-navigation
			#about
				section
					.container.restrict-large
						.title
							img(src="../assets/images/components/about-heading.png")
					.container.restrict
						
						h2 TO BE THE HEART OF THE MACHINE TOOL INDUSTRY.
						p.
							At Lymco we are dedicated to being the Number One manufacturing and supplying partner to dealers of CNC machining centers and other CNC machine tools around the world. Quality is our top priority in every step of the production of our CNC machining centers, in the sourcing of machine tool solutions for every application, and in the service we provide to our partners.

						p.
							We strive to not just meet but to exceed our customers' expectations, to satisfy dealers' needs with immediate service and full support, and to deliver value and enhance our dealers' profits through systems efficiencies. From this commitment to superior service and product quality, we will continue building partnerships with machine tool dealers for generations to come.
				section
					.inner
						.container.restrict-large
							.title
								h2 FRIENDLY THROUGHTFUL DRIVEN
							.content
								p.
									Because of our history as a respected machine tool builder, Lymco understands that a high precision product means there is no room for error. Our own Lymco(r) machining centers and machine tools and the other high-quality lines we sell are manufactured to ensure that the precision our customers seek is there every step of the way-from sub-assembly to final delivery to after-sale support. Every order we get receives detailed attention from start to finish ... and beyond.

								p.
									Our company is committed to providing superior customer service and added value to dealers around the world who are on the market for machine tools of every kind, for every application: boring and milling machines, lathes, horizontal and vertical machining centers, and horizontal and vertical turning centers. Simply put, Lymco dealers get more than just equipment, they get:

								ul
									li ▪ Quality machines that perform 100% to specifications - our engineers carry out two detailed quality assurance inspections and test-run every single machine prior to shipment.
									li ▪ Follow- up throughout the manufacturing processes at every critical stage of each order to ensure timely delivery of machines.
									li ▪ Efficiency through a computerized sales management system.
									li ▪ Customer support before and after the sale that includes feasibility studies, training and service programs.
									li ▪ Consolidation of the best shipping practices to save on freight expenses.
									li ▪ Responses for every inquiry within 24 to 48 hours.
									li ▪ Professional staff engineers who can help troubleshoot problems on any machine after delivery.
									li ▪ Competitive pricing thanks to our long-standing relationships with our machine builders.

								p.
									When you partner with Lymco, you invest in our company's history, expertise and service-an investment that will pay off for years to come, not only for you but for your customers as well. As a Lymco dealer, you'll provide customers with benefits that make a positive difference to their financial health: reliable long-lasting equipment, higher productivity, faster output, and more satisfied customers of their own. 
				section
					.container.restrict-large
						.block
							h1 ALL THE<br>ANSWERS
							p.
								We know you wish not having to worry about half the things you worry about today.
							p We understand that suppliers delivering on-time and within your required specs is essential.<br>We realize that talking to someone who actually cares about you, let alone understands your language, is really important. And its even better if he has the answers to your questions.<br>We see that you want a wide choice of quality machines to choose from, all of which have been certified to be reliable and performant.

							p We get it.

							p Lymco is the answer to everything you have been looking for.<br>Lymco is almost certainly the CNC machine tool expert that will make your day a whole lot sweeter. With a deep understanding of how to make machines, we are constantly developing ahead of market trends and needs. We design, manufacture and supply within and beyond the specs of our clients; And we make sure that these machines continue to function for years to come.

							p Lymco brings you closer to what you have been looking for.
							
							p THE EASY CHOICE
						.block
							img(src="../assets/images/components/about-people.png")

				section
					.title
						img(src="../assets/images/components/about-csr-title.png")
					.slider-wrapper
						#slider
							each i in Array(3)
								.item
									.overlay
										.container.restrict-large
											p.
												Votre veille est pilotée par un Directeur de Clientèle et réalisée par nos veilleurs. Salariés en CDI, Bac +5 et trilingues, notre équipe de veille est une garantie de stabilité et d’expertise dans la gestion de vos problématiques.
					.container.restrict
						p Votre veille est pilotée par un Directeur de Clientèle et réalisée par nos veilleurs. Salariés en CDI, Bac +5 et trilingues, notre équipe de veille est une garantie de stabilité et d’expertise dans la gestion de vos problématiques. Nos veilleurs s’appuient également sur l’ensemble des métiers de Reputation Squad (social media, juridique, SEO, influence, etc.) pour une analyse fine de vos enjeux et de vos parties prenantes.
</template>

<script>
import Navigation from './Navigation.vue'
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
      msg: 'Hello Vue'
    }
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    $('#slider').slick({
      dots: true
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
	@import "src/assets/styles/general/helper/helper";
	
	#about {
		background-color: $darkestgray;
		color: $white;
		section {
			&:first-child {
				padding: 4em 0;
				.title {
					border-bottom: 1px solid $main;
					padding: 6em 0;
					img {
						margin: 0;
					}
				}
			}
			&:nth-child(2) {
				background-color: white;
				padding: 2em 0;
				.inner {
					transition: .3s all ease;
					background-image: url('../assets/images/components/about-bg-1.png');
					background-size: auto 100%;
					background-position: left center;
					background-repeat: no-repeat;
					color: $black;
					padding: 8em 0;
					@include breakpoint(768px) {
						padding: 12em 0;
					}
					@include breakpoint(1200px) {
						background-position: -560px center;
						.content {
							@include span(7 of 12);
						}
					}
					@include breakpoint(1300px) {
						background-position: -440px center;
						
					}
					@include breakpoint(1680px) {
						background-position: right center;
					}
				}
				.container {
					position: relative;
					@extend .clr;
				}
				.title {
					background-color: $white;
					color: $main;
					padding: 1em 4em;
					position: absolute;
					display: inline-block;
					vertical-align: middle;
					margin: 0 1em;
					top: -12em;
					left: 0;
					box-shadow: 0 0 3px rgba($black, .33);
					max-width: 340px;
					@include breakpoint(768px) {
						top: -18em;
					}
				}
			}
			&:nth-child(3) {
				background-image: url('../assets/images/components/about-bg-2.png');
				background-size: auto 90%;
				background-repeat: no-repeat;
				background-position: left top;
				.container {
					padding-bottom: 0;
					@extend .clr;
				}
				@include breakpoint(1024px) {
					
				} 
				@include breakpoint(1280px) {
					background-position: right top;
					padding-top: 6em;
					.block {
						width: 40%; 
						display: table-cell;
						vertical-align: middle;
						&:first-child {
							padding-bottom: 4em;
						}
						&:last-child {
							width: 60%;
							vertical-align: bottom;
						}
					}
				}
			}
			&:last-child {
				padding: 3em 0;
				background-color: $main;
				background-image: url('../assets/images/components/about-bg-3.png');
				background-position: center;
				background-repeat: no-repeat;
				.slider-wrapper {
					height: 40vh;
					margin: 2em 0;
					@include breakpoint(1024px) {
						height: 50vh; 
					}
					@include breakpoint(1680px) {
						height: 60vh;
					}
				}
				#slider {
					margin: 2em 0;
					height: 100%;
					overflow: hidden; 
					.item {
						height: 100%; 
						position: relative;
						background-image: url('../assets/images/components/about-csr-slide-1.png');
						background-position: center;
						background-size: cover;
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
									color: $white;
									border: 1px solid $white;
									background-color: transparent;
									opacity: 1; 
								}
							}
							&.slick-active {
								button {
									&:before {
										background-color: $white;
									}
								}
							}
						}
					}
					img {
						width: 100% 
					}
					.overlay {
						position: absolute;
						bottom: 0;
						background-color: rgba($black, .66);
						width: 100%; 
					}
				}
			}
		}
	}
</style>