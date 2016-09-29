<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength")
            #contact
                section
                    .container.restrict-large
                        .title
                            h1
                                |   CONTACT
                                span.bold INFO

                    .container.restrict-large.contact-wrapper
                        .row
                            .block
                                .description
                                    p.
                                        Customer is at the center of our value. To provide the best customer support possible is the rule of thumb here at Lymco. Please feel free to summit any inquiry. be it a catalog request, product information, support, or as simple as a general question regarding our company, we are here to serve your needs.

                                    p As part of our ongoing commitment, all inquiries will be replied within 24 to 48 hours.
                                .contact-info
                                    .address
                                        .fa.fa-map-marker.fa-lg
                                        span No.56, Fu Hsiang Rd. Chung Ho District, New Taipei City, Taiwan. Zip Code: 235
                                    .email
                                        a(href="mailto:info@lywentech.com") info@lywentech.com
                                    .tel TEL : 886-2-2244-8488  |  FAX: 886-2-2244-8486
                            .block
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
        transition(name="fade", mode="out-in")
            #loader(v-if="loading")
                .uil-ring-css(style="transform:scale(0.6);")
                    div
</template>

<script>
import Navigation from './Navigation.vue'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
export default {
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength'],
  data () {
    return {
      loading: false
    }
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    console.log(this.inquiryLength)
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
    #contact {
        background-color: $main;
        color: $white;
        padding: 2em 0;
        box-sizing: border-box;
        background-image: url('../assets/images/components/contact-bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: left bottom;
        transition: .3s all ease;
        @include breakpoint(1280px) {
            min-height: calc( 100vh - 130px );
            background-size: auto 90%;
            background-position: 5em top;
        }
        @include breakpoint(1680px) {
            background-position: right top;
        }
        .title {
            h1 {
                font-size: 3.6em;
                line-height: 1; 
                span {
                    display: block;
                }
            }
        }
    }
    .contact-wrapper {
        .address {
            border-top: 1px solid $white;
            padding: 2em 0 0 0;
            span {
                margin-left: .5em;
            }
        }
        .email {
            margin: 2em 0;
            a {
                color: $white;
            }
        }
        @include breakpoint(1280px) {
            .block {
                @include span(4 of 12 1);
                &:last-child {
                    @include span(8 of 12 1 last);
                }
            }
        }
    }
    //Specialize Form Style
    .contact-form {
        margin-top: 2em;
        background-color: rgba($black, .2);
        padding: 2em;
        box-sizing: border-box;
        font-size: 1.3em;
        border: 1px solid $white;
        @include breakpoint(1280px) {
            margin-top: 0;
        }
        textarea {
            background-color: transparent;
            border-top: 0;
            border-right: 0;
            border-left: 0;
            border-bottom: 1px solid $white;
            color: $white;
            &:focus {
                background-color: rgba($main, .3);
            }
        }
        input[type="text"],input[type="number"],input[type="email"],input[type="password"] input[type="search"] {
            background-color: transparent;
            border-top: 0;
            border-right: 0;
            border-left: 0;
            border-bottom: 1px solid $white;
            color: $white;
            &:focus {
                background-color: rgba($main, .3);
            }
        }
        .check-item {
            @extend .clr;
        }
        input[type="checkbox"] {
            display: inline-block;
            vertical-align: middle;
            width: auto;
            margin-right: .5em;
            float: left;
            & + label {
                display: block;
                float: none;
                margin-left: 30px;
                line-height: 1.6;
                width: auto;
                vertical-align: middle;
            }
        }
        .privacy-checkbox {
            font-size: .7em;
        }
        //Placehoder
        ::-webkit-input-placeholder { /* WebKit browsers */ color: $white; }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color: $white; opacity: 1; }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */ color: $white; opacity: 1; }
        :-ms-input-placeholder { /* Internet Explorer 10+ */ color: $white; }
    }
</style>