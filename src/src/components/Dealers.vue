<template lang="pug">
  main
    #main
      #dealers
        page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
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
                        .grid.g-6-12
                          .controlgroup
                            input(type="text", placeholder="date", v-model="filterdate")
                        .grid.g-6-12
                          .controlgroup
                            input(type="text", placeholder="Key words", v-model="filtername")
                        //- .grid.g-4-12
                        //-   .controlgroup
                        //-     button.btn.rounded.green.full(type="submit")
                        //-       .fa.fa-serach.fa-lg
                        //-       | Search
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
                        .grid.g-6-12
                          .controlgroup
                            input(type="text", placeholder="date", v-model="detailfilterdate")
                        .grid.g-6-12
                          .controlgroup
                            input(type="text", placeholder="Subject", v-model="detailfiltersubject")
                        //- .grid.g-4-12
                        //-   .controlgroup
                        //-     button.btn.rounded.green.full(type="submit")
                        //-       .fa.fa-serach.fa-lg
                        //-       | Search
                .order-history-table
                  table.left
                    thead
                      tr
                        th(width="15%") DATE
                        th(width="15%") CONTACT NAME
                        th(width="15%") MACHINE PART
                        th(width="10%") SUBJECT
                        th(width="30%") DESCRIPTION
                        th(width="15%") DOWNLOADS
                    tbody
                      tr(v-for="detail in filterBy(selectedOrder.detail, detailFilter, ['date', 'part'])")
                        td {{ detail.date }}
                        //- td {{ word }}
                        td {{ detail.contact }}
                        //- td {{ word }}
                        td {{ detail.part }}
                        //- td {{ word }}
                        td {{ detail.subject }}
                        td {{ detail.description }}
                        //- td {{ word }}
                        td
                          a.btn.rounded.green(href="javascript:;") Download PDF
        .dealers-wrapper(v-if="error")
          .container.restrict-large
            .title.centered
              h1 Dealers PORTAL
          .dealers-inner
            .container.restrict-large.centered
              p {{ error }}
              p You don't have permission to view this section.
    transition(name="fade", mode="out-in")
      #loader(v-if="loading")
          .uil-ring-css(style="transform:scale(0.6);")
              div
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
import Store from '../assets/vendor/store'
import {reverse, filterBy, findBy} from '../filter.js'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
require('imports?$=jquery!../assets/vendor/jquery.mousewheel.js')
require('imports?$=jquery!../assets/vendor/jquery.mCustomScrollbar.js')
export default {
  name: 'Dealer',
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength', 'isAuth', 'submenu'],
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
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    $('.order-history-table').mCustomScrollbar({
      theme: 'light'
    })
    this.fetchData()
  },
  updated () {
    console.log('updated')
    $('.order-history-table').mCustomScrollbar({
      theme: 'light',
      mouseWheel: true
    })
  },
  watch: {
    'isAuth': 'updateView'
  },
  methods: {
    updateView () {
      if (this.isAuth) {
        this.fetchData()
      }
    },
    fetchData () {
      this.error = this.dealer = null
      this.loading = true
      var user
      if (Store.get('lymco-auth')) {
        user = Store.get('lymco-auth')
        Api.getDealer(user.id, user.is_login, (err, data) => {
          this.loading = false
          if (err) {
            this.error = err.toString()
            console.log(err)
          } else {
            this.dealer = data
            console.log(data)
          }
        })
      } else {
        this.loading = false
        this.$parent.$emit('showLogin', 1)
      }
    },
    reverse,
    filterBy,
    findBy,
    getDetails (order) {
      if (!order.detail) {
        window.alert('無詳細資料')
      } else {
        this.selectedOrder = order
      }
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
    background-color: $darkestgray;
    background-image: url('../assets/images/components/dealer-bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: -400px 0;
    transition: .3s background ease;
    @include breakpoint(768px) {
      background-position: -100px 0;
    }
    @include breakpoint(768px) {
      background-position: 0 0;
    }
    @include breakpoint(1440px) {
      background-size: 100% auto;
    }
    .title {
      color: darken($main, 10%);
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
    /* Force table to not be like tables anymore */
      table, thead, tbody, th, td, tr { 
        display: block; 
      }
      
      /* Hide table headers (but not display: none;, for accessibility) */
      thead tr { 
        position: absolute;
        top: -9999px;
        left: -9999px;
      }
      
      tr {margin-bottom: 2em;}
      
      td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid $darkgray; 
        position: relative;
        padding-left: 50%; 
      }
      
      td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        // top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
      }
    .order-history-wrapper {
      border: 1px solid $white;
      box-sizing: border-box;
      padding: 1em;
      margin-bottom: 2em;
      .order-history-table {        
        /*
        Label the data
        */
        td:nth-of-type(1):before { content: "DATE"; }
        td:nth-of-type(2):before { content: "WARRANTY"; }
        td:nth-of-type(3):before { content: "MODEL"; }
        td:nth-of-type(4):before { content: "SERIAL"; }
        td:nth-of-type(5):before { content: "DETAILS"; }
      }
    }
    .order-history-header {
      h4 {
        margin: 0;
      }
    }
    .order-detail-wrapper {
      .order-history-table {
        /*
        Label the data
        */
        td:nth-of-type(1):before { content: "DATE"; }
        td:nth-of-type(2):before { content: "CONTACT NAME"; }
        td:nth-of-type(3):before { content: "MACHINE PART"; }
        td:nth-of-type(4):before { content: "SUBJECT"; }
        td:nth-of-type(5):before { content: "DESCRIPTION"; }
        td:nth-of-type(6):before { content: "DOWNLOADS"; }
      }
    }
    .order-detail-header {
      h4 {
        margin: 0;
        font-weight: normal;
      }
      p {
        margin: 0;
      }
    }
    .order-history-table {
      height: 400px;
      overflow: auto;
    }
    @include breakpoint(1024px) {
      table, thead, tbody, th, td, tr { 
        display: inherit; 
      }
      table {
        display: table;
      }
      thead {
        display: table-header-group;
      }
      tbody {
        display: table-row-group; 
      }
      tr {
        display: table-row;
      }
      td,th {
        display: table-cell;
        padding: .5em;
      }
      /* Hide table headers (but not display: none;, for accessibility) */
      thead tr { 
        position: static;
        top: 0;
        left: 0;
      }
      tbody {
        tr {
          td,th {
            border-bottom: 1px solid $darkgray;
              &:last-child {
                border-bottom: 0;
              }
          }
          &:hover {
            td,th {
              background-color: $darkgray;
            }
          }
        }
      }
      tr {margin-bottom: 0;}
      
      td { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 0; 
        position: relative;
      }
      .order-detail-wrapper, .order-history-wrapper {
        .order-history-table {
          td:nth-of-type(1):before { content: ""; }
          td:nth-of-type(2):before { content: ""; }
          td:nth-of-type(3):before { content: ""; }
          td:nth-of-type(4):before { content: ""; }
          td:nth-of-type(5):before { content: ""; }
          td:nth-of-type(6):before { content: ""; } 
        } 
      }
    }
  }
  @import "src/assets/styles/vendor/jquery.mCustomScrollbar";
</style>
