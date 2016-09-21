<template lang="pug">
	#subscription
		h1 Subscription
		a.btn.basic(@click="leaveSubscription") CLOSE
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
		background-color: $gray;
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
		z-index: 9999;
	}
</style>