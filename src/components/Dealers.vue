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
                            button.btn.rounded(type="submit")
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
                          a.btn.rounded(href="javascript:;")
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
      filterdate: ''
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
    console.log(this.inquiryLength)
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
    findBy
  },
  computed: {
    orderFilter () {
      return [this.filterdate, this.filtername]
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
    .title {
      color: $main;
    }
  }
</style>
