<template lang="pug">
  main
    #main
      page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
      #news
        section#news-slider
          .container.restrict-large
            h1
              | LATEST
              span.bold NEWS
            .restrict-mid
              #slider
                .item(v-for="news in latestNews")
                  .block
                    img(v-bind:src="news.thumbnail")
                  .block
                    .content
                      time {{news.updated_time}}
                      h2(v-html="news.title")
                      .context
                        p(v-html="news.excerpt")
                      .call-action.right
                        router-link.btn.bordered(:to="'/news/single/' + news.id") READ MORE &#9656;

        section#news-list(v-if="data")
          .cover
          .container.restrict-large.middler-wrapper
            .middler
              .news-list
                article.news-item(v-for="news in fetchPage")
                  header
                    .thumbnail
                      //- a(v-bind:href="'/news/' + news.id")
                      router-link.aspect(:to="'/news/single/' + news.id")
                        img(v-bind:src="news.thumbnail")
                      //- a.overlay(v-bind:href="'/news/' + news.id")
                      router-link.overlay(:to="'/news/single/' + news.id")
                        .title
                          time {{news.updated_time}}
                          h4(v-html="news.title")
                  .content(v-html="news.excerpt")
                  footer.footer.right
                    router-link(:to="'/news/single/' + news.id")
                      span read more &#9656;
              .pagination
                router-link(:to="'/news/' + prevPage")
                  .fa.fa-lg.fa-caret-left
                router-link(:to="'/news/' + pageno", activeClass="active", v-for="pageno in pagination.totalPage") {{ pageno }}
                router-link(:to="'/news/' + nextPage")
                  .fa.fa-lg.fa-caret-right
        section#discover
          a(href="javascript:;") DISCOVER MORE
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
      data: null,
      error: null,
      pagination: {
        totalPage: 5
      }
    }
  },
  computed: {
    pagination () {
      var createGroupedArray = function (arr, chunkSize) {
        var groups = []
        var i
        for (i = 0; i < arr.length; i += chunkSize) {
          groups.push(arr.slice(i, i + chunkSize))
        }
        return groups
      }
      var groupArr = createGroupedArray(this.data, 8)
      return {totalPage: groupArr.length}
    },
    latestNews () {
      if (this.data) {
        console.log(this.data.slice(0, 3))
        return this.data.slice(0, 3)
      }
    },
    fetchPage () {
      var page = parseInt(this.$route.params.page) - 1
      var createGroupedArray = function (arr, chunkSize) {
        var groups = []
        var i
        for (i = 0; i < arr.length; i += chunkSize) {
          groups.push(arr.slice(i, i + chunkSize))
        }
        return groups
      }
      var groupArr = createGroupedArray(this.data, 8)
      return groupArr[page]
    },
    currentPage () {
      return this.$route.params.page
    },
    prevPage () {
      let no = parseInt(this.currentPage) - 1
      if (no > 0) {
        return no
      } else {
        return 1
      }
    },
    nextPage () {
      let no = parseInt(this.currentPage) + 1
      if (no >= this.pagination.totalPage) {
        return this.pagination.totalPage
      } else {
        return no
      }
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
  methods: {
    fetchData () {
      this.error = this.data = null
      this.loading = true
      Api.getNewsHome(this.$route.params.page, (err, data) => {
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
          dots: true,
          arrows: false
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
  
  #news {}
  #news-slider {
    color: $white;
    background-color: $darkestgray;
    background-image: url('../assets/images/components/news-bg-1.png');
    background-repeat: no-repeat;
    background-position: center top; 
    h1 {
      font-size: 3.6em;
      line-height: 1; 
      span {
        display: block;
      }
    }
    .item {
      @extend .clr;
      .block {
        position: relative;
        box-sizing: border-box;
        &:first-child {
          margin-bottom: 3em;
          border: 1px solid $main;
          @include breakpoint(768px) {
            border: 0;
            &:after {
              content: '';
              border: 1px solid $main;
              display: block;
              width: 100%;
              height: 100%;
              position: absolute;
              top: 1em;
              left: 1em;
            }
          }
        }
        img {
          width: 100%;
          position: relative;
          z-index: 1;
        }
      }
      h2 {
        margin: 0;
      }
      time {
        color: $main;
      }
      @include breakpoint(768px) {
        .block {
          @include span(6 of 12 2);
          &:last-child {
            @include last;
          }
          .call-action {
            padding: 2em;
          }
        }
      }
    }
    #slider {
      margin: 2em 0;
      height: 100%; 
      .item {
        height: 100%; 
        position: relative;
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
  }
  #news-list {
    background-color: $smokygray;
    background-image: url('../assets/images/components/news-bg-2.png');
    background-repeat: no-repeat;
    background-position: top right; 
    padding: 2em 0;
    .pagination {
      margin: 2em 0 0 0;
      a {
        display: inline-block;
        vertical-align: middle;
        color: $darkgray;
        font-size: 1.1em;
        border-right: 1px solid $darkgray;
        padding: 0 2em;
        box-sizing: border-box;
        &.active, &:hover {
          color: $main;
        }
        &:first-child, &:last-child, &:nth-last-child(2) {
          border: 0;
        }
      }
    }
  }
  #discover {
    text-align: center;
    padding: 4em 0;
    background-color: $main;
    background-image: url('../assets/images/components/footer-green-bg.png');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    a {
      display: inline-block;
      vertical-align: middle;
      color: $black;
      position: relative;
      cursor: pointer;
      &:after {
        content: '';
        display: block;
        border-bottom: 2px solid $white;
        position: absolute;
        bottom: -1em;
        left: 0;
        right: 0;
        width: 20%;
        margin: auto; 
      }
    }
  }
</style>