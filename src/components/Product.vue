<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength")
            #product(v-if="product")
                section.product-single-wrapper
                    header(v-bind:style="'background-image: url(' + product.backgroundimage + ');'")
                        .background
                        .container.restrict-large
                            .title
                                h1
                                    |   PRODUCTS
                                    span.bold {{ product.name }}
                            .product-image
                                img(v-bind:src="product.image")

                    .product-single-inner.restrict-large
                        .container.restrict-small
                            .content {{ product.description }}
                            .call-action.right
                                a.btn.btn-with-icon(v-bind:href="product.brochure")
                                    span DOWNLOAD BROCHURE
                                    .fa.fa-plus.fa-lg
                                a.btn.btn-with-icon(@click="addInquiry(product.id)", href="javascript:;")
                                    span INQUIRY
                                    .fa.fa-plus.fa-lg
                        
                        
                        .media-slider.restrict
                            .item(v-for="slide in product.media")
                                iframe(v-if="slide.type === 'video'", width="800", height="450", v-bind:src="slide.url", frameborder="0" allowfullscreen)
                                img(v-else, v-bind:src="slide.url")

                section.product-single-specs
                    .spec-selectors
                        a.selector(@click="selectFeature", :class="{ active: !spec}") Main Features
                        a.selector(@click="selectSpec", :class="{ active: spec}") Line Up & Specifications

                    .spec-contents
                        .content(v-show="!spec")
                            .container.restrict
                                .features-list
                                    .feature(v-for="feature in product.features")
                                        h3 {{ feature.title }}
                                        .description(v-html="feature.description")
                        .content(v-show="spec")
                            .container.restrict-large
                                .data-group(v-for="table in splitTable")
                                    table
                                        thead
                                            tr
                                                th(width="14%")
                                                th(v-for="model in table", width="14%") {{ model.name }}
                                        tbody
                                            tr(v-for="(spec,index) in product.specification.columns")
                                                th {{ spec.name }}
                                                td(v-for="model in table") {{ model.spec[index] }}

                section#discover
                    a(href="javascript:;") BACK TO TOP
                            
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
import Inquiry from '../cart/inquiry'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
require('imports?$=jquery!../assets/vendor/slick.min.js')
require('imports?$=jquery!../assets/vendor/jquery.fitvids.js')

export default {
  components: {
    'page-navigation': Navigation
  },
  data () {
    return {
      loading: false,
      product: null,
      error: null,
      spec: false,
      inquiryLength: 0
    }
  },
  created () {
  },
  mounted () {
    this.fetchData()
    this.updateCount()
  },
  watch: {
    'this.inquiryLength': 'updateCount'
  },
  computed: {
    splitTable: function () {
      var createGroupedArray = function (arr, chunkSize) {
        var groups = []
        var i
        for (i = 0; i < arr.length; i += chunkSize) {
          groups.push(arr.slice(i, i + chunkSize))
        }
        return groups
      }
      var groupArr = createGroupedArray(this.product.specification.models, 6)
      return groupArr
    }
  },
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      Api.getProduct(this.$route.params.id, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.product = data
          this.initSlick()
        }
      })
    },
    selectFeature () {
      console.log('selectFeature')
      this.spec = false
    },
    selectSpec () {
      console.log('selectSpec')
      this.spec = true
    },
    initSlick () {
      console.log('init')
      this.$nextTick(function () {
        $('.media-slider').slick({
          dots: true,
          arrows: false
        })
        $('.media-slider').fitVids()
      })
    },
    addInquiry (id) {
      Inquiry.add(id)
    },
    removeInquiry () {
      Inquiry.remove()
    },
    updateCount () {
      this.inquiryLength = Inquiry.getLength()
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
    #product {}
    .media-slider {
        padding: 0;
        box-shadow: 3px 3px 3px rgba($black,.33);
        img {
            width: 100%; 
        }
        .slick-dots {
            bottom: -3em;
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
    .product-single-wrapper {
        padding-bottom: 4em;
        header {
            position: relative;
            padding: 2em 0;
            background-repeat: no-repeat;
            background-size: cover;
            .title {
                color: $white;
                border-bottom: 1px solid $main;
                margin-bottom: 3em;
                h1 {
                    font-size: 3.6em;
                    line-height: 1;
                    span {
                        display: block;
                    } 
                }
            }
            .container {
                position: relative;
                z-index: 2;
            }
            .background {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                background-image: url('../assets/images/components/product-overlay.png');
                background-size: auto 100%;
                background-position: top left;
                background-repeat: no-repeat;
                transition: .3s all ease;
                z-index: 1;
                
                @include breakpoint(1440px) {
                    background-position: top right;
                }
            }
        }
    }
    .product-single-specs {
        .spec-selectors {
            font-size: 1.4em;
            font-family: $bold-sans-serif;
            @extend .clr;
            text-align: center;
            a {
                cursor: pointer;
                color: $gray;
                @include gallery(6 of 12 0);
                display: block;
                border-bottom: 4px solid $gray;
                transition: .3s all ease;
                position: relative;
                &:hover, &.active {
                    color: $main;
                    border-color: $main;
                    &:after {
                        content: '';
                        width: 0;
                        height: 0;
                        border-style: solid;
                        border-width: 16px 17px 0 17px;
                        border-color: $main transparent transparent transparent;
                        display: block;
                        position: absolute;
                        top: 100%;
                        left: 50%;
                        margin-left: -16px;
                    }
                }
            }
        }
        .spec-contents {
            background-color: $darkestgray;
            background-image: url('../assets/images/components/product-detail-bg-1.png');
            background-position: center 100px;
            background-size: cover;
            .content {
                padding: 4em 0;
                color: $white;
                .features-list {
                    @extend .clr;
                    .feature {
                        @include breakpoint(768px) {
                            @include gallery(6 of 12);
                        }
                        @include breakpoint(1024px) {
                            @include gallery(4 of 12);
                        }
                    }
                }
                h3 {
                    background-color: $main;
                    border-radius: 1em;
                    padding: 0 1em;
                }
            }
            .data-group {
                margin-bottom: 2em;
                padding: 2em;
                box-sizing: border-box;
                border: 1px solid $white;
            }
            table {
              width: 100%;
              text-align: center;
              th,td {
                padding: .8em;
              }
              thead {
                tr {
                    color: $main;
                    th {
                        background-color: rgba($white,.1);
                        &:first-child {
                            background-color: transparent;
                        }
                        &:nth-child(2) {
                            border-top-left-radius: 2em;
                            border-bottom-left-radius: 2em;
                            
                        }
                        &:last-child {
                            border-top-right-radius: 2em;
                            border-bottom-right-radius: 2em;
                        }
                    }
                }
              }
              tbody {
                td {
                    border-bottom: 1px solid $darkgray;
                }
              }
            }
        }
    }
</style>