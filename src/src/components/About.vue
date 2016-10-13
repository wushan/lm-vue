<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
            #about
                section
                    .container.restrict-large
                        .title
                            img(src="../assets/images/components/about-heading.png")
                    .container.restrict.track-animate.os
                        h2(v-if="data", v-html="data.titleA")
                        .content(v-if="data", v-html="data.contentA")
                section
                    .inner
                        .container.restrict-large
                            .title
                                h2.track-animate(v-if="data", v-html="data.titleB")
                            .content.track-animate(v-if="data", v-html="data.contentB")
                section
                    .container.restrict-large
                        .block.track-animate
                            h1.track-animate(v-if="data", v-html="data.titleC")
                            .content(v-if="data", v-html="data.contentC")
                        .block
                            img(v-if="data", v-bind:src="data.imageC")

                section
                    .title
                        img(src="../assets/images/components/about-csr-title.png")
                    .slider-wrapper
                        #slider(v-if="data")
                            .item(v-for="slide in data.slides", :style="'background-image: url(' + slide.image + ');'")
                                .overlay
                                    .container.restrict-large(v-html="slide.paragraph")

                    .container.restrict.track-animate(v-if="data", v-html="data.contentD")
                      
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
require('imports?$=jquery!../assets/vendor/slick.min.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength', 'submenu'],
  data () {
    return {
      loading: false,
      data: null
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
  },
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      Api.getAbout((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.data = data
          this.initSlick()
        }
      })
    },
    initSlick () {
      this.$nextTick(function () {
        $('#slider').slick({
          dots: true
        })
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
                    @include breakpoint(1024px) {
                        .content {
                            max-width: 960px;
                            padding: 0 1rem;
                            margin: 0 auto;
                            box-sizing: border-box;
                        }
                    }
                    @include breakpoint(1200px) {
                        background-position: -730px center;
                        .content {
                            max-width: none;
                            @include span(7 of 12);
                            margin-left: 6%;
                            padding: 0;
                        }
                    }
                    @include breakpoint(1300px) {
                        background-position: -600px center;
                        
                    }
                    @include breakpoint(1680px) {
                        background-position: right center;
                        .content {
                            margin-left: 0;
                        }
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
                    .block {
                        &:first-child {
                            h1 {
                                line-height: 1;
                            }
                        }
                    }
                }
                @include breakpoint(1024px) {
                    .block {
                        &:first-child {
                            max-width: 960px;
                            padding: 0 1rem;
                            margin: 0 auto;
                            box-sizing: border-box;
                        }
                    }
                } 
                @include breakpoint(1280px) {
                    background-position: right top;
                    padding-top: 6em;
                    .block {
                        width: 40%; 
                        display: table-cell;
                        vertical-align: middle;
                        &:first-child {
                            max-width: none;
                            padding-left: 3em;
                            padding-bottom: 4em;
                            margin: 0;
                        }
                        &:last-child {
                            width: 60%;
                            vertical-align: bottom;
                        }
                    }
                }
                @include breakpoint(1680px) {
                    .block {
                        &:first-child {
                            padding-left: 0;
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
                    // overflow: hidden; 
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