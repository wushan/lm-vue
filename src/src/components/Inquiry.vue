<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
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
                                    tr(v-for="product in products.category", track-by="id")
                                        td
                                          img(v-bind:src="product.image")
                                        td {{ product.name }}
                                        td /
                                        td {{ product.id }}
                                        td
                                          a.btn.rounded.green(@click="removeInquiryItem(product.id)") REMOVE
                                    tr(v-for="product in products.inventory", track-by="id")
                                        td
                                          img(v-bind:src="product.image")
                                        td {{ product.name }}
                                        td YES
                                        td {{ product.id }}
                                        td
                                          a.btn.rounded.green(@click="removeInventoryItem(product.id)") REMOVE

                            .inquiry-from.container.restrict
                                form#inquiryForm
                                    .contact-form
                                        .row
                                            .grid.g-5-12
                                                .controlgroup
                                                    input(v-validate.initial="inquiryForm.name", data-rules="required",v-model="inquiryForm.name", type="text", placeholder="NAME", :class="{'has-error': errors.has('inquiryForm.name')}")
                                                    span.error(v-show="errors.has('inquiryForm.name')") {{ errors.first('inquiryForm.name') }}
                                            .grid.g-7-12
                                                .controlgroup
                                                    input(v-validate.initial="inquiryForm.email", data-rules="required|email" v-model="inquiryForm.email", type="email", placeholder="EMAIL", :class="{'has-error': errors.has('inquiryForm.email')}")
                                                    span.error(v-show="errors.has('inquiryForm.email')") {{ errors.first('inquiryForm.email') }}
                                        .row
                                            .grid.g-6-12
                                                .controlgroup
                                                    input(v-model="inquiryForm.company", type="text", placeholder="COMPANY NAME")
                                            .grid.g-6-12
                                                .controlgroup
                                                    .select-wrapper
                                                        select(v-model="inquiryForm.country")
                                                          option(v-for="option in countries" v-bind:value="option.value") {{ option.text }}
                                        .row
                                            .controlgroup
                                                input(v-model.number="inquiryForm.phone", type="text", placeholder="PHONE(MOBILE)")
                                        .row
                                            .controlgroup
                                                input(v-validate.initial="inquiryForm.subject", data-rules="required", v-model="inquiryForm.subject", type="text", placeholder="SUBJECT", :class="{'has-error': errors.has('inquiryForm.subject')}")
                                                span.error(v-show="errors.has('inquiryForm.subject')") {{ errors.first('inquiryForm.subject') }}
                                        .row
                                            .controlgroup
                                                textarea(v-validate.initial="inquiryForm.message", data-rules="required", v-model="inquiryForm.message", placeholder="MESSAGE", :class="{'has-error': errors.has('inquiryForm.message')}")
                                                span.error(v-show="errors.has('inquiryForm.message')") {{ errors.first('inquiryForm.message') }}

                                        .privacy-checkbox
                                            .controlgroup
                                                .check-item
                                                    input#allowmail(type="checkbox")
                                                    label(for="allowmail") Allow Lymco to send me periodic product updates and newsletter. |  Privacy : Any information we reveive from you will only be used to respond to your inquiry, unless authorized by you.
                                    .call-action.right
                                        button.btn.basic(type="reset") RESET
                                        button.btn.basic(@click.prevent="submit") SUBMIT
        transition(name="fade", mode="out-in")
            #loader(v-if="loading")
                .uil-ring-css(style="transform:scale(0.6);")
                    div
</template>

