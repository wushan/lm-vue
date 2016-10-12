<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
            transition(name="fade", mode="out-in")
                my-inventory(v-if="inventory")
            #category(v-if="data")
                section#category-highlights
                    .container.restrict-large
                        .title
                            h1
                                |   PRODUCT
                                span.bold SERIES
                    .container.restrict-large
                        .row
                            .block
                                #highlight-slider
                                    .item(v-for="slide in data.highlightproduct")
                                        .thumbnail
                                            img(v-bind:src="slide.image")
                                        .content
                                            h1
                                                |   {{ slide.name }}
                                                small.bold {{ slide.model }}
                                            .context(v-html="slide.description")
                                            .call-action
                                                router-link.btn.btn-with-icon.dark(:to="'/product/single/' + slide.id", href="javascript:;")
                                                    span DETAIL
                                                    .fa.fa-angle-right.fa-lg
                            .block
                                #products-inventory
                                    .title
                                        h1
                                            |   PRODUCTS
                                            span.bold INVENTORY
                                    .call-action
                                        router-link.btn.btn-with-icon.white(:to="'inventory'")
                                            span DETAIL
                                            .fa.fa-angle-right.fa-lg
                                
                section#gap
                    a(href="javascript:;")
                        span.bold SCROLL
                        img(src="../assets/images/components/scrolljar.png")
                #category-list
                    .category.track-animate(v-for="category in data.categories", v-bind:id="'series' + category.id")
                        .coverage(v-bind:style="'background-image: url(' + category.image + ');'")
                            img(v-bind:src="category.image")
                        .content
                            .container.restrict
                                h1(v-html="category.name")
                                .context(v-html="category.description")
                                ul
                                    li(v-for="product in category.products")
                                        router-link(:to="'/product/single/' + product.id") {{ product.name }}
                                .product-slider
                                    .item(v-for="product in category.products")
                                        router-link(:to="'/product/single/' + product.id")
                                            img(v-bind:src="product.thumbnail")
                        
                section#discover
                    a(href="javascript:;") BACK TO TOP
        transition(name="fade", mode="out-in")
            #loader(v-if="loading")
                .uil-ring-css(style="transform:scale(0.6);")
                    div
</template>

