<template lang="pug">
  #login
    .login-wrapper
      .container.restrict-large
        .row
          .block
            h4 WELCOME LOGIN
            form#login-form
              .row
                .grid.g-6-12
                  .controlgroup
                    input.rounded(type="text", placeholder="User Name", v-model="signin.username")
                .grid.g-6-12
                  .controlgroup
                    input.rounded(type="password", placeholder="Password", v-model="signin.password")
              .row
                .grid.g-2-12
                  .controlgroup
                    img(src="http://unsplash.it/100/44")
                .grid.g-10-12
                  .controlgroup
                    input.rounded(type="text", placeholder="Captcha")
              .controlgroup
                button.btn.rounded.green.full(@click.prevent="submitSignin", type="submit") Send
          .block
            h4 FORGOT PASSWORD
            form#forgetPasswordForm
              .controlgroup
                input.rounded(type="email", placeholder="Email")
              .row
                .grid.g-2-12
                  .controlgroup
                    img(src="http://unsplash.it/100/44")
                .grid.g-10-12
                  .controlgroup
                    input.rounded(type="text", placeholder="Captcha")
              .controlgroup
                button.btn.rounded.green.full(@click.prevent="submitForgot", type="submit") Send
    .call-action.centered
      a#close.btn.basic(@click="leaveLogin") CLOSE
</template>

<script>
import Api from '../api'
export default {
  data () {
    return {
      loading: false,
      data: null,
      error: null,
      signin: {
        username: null,
        password: null
      }
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
    leaveLogin () {
      this.$parent.$emit('leaveLogin')
    },
    submitSignin () {
      //
    },
    submitForgot () {
      //
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
	#login {
		background-color: rgba($darkgray, .9);
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
		z-index: 9999;
    box-shadow: 0 0 6px rgba($black, .66);
    h4 {
      color: $white;
    }
    .call-action {
      padding-bottom: 0;
      a {
        cursor: pointer;
      }
    }
	}
  .login-wrapper {
    &>.container {
      &>.row {
        &>.block {
          margin-bottom: 2em;
          &:last-child {
            border-top: 2px solid $white;
          }
          @include breakpoint(768px) {
            @include span(6 of 12 1 inside);
            margin-bottom: 0;
            &:last-child {
              border-top: 0;
              border-left: 2px solid $white;
              @include last;
            }
          }
        }
      }
    }

  }
</style>
