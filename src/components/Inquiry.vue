<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength")
            #inquiry
                .inquiry-wrapper
                    .container.restrict-large
                        .title
                            h1
                                |   INQUIRY
                                span.bold.green ({{ inquiryLength }})
                    .inquiry-inner
                        .inquiry-form-wrapper
                            .inquiry-list.container.restrict(v-if="products")
                              table
                                thead
                                  tr
                                    th ITEM PHOTO
                                    th ITEM NAME
                                    th INVENTORY
                                    th ITEM ID
                                    th REMOVE
                                tbody
                                  tr(v-for="product in products", track-by="id")
                                    td
                                      img(v-bind:src="product.image")
                                    td {{ product.name }}
                                    td {{ product.inventory }}
                                    td {{ product.model }}
                                    td
                                      a.btn.rounded.green(@click="removeInventoryItem(product.id)") REMOVE

                            .inquiry-from.container.restrict
                                form
                                    .contact-form
                                        .row
                                            .grid.g-5-12
                                                .controlgroup
                                                    input(type="text", placeholder="NAME")
                                            .grid.g-7-12
                                                .controlgroup
                                                    input(type="email", placeholder="EMAIL")
                                        .row
                                            .grid.g-6-12
                                                .controlgroup
                                                    input(type="text", placeholder="COMPANY NAME")
                                            .grid.g-6-12
                                                .controlgroup
                                                    .select-wrapper
                                                        select
                                                            option Country
                                                            option United States
                                        .row
                                            .controlgroup
                                                input(type="text", placeholder="PHONE(MOBILE)")
                                        .row
                                            .controlgroup
                                                input(type="text", placeholder="SUBJECT")
                                        .row
                                            .controlgroup
                                                textarea(placeholder="MESSAGE")
                                        .privacy-checkbox
                                            .controlgroup
                                                .check-item
                                                    input#allowmail(type="checkbox")
                                                    label(for="allowmail") Allow Lymco to send me periodic product updates and newsletter. |  Privacy : Any information we reveive from you will only be used to respond to your inquiry, unless authorized by you.
                                    .call-action.right
                                        button.btn.basic(type="reset") RESET
                                        button.btn.basic(type="submit") SUBMIT



</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
import Inquiry from '../cart/inquiry'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  data () {
    return {
      products: []
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
  computed: {
    inquiryLength () {
      return this.products.length
    }
  },
  methods: {
    fetchData () {
      // Fetch localStorge
      let productsId = Inquiry.getAll('inquiry')
      this.error = this.data = null
      this.loading = true
      Api.getProducts(productsId, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.products = data
        }
      })
    },
    removeInventoryItem (id) {
      console.log(id)
      // Remove from localStorge
      Inquiry.remove(id)
      // Remove from data
      for (var i = 0; i < this.products.length; i++) {
        if (this.products[i].id === id) {
          this.products.splice(i, 1)
        }
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
    #inquiry {
        background-color: $darkestgray;
        background-image: url('../assets/images/components/inquiry-bg-1.png');
        background-position: center top;
        color: $white;
    }
    .inquiry-wrapper {
        .title {
            border-bottom: 1px solid $main;
            h1 {
                font-size: 3.6em;
                line-height: 1; 
                span {
                    display: block;
                }
            }
        }
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
</style>