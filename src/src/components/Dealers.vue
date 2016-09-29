<template lang="pug">
  main
    #main
      #dealers
        page-navigation(v-bind:inquiryLength="inquiryLength")
        .dealers-wrapper(v-if="dealer")
          .container.restrict-large
            .title
              h1 {{ dealer.dealername }}
          .dealers-inner
            .container.restrict-large
              .order-history-wrapper
                .order-history-header
                  .row
                    .grid.g-6-12
                      h4 ORDER HISTORY LIST
                    .grid.g-6-12
                      .row
                        .grid.g-4-12
                          .controlgroup
                            input(type="text", placeholder="date", v-model="filterdate")
                        .grid.g-4-12
                          .controlgroup
                            input(type="text", placeholder="Key words", v-model="filtername")
                        .grid.g-4-12
                          .controlgroup
                            button.btn.rounded.green.full(type="submit")
                              .fa.fa-serach.fa-lg
                              | Search
                .order-history-table
                  table.left
                    thead
                      tr
                        th(width="20%") DATE
                        th(width="20%") WARRANTY EXPIRATION
                        th(width="35%") MACHINES MODEL
                        th(width="10%") SERIAL NO.
                        th(width="15%")
                    tbody
                      tr(v-for="order in filterBy(dealer.orders, orderFilter, ['date', 'name'])")
                        td {{ order.date }}
                        //- td {{ word }}
                        td {{ order.expire }}
                        //- td {{ word }}
                        td {{ order.name }}
                        //- td {{ word }}
                        td {{ order.no }}
                        //- td {{ word }}
                        td.centered
                          button.btn.rounded.green(@click="getDetails(order)")
                            .fa.fa-eye.fa-lg
                            span Details
              
              .order-detail-wrapper(v-if="selectedOrder")
                .order-detail-header
                  .row
                    .grid.g-6-12
                      h4 {{ selectedOrder.name }}
                      p SERIAL NO. {{ selectedOrder.no }}
                    .grid.g-6-12
                      .row
                        .grid.g-4-12
                          .controlgroup
                            input(type="text", placeholder="date", v-model="detailfilterdate")
                        .grid.g-4-12
                          .controlgroup
                            input(type="text", placeholder="Subject", v-model="detailfiltersubject")
                        .grid.g-4-12
                          .controlgroup
                            button.btn.rounded.green.full(type="submit")
                              .fa.fa-serach.fa-lg
                              | Search
                .order-history-table
                  table.left
                    thead
                      tr
                        th(width="15%") DATE
                        th(width="15%") CONTACT NAME
                        th(width="15%") MODEL PART
                        th(width="10%") SUBJECT
                        th(width="30%") DESCRIPTION
                        th(width="15%") DOWNLOADS
                    tbody
                      tr(v-for="detail in filterBy(selectedOrder.detail, detailFilter, ['date', 'subject'])")
                        td {{ detail.date }}
                        //- td {{ word }}
                        td {{ detail.contact }}
                        //- td {{ word }}
                        td {{ detail.part }}
                        //- td {{ word }}
                        td {{ detail.subject }}
                        td {{ detail.description }}
                        //- td {{ word }}
                        td.centered
                          a.btn.rounded.green(href="javascript:;")
                            .fa.fa-eye.fa-lg
                            span Details
        .dealers-wrapper(v-else)
          .container.restrict-large
            .title
              h1 Dealers PORTAL
          .dealers-inner
            .container.restrict-large
              p You don't have permission to view this section.
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
import {reverse, filterBy, findBy} from '../filter.js'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
require('imports?$=jquery!../assets/vendor/jquery.mousewheel.js')
require('imports?$=jquery!../assets/vendor/jquery.mCustomScrollbar.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength', 'isAuth'],
  data () {
    return {
      loading: false,
      dealer: null,
      error: null,
      filtername: '',
      filterdate: '',
      selectedOrder: null,
      detailfilterdate: '',
      detailfiltersubject: ''
    }
  },
  created () {
    if (this.isAuth) {
      this.fetchData()
    } else {
      this.$parent.$emit('showLogin', 1)
    }
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    $('.order-history-table').mCustomScrollbar({
      theme: 'light'
    })
    console.log('mounted')
  },
  updated () {
    console.log('updated')
    $('.order-history-table').mCustomScrollbar({
      theme: 'light',
      mouseWheel: true
    })
  },
  methods: {
    fetchData () {
      this.error = this.dealer = null
      this.loading = true
      Api.getDealer((err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.dealer = data
        }
      })
    },
    reverse,
    filterBy,
    findBy,
    getDetails (order) {
      this.selectedOrder = order
    }
  },
  computed: {
    orderFilter () {
      return [this.filterdate, this.filtername]
    },
    detailFilter () {
      return [this.detailfilterdate, this.detailfiltersubject]
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
	#dealers {
    color: $white;
    min-height: calc(100vh - 50px); 
    .title {
      color: $main;
      h1 {
        margin: 0;
      }
    }
    // Form
    input[type="text"] {
      border-radius: 2em;
      border: 0;
      background-color: darken($gray, 20%);
      color: $white;
      box-shadow: inset 3px 3px 3px rgba($black,.33);
    }
    .order-history-wrapper {
      border: 1px solid $white;
      box-sizing: border-box;
      padding: 1em;
      margin-bottom: 2em;
    }
    .order-history-header {
      h4 {
        margin: 0;
      }
    }
    .order-detail-wrapper {
      
    }
    .order-detail-header {
      h4 {
        margin: 0; 
      }
      p {
        margin: 0;
      }
    }
    .order-history-table {
      height: 400px;
      overflow: auto;
    }
  }
  @import "src/assets/styles/vendor/jquery.mCustomScrollbar";
</style>
