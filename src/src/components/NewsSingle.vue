<template lang="pug">
  main
    #main
      page-navigation(v-bind:inquiryLength="inquiryLength")
      #news(v-if="article")
        section#news-single
          header(v-bind:style="'background-image: url('+ article.thumbnail + ');'")
            .container.restrict-large
              h1
                | LATEST
                span.bold NEWS
              hr
              .article-title.centered
                .restrict
                  time.green {{ article.updated_time }}
                  h1 {{ article.title }}
          article.post
            .container.restrict-large
              #news-single-slider
                .item(v-for="slide in article.media")
                  img(v-bind:src="slide.url")
            
            .share-component.restrict
              a.fa.fa-2x.fa-facebook(href="javascript:;")
              a.fa.fa-2x.fa-twitter(href="javascript:;")
              a.fa.fa-2x.fa-google-plus(href="javascript:;")
            .restrict
              .content(v-html="article.content")
          
            .news-navigation.restrict.right
              router-link.btn.rounded(:to="'/news/' + article.pagination.prev.id")
                .fa.fa-angle-left.fa-3x
                span PREV
                span.bold {{ article.pagination.prev.title }}
                
              router-link.btn.rounded(:to="'/news/' + article.pagination.next.id")
                span NEXT
                span.bold {{ article.pagination.next.title }}
                .fa.fa-angle-right.fa-3x
        section#discover
          router-link(:to="'/news/'") BACK TO LIST
      
      #news(v-else)
        section
          p.
            There isn't a matched article during the search.


          

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
  props: ['inquiryLength'],
  data () {
    return {
      loading: false,
      error: null,
      article: null
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
      Api.getNewsSingle(this.$route.params.id, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.article = data
          this.initSlick()
        }
      })
    },
    initSlick () {
      this.$nextTick(function () {
        if (this.article.media.length === 3) {
          $('#news-single-slider').slick({
            infinite: true,
            dots: true,
            arrows: true,
            slidesToShow: this.article.media.length - 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '240px',
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '160px'
                }
              },
              {
                breakpoint: 800,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '100px'
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '100px'
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '50px'
                }
              }
            ]
          })
        } else if (this.article.media.length === 4) {
          $('#news-single-slider').slick({
            infinite: true,
            dots: true,
            arrows: true,
            slidesToShow: this.article.media.length - 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '50px',
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '160px'
                }
              },
              {
                breakpoint: 800,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '100px'
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '100px'
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                  centerMode: true,
                  dots: true,
                  centerPadding: '50px'
                }
              }
            ]
          })
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
  
  #news-single {
    background-color: $smokygray;
    header {
      color: $white;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      position: relative;
      padding: 2em 0 4em 0;
      &:after {
        content: '';
        display: block;
        position: absolute;
        right: 0;
        left: 0;
        bottom: 0;
        height: 200%; 
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+0,000000+99&0.29+0,1+81 */
        background: -moz-radial-gradient(center, ellipse cover,  rgba(0,0,0,0.29) 0%, rgba(0,0,0,1) 81%, rgba(0,0,0,1) 99%); /* FF3.6-15 */
        background: -webkit-radial-gradient(center, ellipse cover,  rgba(0,0,0,0.29) 0%,rgba(0,0,0,1) 81%,rgba(0,0,0,1) 99%); /* Chrome10-25,Safari5.1-6 */
        background: radial-gradient(ellipse at center,  rgba(0,0,0,0.29) 0%,rgba(0,0,0,1) 81%,rgba(0,0,0,1) 99%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4a000000', endColorstr='#000000',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
      }
      h1 {
        font-size: 3.6em;
        line-height: 1; 
        span {
          display: block;
        }
      }
      h2 {
        margin: 0;
      }
      hr {
        height: 1px;
        border: none;
        background-color: $main;
      }
      .container {
        position: relative;
        z-index: 1;
      }
      .article-title {
        margin-top: 8em;
      }
    }
  }
  .post {
    background-color: $smokygray;
    background-image: url('../assets/images/components/news-bg-2.png');
    background-repeat: no-repeat;
    background-position: top right;
    &>.container {
      // overflow: hidden;
      padding: 4rem 0;
      position: relative;
      margin-top: -6rem;
    }
    .content {
      padding: 0 0 4em 0;
    }
  }
  .news-navigation {
    .fa {
      position: absolute;
      top: 0;
    }
    a {
      margin: .5em;
      position: relative;
      &:first-child {
        padding-left: 4em;
        .fa {
          left: .5em;
        }
      }
      &:last-child {
        padding-right: 4em;
        .fa {
          right: .5em;
        }
      }
    }

    span {
      display: inline-block;
      vertical-align: middle;
      margin: 0 .5em;
    }
  }
  #news-single-slider {
    // margin: 2em 0;
    // position: relative;
    // left: -8.5em;
    @extend .clr;
    text-align: center;
    .slick-prev, .slick-next {
      z-index: 7;
      height: 40px;
      width: 20px;
      background-color: $main;
      cursor: pointer;
      opacity: .75;
      &:before {
        font-size: 16px;
      }
      &:hover {
        opacity: 1;
      }
    }
    .slick-prev {
      left: 0;
      &:before {
        content: '<';
      }
    }
    .slick-next {
      right: 0;
      &:before {
        content: '>';
      }
    }
    .item {
      display: inline-block;
      vertical-align: middle;
      width: 48%;
      margin: 0 1%;
    }
    img {
      box-shadow: 0 3px 6px rgba($black, .66);
    }
    .slick-slide {
      transition: .3s transform ease;
      margin: 0 2px;
      background-color: $white;
      img {
        width: 100%;
        opacity: .4;
      }
      @include breakpoint(1024px) {
        margin: 0 10px;
      }
    }
    .slick-list {
      padding-top: 50px !important;
      padding-bottom: 50px !important;
      overflow: initial; 
      @include breakpoint(1024px) {
        // padding-top: 100px !important;
        // padding-bottom: 100px !important;
      }
    }
    .slick-current {
      img {
        opacity: 1;
      }
      position: relative;
      z-index: 1;
      transform: scale(1.2);
      @include breakpoint(1024px) {
        transform: scale(1.7);
      }
      @include breakpoint(1440px) {
        // transform: scale(1.5);
      }
      @include breakpoint(1680px) {
        // transform: scale(1.3);
      }
    }
  }
</style>