<script>
import Store from '../assets/vendor/store'
import Navigation from './Navigation.vue'
import Api from '../api'
import Inquiry from '../cart/inquiry'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
export default {
  name: 'Inquiry',
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength', 'submenu'],
  data () {
    return {
      loading: null,
      products: [],
      countries: [
        { value: 'AF', text: 'Afghanistan' },
        { value: 'AX', text: 'Åland Islands' },
        { value: 'AL', text: 'Albania' },
        { value: 'DZ', text: 'Algeria' },
        { value: 'AS', text: 'American Samoa' },
        { value: 'AD', text: 'Andorra' },
        { value: 'AO', text: 'Angola' },
        { value: 'AI', text: 'Anguilla' },
        { value: 'AQ', text: 'Antarctica' },
        { value: 'AG', text: 'Antigua and Barbuda' },
        { value: 'AR', text: 'Argentina' },
        { value: 'AM', text: 'Armenia' },
        { value: 'AW', text: 'Aruba' },
        { value: 'AU', text: 'Australia' },
        { value: 'AT', text: 'Austria' },
        { value: 'AZ', text: 'Azerbaijan' },
        { value: 'BS', text: 'Bahamas' },
        { value: 'BH', text: 'Bahrain' },
        { value: 'BD', text: 'Bangladesh' },
        { value: 'BB', text: 'Barbados' },
        { value: 'BY', text: 'Belarus' },
        { value: 'BE', text: 'Belgium' },
        { value: 'BZ', text: 'Belize' },
        { value: 'BJ', text: 'Benin' },
        { value: 'BM', text: 'Bermuda' },
        { value: 'BT', text: 'Bhutan' },
        { value: 'BO', text: 'Bolivia, Plurinational State of' },
        { value: 'BQ', text: 'Bonaire, Sint Eustatius and Saba' },
        { value: 'BA', text: 'Bosnia and Herzegovina' },
        { value: 'BW', text: 'Botswana' },
        { value: 'BV', text: 'Bouvet Island' },
        { value: 'BR', text: 'Brazil' },
        { value: 'IO', text: 'British Indian Ocean Territory' },
        { value: 'BN', text: 'Brunei Darussalam' },
        { value: 'BG', text: 'Bulgaria' },
        { value: 'BF', text: 'Burkina Faso' },
        { value: 'BI', text: 'Burundi' },
        { value: 'KH', text: 'Cambodia' },
        { value: 'CM', text: 'Cameroon' },
        { value: 'CA', text: 'Canada' },
        { value: 'CV', text: 'Cape Verde' },
        { value: 'KY', text: 'Cayman Islands' },
        { value: 'CF', text: 'Central African Republic' },
        { value: 'TD', text: 'Chad' },
        { value: 'CL', text: 'Chile' },
        { value: 'CN', text: 'China' },
        { value: 'CX', text: 'Christmas Island' },
        { value: 'CC', text: 'Cocos (Keeling) Islands' },
        { value: 'CO', text: 'Colombia' },
        { value: 'KM', text: 'Comoros' },
        { value: 'CG', text: 'Congo' },
        { value: 'CD', text: 'Congo, the Democratic Republic of the' },
        { value: 'CK', text: 'Cook Islands' },
        { value: 'CR', text: 'Costa Rica' },
        { value: 'CI', text: 'Côte d\'Ivoire' },
        { value: 'HR', text: 'Croatia' },
        { value: 'CU', text: 'Cuba' },
        { value: 'CW', text: 'Curaçao' },
        { value: 'CY', text: 'Cyprus' },
        { value: 'CZ', text: 'Czech Republic' },
        { value: 'DK', text: 'Denmark' },
        { value: 'DJ', text: 'Djibouti' },
        { value: 'DM', text: 'Dominica' },
        { value: 'DO', text: 'Dominican Republic' },
        { value: 'EC', text: 'Ecuador' },
        { value: 'EG', text: 'Egypt' },
        { value: 'SV', text: 'El Salvador' },
        { value: 'GQ', text: 'Equatorial Guinea' },
        { value: 'ER', text: 'Eritrea' },
        { value: 'EE', text: 'Estonia' },
        { value: 'ET', text: 'Ethiopia' },
        { value: 'FK', text: 'Falkland Islands (Malvinas)' },
        { value: 'FO', text: 'Faroe Islands' },
        { value: 'FJ', text: 'Fiji' },
        { value: 'FI', text: 'Finland' },
        { value: 'FR', text: 'France' },
        { value: 'GF', text: 'French Guiana' },
        { value: 'PF', text: 'French Polynesia' },
        { value: 'TF', text: 'French Southern Territories' },
        { value: 'GA', text: 'Gabon' },
        { value: 'GM', text: 'Gambia' },
        { value: 'GE', text: 'Georgia' },
        { value: 'DE', text: 'Germany' },
        { value: 'GH', text: 'Ghana' },
        { value: 'GI', text: 'Gibraltar' },
        { value: 'GR', text: 'Greece' },
        { value: 'GL', text: 'Greenland' },
        { value: 'GD', text: 'Grenada' },
        { value: 'GP', text: 'Guadeloupe' },
        { value: 'GU', text: 'Guam' },
        { value: 'GT', text: 'Guatemala' },
        { value: 'GG', text: 'Guernsey' },
        { value: 'GN', text: 'Guinea' },
        { value: 'GW', text: 'Guinea-Bissau' },
        { value: 'GY', text: 'Guyana' },
        { value: 'HT', text: 'Haiti' },
        { value: 'HM', text: 'Heard Island and McDonald Islands' },
        { value: 'VA', text: 'Holy See (Vatican City State)' },
        { value: 'HN', text: 'Honduras' },
        { value: 'HK', text: 'Hong Kong' },
        { value: 'HU', text: 'Hungary' },
        { value: 'IS', text: 'Iceland' },
        { value: 'IN', text: 'India' },
        { value: 'ID', text: 'Indonesia' },
        { value: 'IR', text: 'Iran, Islamic Republic of' },
        { value: 'IQ', text: 'Iraq' },
        { value: 'IE', text: 'Ireland' },
        { value: 'IM', text: 'Isle of Man' },
        { value: 'IL', text: 'Israel' },
        { value: 'IT', text: 'Italy' },
        { value: 'JM', text: 'Jamaica' },
        { value: 'JP', text: 'Japan' },
        { value: 'JE', text: 'Jersey' },
        { value: 'JO', text: 'Jordan' },
        { value: 'KZ', text: 'Kazakhstan' },
        { value: 'KE', text: 'Kenya' },
        { value: 'KI', text: 'Kiribati' },
        { value: 'KP', text: 'Korea, Democratic People\'s Republic of' },
        { value: 'KR', text: 'Korea, Republic of' },
        { value: 'KW', text: 'Kuwait' },
        { value: 'KG', text: 'Kyrgyzstan' },
        { value: 'LA', text: 'Lao People\'s Democratic Republic' },
        { value: 'LV', text: 'Latvia' },
        { value: 'LB', text: 'Lebanon' },
        { value: 'LS', text: 'Lesotho' },
        { value: 'LR', text: 'Liberia' },
        { value: 'LY', text: 'Libya' },
        { value: 'LI', text: 'Liechtenstein' },
        { value: 'LT', text: 'Lithuania' },
        { value: 'LU', text: 'Luxembourg' },
        { value: 'MO', text: 'Macao' },
        { value: 'MK', text: 'Macedonia, the former Yugoslav Republic of' },
        { value: 'MG', text: 'Madagascar' },
        { value: 'MW', text: 'Malawi' },
        { value: 'MY', text: 'Malaysia' },
        { value: 'MV', text: 'Maldives' },
        { value: 'ML', text: 'Mali' },
        { value: 'MT', text: 'Malta' },
        { value: 'MH', text: 'Marshall Islands' },
        { value: 'MQ', text: 'Martinique' },
        { value: 'MR', text: 'Mauritania' },
        { value: 'MU', text: 'Mauritius' },
        { value: 'YT', text: 'Mayotte' },
        { value: 'MX', text: 'Mexico' },
        { value: 'FM', text: 'Micronesia, Federated States of' },
        { value: 'MD', text: 'Moldova, Republic of' },
        { value: 'MC', text: 'Monaco' },
        { value: 'MN', text: 'Mongolia' },
        { value: 'ME', text: 'Montenegro' },
        { value: 'MS', text: 'Montserrat' },
        { value: 'MA', text: 'Morocco' },
        { value: 'MZ', text: 'Mozambique' },
        { value: 'MM', text: 'Myanmar' },
        { value: 'NA', text: 'Namibia' },
        { value: 'NR', text: 'Nauru' },
        { value: 'NP', text: 'Nepal' },
        { value: 'NL', text: 'Netherlands' },
        { value: 'NC', text: 'New Caledonia' },
        { value: 'NZ', text: 'New Zealand' },
        { value: 'NI', text: 'Nicaragua' },
        { value: 'NE', text: 'Niger' },
        { value: 'NG', text: 'Nigeria' },
        { value: 'NU', text: 'Niue' },
        { value: 'NF', text: 'Norfolk Island' },
        { value: 'MP', text: 'Northern Mariana Islands' },
        { value: 'NO', text: 'Norway' },
        { value: 'OM', text: 'Oman' },
        { value: 'PK', text: 'Pakistan' },
        { value: 'PW', text: 'Palau' },
        { value: 'PS', text: 'Palestinian Territory, Occupied' },
        { value: 'PA', text: 'Panama' },
        { value: 'PG', text: 'Papua New Guinea' },
        { value: 'PY', text: 'Paraguay' },
        { value: 'PE', text: 'Peru' },
        { value: 'PH', text: 'Philippines' },
        { value: 'PN', text: 'Pitcairn' },
        { value: 'PL', text: 'Poland' },
        { value: 'PT', text: 'Portugal' },
        { value: 'PR', text: 'Puerto Rico' },
        { value: 'QA', text: 'Qatar' },
        { value: 'RE', text: 'Réunion' },
        { value: 'RO', text: 'Romania' },
        { value: 'RU', text: 'Russian Federation' },
        { value: 'RW', text: 'Rwanda' },
        { value: 'BL', text: 'Saint Barthélemy' },
        { value: 'SH', text: 'Saint Helena, Ascension and Tristan da Cunha' },
        { value: 'KN', text: 'Saint Kitts and Nevis' },
        { value: 'LC', text: 'Saint Lucia' },
        { value: 'MF', text: 'Saint Martin (French part)' },
        { value: 'PM', text: 'Saint Pierre and Miquelon' },
        { value: 'VC', text: 'Saint Vincent and the Grenadines' },
        { value: 'WS', text: 'Samoa' },
        { value: 'SM', text: 'San Marino' },
        { value: 'ST', text: 'Sao Tome and Principe' },
        { value: 'SA', text: 'Saudi Arabia' },
        { value: 'SN', text: 'Senegal' },
        { value: 'RS', text: 'Serbia' },
        { value: 'SC', text: 'Seychelles' },
        { value: 'SL', text: 'Sierra Leone' },
        { value: 'SG', text: 'Singapore' },
        { value: 'SX', text: 'Sint Maarten (Dutch part)' },
        { value: 'SK', text: 'Slovakia' },
        { value: 'SI', text: 'Slovenia' },
        { value: 'SB', text: 'Solomon Islands' },
        { value: 'SO', text: 'Somalia' },
        { value: 'ZA', text: 'South Africa' },
        { value: 'GS', text: 'South Georgia and the South Sandwich Islands' },
        { value: 'SS', text: 'South Sudan' },
        { value: 'ES', text: 'Spain' },
        { value: 'LK', text: 'Sri Lanka' },
        { value: 'SD', text: 'Sudan' },
        { value: 'SR', text: 'Suriname' },
        { value: 'SJ', text: 'Svalbard and Jan Mayen' },
        { value: 'SZ', text: 'Swaziland' },
        { value: 'SE', text: 'Sweden' },
        { value: 'CH', text: 'Switzerland' },
        { value: 'SY', text: 'Syrian Arab Republic' },
        { value: 'TW', text: 'Taiwan, Province of China' },
        { value: 'TJ', text: 'Tajikistan' },
        { value: 'TZ', text: 'Tanzania, United Republic of' },
        { value: 'TH', text: 'Thailand' },
        { value: 'TL', text: 'Timor-Leste' },
        { value: 'TG', text: 'Togo' },
        { value: 'TK', text: 'Tokelau' },
        { value: 'TO', text: 'Tonga' },
        { value: 'TT', text: 'Trinidad and Tobago' },
        { value: 'TN', text: 'Tunisia' },
        { value: 'TR', text: 'Turkey' },
        { value: 'TM', text: 'Turkmenistan' },
        { value: 'TC', text: 'Turks and Caicos Islands' },
        { value: 'TV', text: 'Tuvalu' },
        { value: 'UG', text: 'Uganda' },
        { value: 'UA', text: 'Ukraine' },
        { value: 'AE', text: 'United Arab Emirates' },
        { value: 'GB', text: 'United Kingdom' },
        { value: 'US', text: 'United States' },
        { value: 'UM', text: 'United States Minor Outlying Islands' },
        { value: 'UY', text: 'Uruguay' },
        { value: 'UZ', text: 'Uzbekistan' },
        { value: 'VU', text: 'Vanuatu' },
        { value: 'VE', text: 'Venezuela, Bolivarian Republic of' },
        { value: 'VN', text: 'Viet Nam' },
        { value: 'VG', text: 'Virgin Islands, British' },
        { value: 'VI', text: 'Virgin Islands, U.S.' },
        { value: 'WF', text: 'Wallis and Futuna' },
        { value: 'EH', text: 'Western Sahara' },
        { value: 'YE', text: 'Yemen' },
        { value: 'ZM', text: 'Zambia' },
        { value: 'ZW', text: 'Zimbabwe' }
      ],
      inquiryForm: {
        name: null,
        email: null,
        company: null,
        country: 'TW',
        phone: null,
        subject: null,
        message: null,
        newsletter: false
      }
    }
  },
  created () {
    if (Store.get('inquiry') || Store.get('inventory')) {
      this.fetchData()
    }
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
      let categoryids = Inquiry.getAll('inquiry')
      let inventoryids = Inquiry.getAll('inventory')
      var categoryidArray = {}
      var inventoryidArray = {}
      // Convert Array to JSON Object
      for (var i = 0; i < categoryids.length; i++) {
        categoryidArray[i] = categoryids[i]
      }
      for (var index = 0; index < inventoryids.length; index++) {
        inventoryidArray[index] = inventoryids[index]
      }
      categoryidArray = JSON.stringify(categoryidArray)
      inventoryidArray = JSON.stringify(inventoryidArray)
      this.error = this.data = null
      this.loading = true
      Api.getInquiryItems(categoryidArray, inventoryidArray, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.products = data
        }
      })
    },
    removeInquiryItem (id) {
      console.log(id)
      // Remove from localStorge
      Inquiry.removeInquiry(id)
      // Remove from data
      for (var i = 0; i < this.products.category.length; i++) {
        if (this.products.category[i].id === id) {
          this.products.category.splice(i, 1)
          // Emit an event to parent
          this.$parent.$emit('updateInquiry', 1)
        } else {
          console.log('no matched item.')
        }
      }
    },
    removeInventoryItem (id) {
      console.log(id)
      // Remove from localStorge
      Inquiry.removeInventory(id)
      // Remove from data
      for (var i = 0; i < this.products.inventory.length; i++) {
        if (this.products.inventory[i].id === id) {
          this.products.inventory.splice(i, 1)
          // Emit an event to parent
          this.$parent.$emit('updateInquiry', 1)
        } else {
          console.log('no matched item.')
        }
      }
    },
    submit (e) {
      var contactfromdata
      this.$validator.validateAll()
      if (this.errors.any()) {
        e.stopPropagation()
        e.preventDefault()
      } else {
        // Fetch localStorge
        let categoryids = Inquiry.getAll('inquiry')
        let inventoryids = Inquiry.getAll('inventory')
        var categoryidArray = {}
        var inventoryidArray = {}
        // Convert Array to JSON Object
        for (var i = 0; i < categoryids.length; i++) {
          categoryidArray[i] = categoryids[i]
        }
        for (var index = 0; index < inventoryids.length; index++) {
          inventoryidArray[index] = inventoryids[index]
        }
        categoryidArray = JSON.stringify(categoryidArray)
        inventoryidArray = JSON.stringify(inventoryidArray)
        // name,email,phone,company,country,subject,message,is_allow
        contactfromdata = {
          pid: categoryidArray,
          inid: inventoryidArray,
          name: this.inquiryForm.name,
          email: this.inquiryForm.email,
          phone: this.inquiryForm.phone,
          company: this.inquiryForm.company,
          country: this.inquiryForm.country,
          subject: this.inquiryForm.subject,
          message: this.inquiryForm.message,
          is_allow: (this.inquiryForm.agreement) ? 1 : 0
        }
        console.log(contactfromdata)
        Api.postInquiry(contactfromdata, (err, data) => {
          this.loading = false
          if (err) {
            this.error = err.toString()
          } else {
            this.data = data
          }
        })
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
        background-repeat: no-repeat;
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
    .inquiry-list {
      overflow-x: auto;
      .btn.rounded.green {
        padding: .3em 2em;
      }
      img {
        width: 60px; 
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
                background-color: rgba($white,.2);
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
