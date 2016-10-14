<template lang="pug">
  main
    #main
      page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
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
            #news-single-slider-wrapper
              .background
                .fake-item(v-for="slide in fakemedia")
                  img(v-bind:src="slide.url")
              .container.restrict-small
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
              router-link.btn.rounded(:to="'/news/single/' + article.pagination.prev.id", v-if="article.pagination.prev")
                .fa.fa-angle-left.fa-3x
                span PREV
                span.bold {{ article.pagination.prev.title }}
                
              router-link.btn.rounded(:to="'/news/single/' + article.pagination.next.id", v-if="article.pagination.next")
                span NEXT
                span.bold {{ article.pagination.next.title }}
                .fa.fa-angle-right.fa-3x
        section#discover
          router-link(:to="'/news/'") BACK TO LIST
      
      #news(v-else)
        section
          p.
            There isn't a matched article during the search.
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
require('imports?$=jquery!../assets/vendor/jquery.bxslider.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  name: 'Article',
  props: ['inquiryLength', 'submenu'],
  data () {
    return {
      loading: false,
      error: null,
      article: null,
      slider: null
    }
  },
  mounted () {
    this.fetchData()
  },
  updated () {
  },
  watch: {
    '$route': 'fetchData'
  },
  computed: {
    fakemedia () {
      var newMediaArray = []
      var i
      switch (this.article.media.length) {
        case 1:
          console.log('case 1')
          newMediaArray = this.article.media
          for (i = 0; i < 3; i++) {
            newMediaArray.push(this.article.media[0])
          }
          break
        case 2:
          console.log('case 2')
          newMediaArray = this.article.media
          for (i = 0; i < 2; i++) {
            newMediaArray.push(this.article.media[0])
          }
          break
        case 3:
          console.log('case 3')
          newMediaArray = this.article.media
          for (i = 0; i < 1; i++) {
            newMediaArray.push(this.article.media[0])
          }
          break
        case 4:
          console.log('case 4')
          newMediaArray = this.article.media
          break
      }
      return newMediaArray
    }
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
          // if ($('#news-single-slider'))
          this.initSlick()
        }
      })
    },
    initSlick () {
      this.$nextTick(function () {
        if (this.slider) {
          this.slider.destroySlider()
        }
        this.$nextTick(function () {
          this.slider = $('#news-single-slider').bxSlider({
            auto: false,
            autoControls: true,
            pager: false,
            nextText: '>',
            prevText: '<'
          })
        })
        // this.slider.reloadSlider()
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
  @import "src/assets/styles/vendor/jquery.bxslider";
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
  #news-single-slider-wrapper {
    position: relative;
    @extend .clr;
    text-align: center;
    .bx-wrapper .bx-controls-direction a {
      height: 60px;
      margin-top: -30px;
      text-indent: 0;
      line-height:  60px;
      color: $white;
      font-size: 1.2em;
    }
    .bx-wrapper .bx-next {
      right: 0;
      background-image: none;
      background-color: $main; 
    }
    .bx-wrapper .bx-prev {
      left: 0;
      background-image: none;
      background-color: $main; 
    }
    .item {
      display: inline-block;
      vertical-align: middle;
      
    }
    img {
      width: 100%; 
    }
    .background {
      position: absolute;
      top: 7em;
      left: 0;
      right: 0;
      width: 100%;
      opacity: .6; 
      .fake-item {
        @include gallery(3 of 12 .1);
      }
      & + .container{
        position: relative;
        margin-top: -6em;
      }
    }
  }
</style>