<template lang="pug">
  #subscription
    .subscription-wrapper
      .container.restrict
        h3.blod SUBSCRIBE TO OUR NEWSLETTER
        form#subscription-form
          .row
            .grid.g-4-12
              .controlgroup
                input.rounded(type="text", placeholder="User Name")
            .grid.g-4-12
              .controlgroup
                input.rounded(type="text", placeholder="Company")
            .grid.g-4-12
              .controlgroup
                .select-wrapper.rounded
                  select
                    option Country
                    option USA
          .row
            .controlgroup
              input.rounded(type="email", placeholder="Email")
          .row
            .grid.g-3-12
              .controlgroup
                img(src="http://unsplash.it/100/44")
            .grid.g-6-12
              .controlgroup
                input.rounded(type="text", placeholder="Captcha")
            .grid.g-3-12
              button.btn.rounded.green.full(type="submit") Send
    .call-action.centered
      a#close.btn.basic(@click="leaveSubscription") CLOSE
</template>

<script>
import Api from '../api'
export default {
  data () {
    return {
      loading: false,
      data: null,
      error: null
    }
  },
  created () {
    console.log(this)
    // if (this.$route.name === 'inventory') {
    //   this.inventory = true
    // }
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
    leaveSubscription () {
      this.$parent.$emit('leaveSubscription')
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
	#subscription {
		background-color: rgba($darkgray, .9);
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
		z-index: 9999;
    box-shadow: 0 0 6px rgba($black, .66);
    h3 {
      color: $white;
    }
    .call-action {
      padding-bottom: 0;
      a {
        cursor: pointer;
      }
    }
	}
  .subscription-wrapper {

  }
</style>