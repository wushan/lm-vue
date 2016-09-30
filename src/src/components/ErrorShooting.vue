<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength")
            #errorshooting
                section.errorshooting-wrapper.middler-wrapper
                  .middler
                    .container.restrict-large
                        .title.centered
                            h1 ERROR SHOOTING
                    .container.restrict-small
                        form#searchForm.machine-search-form
                            .controlgroup
                                .controls
                                    input.rounded(type="text", placeholder="Input Error Code", v-model="errorcode" @keyup="searching")
                                    .fa.fa-search.fa-2x
                                    .machine-type(v-if="isSearching")
                                        h5 Please Select Machine Type
                                        ul.machine-type-list
                                            li(v-for="model in models")
                                                a.type(@click="startSearch(model.id)") {{ model.name }}

                    .container.error-list(v-if="searchResults")
                        .restrict-large
                            .error-pagination
                                a(href="javascript:;")
                                    .first-step
                                    span FIRST STEP
                                a(href="javascript:;")
                                    .prev-step
                                    span PREV STEP
                            ul
                                each i in Array(4)
                                    li
                                        .title
                                            a.btn.rounded.green.full(href="javascript:;")
                                                span Status A
                                                .fa.fa-lg.fa-caret-right
                                        .error-message
                                            .content
                                                .description
                                                    p.
                                                        eq;oeiw roguh erogu erogi herqpg943 glh er 0r98e ;pierhg er08eroi34g;i er0 aerg098ergpi ea[0r8gierhi her hg h- g;porehg er98g ergjer  089rg epr9u= rehg'49gber eriogj;apig e;prigher'piojerg pihgihgiegirehl goer hg;opi hgo;i hio i ]
                                                .thumbnail
                                                    img(src="../assets/images/components/errorshooting.png")
                                                .download
                                                    a.btn.rounded.green.full.centered(href="javascript:;") PDF DOWNLOAD

        transition(name="fade", mode="out-in")
            #loader(v-if="loading")
                .uil-ring-css(style="transform:scale(0.6);")
                    div
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
let timer
export default {
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength'],
  data () {
    return {
      loading: false,
      errorcode: '',
      isSearching: false,
      models: null,
      selectedModel: '',
      searchResults: null
    }
  },
  created () {
    this.fetchData()
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    console.log(this.inquiryLength)
  },
  methods: {
    fetchData () {
      this.error = this.dealer = null
      this.loading = true
      Api.getMachine((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.models = data
        }
      })
    },
    searching () {
      if (this.isSearching) {
        clearTimeout(timer)
        timer = setTimeout(() => {
          this.isSearching = false
          console.log('tick')
        }, 3000)
      } else {
        this.isSearching = true
        console.log('searching')
        timer = setTimeout(() => {
          this.isSearching = false
          console.log('tick')
        }, 3000)
      }
    },
    startSearch (id) {
      this.selectedModel = id
      this.error = this.dealer = null
      this.loading = true
      this.isSearching = false
      Api.getSolution(id, this.errorcode, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.searchResults = data
          this.$router.replace('/errorshooting/' + id + '/' + this.errorcode)
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
    #errorshooting {
        background-color: $darkgray;
        color: $white;
        padding: 2em 0;
        box-sizing: border-box;
        background-image: url('../assets/images/components/error-bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: left bottom;
        transition: .3s all ease;
        min-height: 100vh;
        @include breakpoint(1280px) {
            background-size: auto 90%;
            background-position: right top;
        }
        @include breakpoint(1680px) {
            background-position: right top;
        }
        .title {
            h1 {
                margin: 0;
                color: $main;
            }
        }
        .errorshooting-wrapper {
          .middler {
            width: 100%; 
          }
        }
        .machine-type {
            background-color: rgba($black, .8);
            border-radius: 0 0 6px 6px;
            width: 90%;
            margin: auto; 
            box-sizing: border-box;
            padding: 1em 0;
            position: absolute;
            top: 56px;
            left: 0;
            right: 0;
            z-index: 99;
            text-align: left;
            h5 {
                margin: 0;
                padding: 0 1em;
                color: $main;
            }
            ul {
                padding: 0 0 0 0;
                margin: 1em 0;
                list-style-type: none;
                a {
                    font-size: 1.1em;
                    padding: .3em 0 .3em 3em;
                    display: block;
                    cursor: pointer;
                    &:hover{
                        background-color: $darkestgray;
                    }
                }
            }
        }
        .error-list {
            position: relative;
            &:before {
                content: '';
                border-bottom: 1px solid $white;
                width: 100%;
                position: absolute;
                top: 124px;
                left: 0;
                box-sizing: border-box;
                @include breakpoint(1900px) {
                    top: 80px;
                }
            }
            ul {
                padding: 0 0 0 0;
                margin: 0;
                list-style-type: none;
                @extend .clr;
                position: relative;
                li {
                    margin-top: 4em;
                    padding: 2em 2em 0 2em;
                    border: 1px solid rgba($white, .7);
                    box-sizing: border-box;
                    @include breakpoint(768px) {
                        @include gallery(6 of 12)
                    }
                    @include breakpoint(1280px) {
                        @include gallery(3 of 12 1)
                    }
                    @include breakpoint(1680px) {
                        @include gallery(3 of 12 2)
                    }
                }
                img {
                    width: 100%; 
                }
            }
            .title {
                position: relative;
                top: -3.5em;
                @include breakpoint(1280px) {
                    left: -4em;
                    width: 120%; 
                }
                @include breakpoint(1680px) {
                    left: -6em;
                    width: 130%; 
                }
                a {
                    position: relative;
                    box-shadow: 3px 3px 6px rgba($black, .66);
                }
                .fa {
                    position: absolute;
                    right: .8em;
                    top: .8em;
                }
            }
            .error-message {
                position: relative;
                top: -1.5em;
            }
            .download {
                margin: 2em 0 0 0;
                font-size: 12px;
            }
        }
        .error-pagination {
            text-align: center;
            font-size: 12px;
            @include breakpoint(1900px) {
                position: absolute;
                left: 0;
                top: 5.8em;
            }
            a {
                margin: 0 1em;
                color: $white;
                text-align: center;
                display: inline-block;
                vertical-align: middle;
                span {
                    display: block;
                }
            }
            .prev-step, .first-step {
                width: 25px;
                height: 25px;
                margin: auto;
            }
            .prev-step {
                background-image: url('../assets/images/components/prev-step.png');
            }
            .first-step {
                background-image: url('../assets/images/components/first-step.png');
            }
        }
    }
    .machine-search-form {
        .controls {
          position: relative;
          margin: 0;
        }
        input[type="text"] {
            background-color: $white;
            height: 56px;
            border-radius: 30px;
            padding: 0 0 0 5em;
        }
        .fa {
            color: $black;
            position: absolute;
            left: 1em;
            top: .5em;
        }
    }
</style>