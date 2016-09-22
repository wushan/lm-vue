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
                                form#inquiryForm
                                    .contact-form
                                        .row
                                            .grid.g-5-12
                                                .controlgroup
                                                    input(v-model="inquiryForm.name", type="text", placeholder="NAME")
                                            .grid.g-7-12
                                                .controlgroup
                                                    input(v-model="inquiryForm.email", type="email", placeholder="EMAIL")
                                        .row
                                            .grid.g-6-12
                                                .controlgroup
                                                    input(v-model="inquiryForm.company", type="text", placeholder="COMPANY NAME")
                                            .grid.g-6-12
                                                .controlgroup
                                                    .select-wrapper
                                                        select(v-model="inquiryForm.country")
                                                          option(value="AF") Afghanistan
                                                          option(value="AX") Åland Islands
                                                          option(value="AL") Albania
                                                          option(value="DZ") Algeria
                                                          option(value="AS") American Samoa
                                                          option(value="AD") Andorra
                                                          option(value="AO") Angola
                                                          option(value="AI") Anguilla
                                                          option(value="AQ") Antarctica
                                                          option(value="AG") Antigua and Barbuda
                                                          option(value="AR") Argentina
                                                          option(value="AM") Armenia
                                                          option(value="AW") Aruba
                                                          option(value="AU") Australia
                                                          option(value="AT") Austria
                                                          option(value="AZ") Azerbaijan
                                                          option(value="BS") Bahamas
                                                          option(value="BH") Bahrain
                                                          option(value="BD") Bangladesh
                                                          option(value="BB") Barbados
                                                          option(value="BY") Belarus
                                                          option(value="BE") Belgium
                                                          option(value="BZ") Belize
                                                          option(value="BJ") Benin
                                                          option(value="BM") Bermuda
                                                          option(value="BT") Bhutan
                                                          option(value="BO") Bolivia, Plurinational State of
                                                          option(value="BQ") Bonaire, Sint Eustatius and Saba
                                                          option(value="BA") Bosnia and Herzegovina
                                                          option(value="BW") Botswana
                                                          option(value="BV") Bouvet Island
                                                          option(value="BR") Brazil
                                                          option(value="IO") British Indian Ocean Territory
                                                          option(value="BN") Brunei Darussalam
                                                          option(value="BG") Bulgaria
                                                          option(value="BF") Burkina Faso
                                                          option(value="BI") Burundi
                                                          option(value="KH") Cambodia
                                                          option(value="CM") Cameroon
                                                          option(value="CA") Canada
                                                          option(value="CV") Cape Verde
                                                          option(value="KY") Cayman Islands
                                                          option(value="CF") Central African Republic
                                                          option(value="TD") Chad
                                                          option(value="CL") Chile
                                                          option(value="CN") China
                                                          option(value="CX") Christmas Island
                                                          option(value="CC") Cocos (Keeling) Islands
                                                          option(value="CO") Colombia
                                                          option(value="KM") Comoros
                                                          option(value="CG") Congo
                                                          option(value="CD") Congo, the Democratic Republic of the
                                                          option(value="CK") Cook Islands
                                                          option(value="CR") Costa Rica
                                                          option(value="CI") Côte d'Ivoire
                                                          option(value="HR") Croatia
                                                          option(value="CU") Cuba
                                                          option(value="CW") Curaçao
                                                          option(value="CY") Cyprus
                                                          option(value="CZ") Czech Republic
                                                          option(value="DK") Denmark
                                                          option(value="DJ") Djibouti
                                                          option(value="DM") Dominica
                                                          option(value="DO") Dominican Republic
                                                          option(value="EC") Ecuador
                                                          option(value="EG") Egypt
                                                          option(value="SV") El Salvador
                                                          option(value="GQ") Equatorial Guinea
                                                          option(value="ER") Eritrea
                                                          option(value="EE") Estonia
                                                          option(value="ET") Ethiopia
                                                          option(value="FK") Falkland Islands (Malvinas)
                                                          option(value="FO") Faroe Islands
                                                          option(value="FJ") Fiji
                                                          option(value="FI") Finland
                                                          option(value="FR") France
                                                          option(value="GF") French Guiana
                                                          option(value="PF") French Polynesia
                                                          option(value="TF") French Southern Territories
                                                          option(value="GA") Gabon
                                                          option(value="GM") Gambia
                                                          option(value="GE") Georgia
                                                          option(value="DE") Germany
                                                          option(value="GH") Ghana
                                                          option(value="GI") Gibraltar
                                                          option(value="GR") Greece
                                                          option(value="GL") Greenland
                                                          option(value="GD") Grenada
                                                          option(value="GP") Guadeloupe
                                                          option(value="GU") Guam
                                                          option(value="GT") Guatemala
                                                          option(value="GG") Guernsey
                                                          option(value="GN") Guinea
                                                          option(value="GW") Guinea-Bissau
                                                          option(value="GY") Guyana
                                                          option(value="HT") Haiti
                                                          option(value="HM") Heard Island and McDonald Islands
                                                          option(value="VA") Holy See (Vatican City State)
                                                          option(value="HN") Honduras
                                                          option(value="HK") Hong Kong
                                                          option(value="HU") Hungary
                                                          option(value="IS") Iceland
                                                          option(value="IN") India
                                                          option(value="ID") Indonesia
                                                          option(value="IR") Iran, Islamic Republic of
                                                          option(value="IQ") Iraq
                                                          option(value="IE") Ireland
                                                          option(value="IM") Isle of Man
                                                          option(value="IL") Israel
                                                          option(value="IT") Italy
                                                          option(value="JM") Jamaica
                                                          option(value="JP") Japan
                                                          option(value="JE") Jersey
                                                          option(value="JO") Jordan
                                                          option(value="KZ") Kazakhstan
                                                          option(value="KE") Kenya
                                                          option(value="KI") Kiribati
                                                          option(value="KP") Korea, Democratic People's Republic of
                                                          option(value="KR") Korea, Republic of
                                                          option(value="KW") Kuwait
                                                          option(value="KG") Kyrgyzstan
                                                          option(value="LA") Lao People's Democratic Republic
                                                          option(value="LV") Latvia
                                                          option(value="LB") Lebanon
                                                          option(value="LS") Lesotho
                                                          option(value="LR") Liberia
                                                          option(value="LY") Libya
                                                          option(value="LI") Liechtenstein
                                                          option(value="LT") Lithuania
                                                          option(value="LU") Luxembourg
                                                          option(value="MO") Macao
                                                          option(value="MK") Macedonia, the former Yugoslav Republic of
                                                          option(value="MG") Madagascar
                                                          option(value="MW") Malawi
                                                          option(value="MY") Malaysia
                                                          option(value="MV") Maldives
                                                          option(value="ML") Mali
                                                          option(value="MT") Malta
                                                          option(value="MH") Marshall Islands
                                                          option(value="MQ") Martinique
                                                          option(value="MR") Mauritania
                                                          option(value="MU") Mauritius
                                                          option(value="YT") Mayotte
                                                          option(value="MX") Mexico
                                                          option(value="FM") Micronesia, Federated States of
                                                          option(value="MD") Moldova, Republic of
                                                          option(value="MC") Monaco
                                                          option(value="MN") Mongolia
                                                          option(value="ME") Montenegro
                                                          option(value="MS") Montserrat
                                                          option(value="MA") Morocco
                                                          option(value="MZ") Mozambique
                                                          option(value="MM") Myanmar
                                                          option(value="NA") Namibia
                                                          option(value="NR") Nauru
                                                          option(value="NP") Nepal
                                                          option(value="NL") Netherlands
                                                          option(value="NC") New Caledonia
                                                          option(value="NZ") New Zealand
                                                          option(value="NI") Nicaragua
                                                          option(value="NE") Niger
                                                          option(value="NG") Nigeria
                                                          option(value="NU") Niue
                                                          option(value="NF") Norfolk Island
                                                          option(value="MP") Northern Mariana Islands
                                                          option(value="NO") Norway
                                                          option(value="OM") Oman
                                                          option(value="PK") Pakistan
                                                          option(value="PW") Palau
                                                          option(value="PS") Palestinian Territory, Occupied
                                                          option(value="PA") Panama
                                                          option(value="PG") Papua New Guinea
                                                          option(value="PY") Paraguay
                                                          option(value="PE") Peru
                                                          option(value="PH") Philippines
                                                          option(value="PN") Pitcairn
                                                          option(value="PL") Poland
                                                          option(value="PT") Portugal
                                                          option(value="PR") Puerto Rico
                                                          option(value="QA") Qatar
                                                          option(value="RE") Réunion
                                                          option(value="RO") Romania
                                                          option(value="RU") Russian Federation
                                                          option(value="RW") Rwanda
                                                          option(value="BL") Saint Barthélemy
                                                          option(value="SH") Saint Helena, Ascension and Tristan da Cunha
                                                          option(value="KN") Saint Kitts and Nevis
                                                          option(value="LC") Saint Lucia
                                                          option(value="MF") Saint Martin (French part)
                                                          option(value="PM") Saint Pierre and Miquelon
                                                          option(value="VC") Saint Vincent and the Grenadines
                                                          option(value="WS") Samoa
                                                          option(value="SM") San Marino
                                                          option(value="ST") Sao Tome and Principe
                                                          option(value="SA") Saudi Arabia
                                                          option(value="SN") Senegal
                                                          option(value="RS") Serbia
                                                          option(value="SC") Seychelles
                                                          option(value="SL") Sierra Leone
                                                          option(value="SG") Singapore
                                                          option(value="SX") Sint Maarten (Dutch part)
                                                          option(value="SK") Slovakia
                                                          option(value="SI") Slovenia
                                                          option(value="SB") Solomon Islands
                                                          option(value="SO") Somalia
                                                          option(value="ZA") South Africa
                                                          option(value="GS") South Georgia and the South Sandwich Islands
                                                          option(value="SS") South Sudan
                                                          option(value="ES") Spain
                                                          option(value="LK") Sri Lanka
                                                          option(value="SD") Sudan
                                                          option(value="SR") Suriname
                                                          option(value="SJ") Svalbard and Jan Mayen
                                                          option(value="SZ") Swaziland
                                                          option(value="SE") Sweden
                                                          option(value="CH") Switzerland
                                                          option(value="SY") Syrian Arab Republic
                                                          option(value="TW") Taiwan, Province of China
                                                          option(value="TJ") Tajikistan
                                                          option(value="TZ") Tanzania, United Republic of
                                                          option(value="TH") Thailand
                                                          option(value="TL") Timor-Leste
                                                          option(value="TG") Togo
                                                          option(value="TK") Tokelau
                                                          option(value="TO") Tonga
                                                          option(value="TT") Trinidad and Tobago
                                                          option(value="TN") Tunisia
                                                          option(value="TR") Turkey
                                                          option(value="TM") Turkmenistan
                                                          option(value="TC") Turks and Caicos Islands
                                                          option(value="TV") Tuvalu
                                                          option(value="UG") Uganda
                                                          option(value="UA") Ukraine
                                                          option(value="AE") United Arab Emirates
                                                          option(value="GB") United Kingdom
                                                          option(value="US") United States
                                                          option(value="UM") United States Minor Outlying Islands
                                                          option(value="UY") Uruguay
                                                          option(value="UZ") Uzbekistan
                                                          option(value="VU") Vanuatu
                                                          option(value="VE") Venezuela, Bolivarian Republic of
                                                          option(value="VN") Viet Nam
                                                          option(value="VG") Virgin Islands, British
                                                          option(value="VI") Virgin Islands, U.S.
                                                          option(value="WF") Wallis and Futuna
                                                          option(value="EH") Western Sahara
                                                          option(value="YE") Yemen
                                                          option(value="ZM") Zambia
                                                          option(value="ZW") Zimbabwe
                                        .row
                                            .controlgroup
                                                input(v-model.number="inquiryForm.phone", type="number", placeholder="PHONE(MOBILE)")
                                        .row
                                            .controlgroup
                                                input(v-model="inquiryForm.subject", type="text", placeholder="SUBJECT")
                                        .row
                                            .controlgroup
                                                textarea(v-model="inquiryForm.message", placeholder="MESSAGE")
                                        .privacy-checkbox
                                            .controlgroup
                                                .check-item
                                                    input#allowmail(type="checkbox")
                                                    label(for="allowmail") Allow Lymco to send me periodic product updates and newsletter. |  Privacy : Any information we reveive from you will only be used to respond to your inquiry, unless authorized by you.
                                    .call-action.right
                                        button.btn.basic(type="reset") RESET
                                        button.btn.basic(@click.prevent="submit") SUBMIT



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
  props: ['inquiryLength'],
  data () {
    return {
      products: [],
      inquiryForm: {
        name: null,
        email: null,
        company: null,
        country: null,
        phone: null,
        subject: null,
        message: null,
        newsletter: false
      }
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
          // Emit an event to parent
          this.$parent.$emit('updateInquiry', 1)
        } else {
          console.log('no matched item.')
        }
      }
    },
    submit () {
      var myForm = document.getElementById('inquiryForm')
      // Do some validate then POST to backend.
      console.log('submit inquiry.')
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