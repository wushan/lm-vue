<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
            #contact
                section
                    .container.restrict-large
                        .title
                            h1
                                |   CONTACT
                                span.bold INFO
                            hr

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
                                                          option(v-for="option in countries" v-bind:value="option.value") {{ option.text }}
                                        .row
                                            .controlgroup
                                                input(v-model.number="inquiryForm.phone", type="text", placeholder="PHONE(MOBILE)")
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
  name: 'Contact',
  props: ['inquiryLength', 'submenu'],
  data () {
    return {
      loading: false,
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
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    console.log(this.inquiryLength)
  },
  methods: {
    submit () {
      console.log('send')
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
            hr {
                height: 1px;
                border: none;
                background-color: $white;
            }
        }
        .call-action {
            .btn.basic {
                background-color: darken($main, 15%);
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
            margin-top: .35em;
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