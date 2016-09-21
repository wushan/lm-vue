<template lang="pug">
	#inventory(v-if="inventory")
		.inventory-wrapper
			.container.restrict-large
				.title
					h1
						| PRODUCT
						span.bold INVENTORY
			.inventory-inner
				.container.restrict-large
					ul.inventory-list
						li(v-for="item in data")
							.thumbnail
								img(v-bind:src="item.image")
							.content
								.name {{ item.name }}
								.description(v-html="item.description")
								.call-action
									a.btn.btn-with-icon.white(@click="sendToInquiry(item.id)", href="javascript:;")
										span INQUIRE
										.fa.fa-plus.fa-lg

		a.leave-inventory(@click="leaveInventory")
			.fa.fa-times.fa-lg

</template>

<script>
import Api from '../api'
export default {
  props: ['inventory'],
  data () {
    return {
      loading: false,
      data: null,
      error: null
    }
  },
  created () {
    console.log(this)
    if (this.$route.name === 'inventory') {
      this.inventory = true
    }
  },
  mounted () {
    this.fetchData()
  },
  updated () {
  },
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      Api.getInventory((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.data = data
        }
      })
    },
    sendToInquiry (id) {
      console.log(id + ' sent')
    },
    leaveInventory () {
      console.log(this.$parent.inventory)
      // this.$parent.inventory = false
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
	#inventory {
		position: fixed;
		top: 0;
		bottom: 0;
		right: 0;
		left: 0;
		z-index: 999;
		background-color: rgba($black, .8);
		color: $white;
	}
	.inventory-wrapper {
		height: 100%;
		overflow: scroll;
		.title {
			h1 {
				font-size: 3.6em;
				line-height: 1;
				span {
					display: block;
				} 
			}
		}
	}
	.inventory-list {
		margin: 0;
		padding: 0;
		list-style-type: none;
		@extend .clr;
		img {
			width: 100%;
		}
		.thumbnail {
			margin-bottom: 1em;
			border: 1px solid $white;
			box-sizing: border-box;
		}
		.name {
			font-size: 1.6em;
			font-family: $bold-sans-serif;
			margin-bottom: .5em;
		}
		.call-action {
			a {
				margin: 0;
			}
		}
		li {
			@extend .clr;
			margin-bottom: 1em;
			border-bottom: 1px dotted $white;
			padding: 1em 0;
			@include breakpoint(768px) {
				.thumbnail {
					@include span(3 of 12 1);
				}
				.content {
					@include span(9 of 12 1 last);
				}
			}
		}
	}
	.leave-inventory {
		position: absolute;
		top: 1em;
		right: 1em;
		color: $main;
		font-size: 2em;
	}
</style>