<script>
import Navigation from './Navigation.vue'
import Inventory from './Inventory.vue'
import Api from '../api'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
require('imports?$=jquery!../assets/vendor/slick.min.js')
export default {
  components: {
    'page-navigation': Navigation,
    'my-inventory': Inventory
  },
  props: ['inquiryLength', 'submenu'],
  data () {
    return {
      loading: false,
      data: null,
      error: null,
      inventory: false
    }
  },
  created () {
    this.$on('leaveInventory', function (res) {
      this.$router.replace('series')
    })
    if (this.$route.name === 'inventory') {
      // 自動開啟，條件還缺登入
      this.inventory = true
    }
  },
  mounted () {
    this.fetchData()
  },
  updated () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
  },
  watch: {
    '$route': 'toggleInventory'
  },
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      Api.getCategories((err, data) => {
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
        $('#highlight-slider').slick({
          dots: true,
          arrows: false
        })
        $('.product-slider').each(function (idx, item) {
          var carouselId = 'carousel' + idx
          this.id = carouselId
          $(this).slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '0px'
          })
        })
      })
    },
    toggleInventory () {
      console.log(this.$route)
      if (this.$route.name === 'inventory') {
        this.inventory = true
        $('body').css('overflow', 'hidden')
      } else {
        this.inventory = false
        $('body').css('overflow', 'auto')
      }
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
    #category{
        background-color: $main;
        .title {
            color: $white;
            h1 {
                font-size: 3.6em;
                line-height: 1; 
                span {
                    display: block;
                }
            }
        }
    }
    #products-inventory {
        background-color: $darkestgray;
        padding: 2em;
        box-sizing: border-box;
        text-align: center;
        .title {
            h1 {
                margin-top: 0;
            }
        }
        .call-action {
            padding: 0;
        }
        @include breakpoint(1280px) {
            background-color: transparent;
            text-align: right;
            position: absolute;
            bottom: 5%;
            right: 1em;
            .title {
                h1 {
                    margin: 0;
                    font-size: 3em;
                }
            }
            .call-action {
                padding: .5em 0;
            }
        }
    }
    #category-highlights {
        position: relative;
        #highlight-slider {
            border-top: 1px solid $white;
            padding-top: 2em;
            margin-bottom: 4em;
            .slick-list, .slick-track {
                height: 100%;
            }
            .slick-dots {
                bottom: -2.4em;
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
                            color: $black;
                            border: 1px solid $black;
                            background-color: transparent;
                            opacity: 1; 
                        }
                        &:hover {
                            &:before {
                                background-color: $black;
                            }
                        }
                    }
                    &.slick-active {
                        button {
                            &:before {
                                background-color: $black;
                            }
                        }
                    }
                }
            }
        }
        h1 {
            small {
                display: block;
                color: $white;
            }
        }
        .call-action {
            padding-bottom: 0;
            a {
                margin: 0;
            }
        }
        .item {
            @extend .clr;
            img {
                width: 100%;
            }
            @include breakpoint(768px) {
                h1 {
                    margin: 0;
                }
                .thumbnail {
                    @include span(6 of 12 1);
                }
                .content {
                    @include span(6 of 12 1 last);
                }
            }
        }
        @include breakpoint(1280px) {
            .block {
                @include span(8 of 12 1);
                &:last-child {
                    @include span(4 of 12 1 last);
                    position: absolute;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    background-image: url('../assets/images/components/product-bg-1.png');
                    background-repeat: no-repeat;
                    background-size: auto 95%;
                    background-position: left top;
                }
            }
        }
    }
    #category-list {
        background-color: $smokygray;
        overflow: hidden;
        .category {
            @extend .clr;
            .coverage {
                background-position: center;
                background-size: cover;
                box-shadow: 3px 3px 6px 3px rgba($black, .33);
            }
            .coverage, .content {
                background-color: $darkgray;
                h1 {
                    color: $main;
                }
            }
            .content {
                h1 {
                    height: 5em;
                    overflow: hidden;
                    line-height: 1.4; 
                    
                }
                .context {
                    height: 10em;
                    overflow: hidden;
                }
            }
            ul {
                margin: 2em 0;
                padding: 0;
                list-style-type: none;
                li {
                    margin-bottom: .5em;
                    a {
                        color: $darkgray;
                        display: inline-block;
                        vertical-align: middle;
                        padding: 0 1em;
                        border-left: 2px solid $main;
                        &:after {
                            content: '\25b8';
                            color: $main;
                            display: inline-block;
                            vertical-align: middle;
                            margin-left: .5em;
                        }
                    }
                }
            }
            &:nth-child(odd) {
                .content {
                    background-color: $smokygray;
                }
            }
            &:nth-child(even) {
                .context {
                    color: $white;
                }
                .coverage {
                }
                ul {
                    li {
                        a {
                            color: $white;
                        }
                    }
                }
            }
            @include breakpoint(768px) {
                display: flex;
                .coverage, .content {
                    width: 50%; 
                }
                .coverage {
                    img {
                        display: none;
                    }
                }
                &:nth-child(odd) {
                    .content {
                        
                    }
                }
                &:nth-child(even) {
                    .context {
                    }
                    .coverage {
                        order: 2;
                    }
                }
            }
            @include breakpoint(1024px) {
                margin: 10em 0;
                position: relative;
                .coverage, .content {
                    width: 55%;
                }
                .content {
                    box-sizing: border-box;
                }
                .coverage {
                    position: absolute;
                    top: 50%;
                    height: 100%; 
                    img {
                        display: block;
                        position: absolute;
                        right: 0;
                        left: 0;
                        margin: auto;
                    }
                }
                &:nth-child(odd) {
                    justify-content: flex-end;
                    .coverage {
                        transform-origin: top right;
                        transform: skew(-10deg) translateY(-65%) translateX(-4%) scale(1.1);
                        overflow: hidden;
                        z-index: 2;
                        left: 0;
                        img {
                            transform-origin: top right;
                            transform: skew(10deg) scale(1.2) translate(10%, -50%);
                            top: 50%;
                        }
                    }
                    .content {
                        border: 2px solid $main;
                        transform-origin: bottom right;
                        transform: skew(-10deg);
                        overflow: hidden;
                        padding: 4em 2em 4em 10em;
                        .container {
                            transform-origin: bottom right;
                            transform: skew(10deg);
                        }
                    }
                }
                &:nth-child(even) {
                    .coverage {
                        transform-origin: bottom right;
                        transform: skew(-10deg) translateY(-55%) translateX(-9%) scale(1.1);
                        overflow: hidden;
                        right: 0; 
                        z-index: 2;
                        img {
                            transform-origin: bottom right;
                            transform: skew(10deg) scale(1.2) translate(0, 50%);
                            bottom: 50%;
                        }
                    }
                    .content {
                        transform-origin: top right;
                        transform: skew(-10deg);
                        overflow: hidden;
                        padding: 4em 10em 4em 2em;
                        
                        .container {
                            transform-origin: top right;
                            transform: skew(10deg);
                        }
                    }
                }
            }
            @include breakpoint(1280px) {
                &:nth-child(odd) {
                    .content {
                        padding: 4em 2em 4em 16em;
                    }
                    .coverage {
                        transform-origin: top right;
                        transform: skew(-10deg) translateY(-65%) translateX(-4%) scale(1.1);
                        img {
                            transform: skew(10deg) scale(1.1) translate(10%, -50%);
                        }
                    }
                }
                &:nth-child(even) {
                    .content {
                        padding: 4em 16em 4em 2em;
                    }
                    .coverage {
                        transform-origin: bottom right;
                        transform: skew(-10deg) translateY(-55%) translateX(-7%) scale(1.1);
                        img {
                            transform: skew(10deg) scale(1.1) translate(0, 50%);
                        }
                    }
                }
            }
            @include breakpoint(1440px) {
                &:nth-child(odd) {
                    
                }
                &:nth-child(even) {
                    .coverage {
                        transform-origin: bottom right;
                        transform: skew(-10deg) translateY(-55%) translateX(-3%) scale(1.1);
                        img {
                            transform: skew(10deg) scale(1.1) translate(0, 50%);
                        }
                    }
                }
            }
        }
    }
    .product-slider {
        padding: 0 2em;
        box-sizing: border-box;
        img {
            width: 100%; 
        }
        .slick-track {
            padding: 1em 0;
        }
        .slick-slide {
            margin: 0 .5em;
            box-shadow: 3px 3px 3px rgba($black, .33);
            position: relative;
            &:before, &:after {
                pointer-events: none;
                content: '';
                transition: .3s all ease;
                border-color: $main;
            }
            a {
                &:before {
                    transition: .3s all ease;
                    pointer-events: none;
                }
            }
            &:hover {
                &:after {
                    content: '';
                    display: block;
                    border: 4px solid $main;
                    position: absolute;
                    top: 0;
                    right: 0;
                    bottom:0;
                    left: 0;
                }
                &:before {
                    position: absolute;
                    right: 0;
                    bottom: 0;
                    content: '';
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 0 0 50px 50px;
                    border-color: transparent transparent $main transparent;
                }
                a {
                    &:before {
                        content: '';
                        position: absolute;
                        right: 0;
                        bottom: 0;
                        width: 30px;
                        height: 30px;  
                        background-image: url('../assets/images/components/pointer-arrow.png');
                        background-position: center;
                        background-repeat: no-repeat;
                    }
                }
            }
        }
        .slick-prev, .slick-next {
            width: 11px;
            height: 33px;
            &:before {
                display: block;
                content: '';
                width: 11px;
                height: 33px;
            } 
        }
        .slick-prev {
            left: 0;
            &:before {
                background-image: url('../assets/images/components/green-arrow-prev.png');
                background-position: center;
            }
        }
        .slick-next {
            right: 0;
            &:before {
                background-image: url('../assets/images/components/green-arrow-next.png');
                background-position: center;
            }
        }
    }
    #gap {
        background-color: $darkgray;
        padding: 2em 0;
        a {
            color: $main;
            text-align: center;
            display: block;
        }
        span {
            display: block;
        }
    }
</style>