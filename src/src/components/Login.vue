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
                    .captcha-image
                      span {{captcha}}
                .grid.g-10-12
                  .controlgroup
                    input.rounded(v-model="signin.captcha" type="text", placeholder="Captcha")
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
                    .captcha-image
                      span {{captcha}}
                .grid.g-10-12
                  .controlgroup
                    input.rounded(type="text", placeholder="Captcha")
              .controlgroup
                button.btn.rounded.green.full(@click.prevent="submitForgot", type="submit") Send
      a#close(@click="leaveLogin") X
</template>

<script>
import Api from '../api'
import Auth from '../auth/auth'
export default {
  data () {
    return {
      loading: false,
      data: null,
      error: null,
      captcha: null,
      signin: {
        username: null,
        password: null,
        captcha: null
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
    this.getCaptcha()
  },
  updated () {
  },
  methods: {
    getCaptcha () {
      Api.getCaptcha((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.captcha = data
        }
      })
    },
    leaveLogin () {
      this.$parent.$emit('leaveLogin')
    },
    submitSignin () {
      var loginData = {
        account: this.signin.username,
        password: this.signin.password,
        captcha: this.signin.captcha
      }
      Api.login(loginData, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          Auth.save(data)
          this.$parent.$emit('isLogin')
        }
      })
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
    #close {
      position: absolute;
      right: 0;
      top: 0;
      padding: .4em .8em;
      color: $main;
      font-size: 2em;
      cursor: pointer;
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
    .captcha-image {
      background-color: darken($darkgray, 15%);
      color: $main;
      text-align: center;
      line-height: 36px;
      font-size: 1.6em;
      user-select: none;
      border-radius: 18px;
      span {
        filter: blur(.04em);
      }
    }
  }
</style>
