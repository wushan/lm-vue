<template lang="pug">
    main
        #main
            page-navigation(v-bind:inquiryLength="inquiryLength", v-bind:submenu="submenu")
            #errorshooting
                section.errorshooting-wrapper.middler-wrapper
                  .middler
                    .container.restrict-large
                        .title.centered
                            h1 ERROR SHOOTING
                    .container.restrict-small
                        form#searchForm.machine-search-form
                            .controlgroup
                                .controls
                                    input.rounded(type="text", placeholder="Input Error Code", v-model="errorcode", @keyup="searching", @focus="searching")
                                    .fa.fa-search.fa-2x
                                    .machine-type(v-if="isSearching")
                                        h5 Please Select Machine Type
                                        ul.machine-type-list
                                            li(v-for="model in models")
                                                a.type(@click="startSearch(model.id)") {{ model.name }}/{{model.id}}
                    .container(v-if="error")
                        p {{ error }}
                    transition(name="fade", mode="out-in")
                      .container.error-list(v-if="searchResults")
                          .restrict-large
                              .error-pagination
                                  a(@click="firstStep")
                                      .first-step
                                      span FIRST STEP
                                  a(@click="navPrev")
                                      .prev-step
                                      span PREV STEP
                              ul
                                  li(v-for="result in filteredData.steps")
                                      .title
                                          a.btn.rounded.green.full(v-if="result.steps" @click="updateResults(result.id, result)")
                                              span {{ result.name }}
                                              .fa.fa-lg.fa-caret-right
                                          a.btn.rounded.green.full(v-else)
                                              span {{ result.name }}
                                              .fa.fa-lg.fa-caret-right
                                      .error-message
                                          .content
                                              .description
                                                  p DEBUG/{{ result.id }}
                                                  p {{ result.description }}
                                              .thumbnail
                                                  img(v-bind:src="result.image")
                                              .download
                                                  a.btn.rounded.green.full.centered(v-bind:href="result.downloads") PDF DOWNLOAD
                          .restrict-large
                            form.send-errors#send-errors
                              .row
                                .block
                                  .row
                                    .grid.g-4-12 SUBMIT TICKET TO LYMCO
                                    .grid.g-8-12
                                      .controlgroup
                                        input#file(name="file", type="file", @change="updateFileInput")
                                        label(for="file")
                                          .filename
                                          span Browse
                                .block
                                  .controlgroup
                                    .table
                                      .table-c.t-8-10
                                        textarea(name="description", v-model="errorFrom.description")
                                      .table-c.t-2-10
                                        button.fatty.btn.basic.full(@click.prevent.stop="sendErrors") SEND

        transition(name="fade", mode="out-in")
            #loader(v-if="loading")
                .uil-ring-css(style="transform:scale(0.6);")
                    div
</template>

<script>
import Navigation from './Navigation.vue'
import Api from '../api'
import Store from '../assets/vendor/store'
// Expose Jquery Globally.
import $ from 'jquery'
window.jQuery = window.$ = $
require('imports?$=jquery!../assets/vendor/jquery.sticky.js')
let timer
export default {
  name: 'errorshooting',
  components: {
    'page-navigation': Navigation
  },
  props: ['inquiryLength', 'submenu', 'isAuth'],
  data () {
    return {
      loading: false,
      errorcode: '',
      isSearching: false,
      models: null,
      selectedModel: '',
      searchResults: null,
      query: null,
      errorFrom: {
        description: '',
        files: null
      }
    }
  },
  created () {
    this.fetchData()
    // ;(function ($, window, document) {
    //   $('input[type=file]').each(function () {
    //     var $input = $(this)
    //     var $label = $input.next('label')
    //     var labelVal = $label.html()
    //     $input.on('change', function (e) {
    //       var fileName = ''
    //       if (this.files && this.files.length > 1) {
    //         fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length)
    //       } else if (e.target.value) {
    //         fileName = e.target.value.split('\\').pop()
    //       }
    //       if (fileName) {
    //         $label.find('.filename').html(fileName)
    //       } else {
    //         $label.html(labelVal)
    //       }
    //     })
    //     // Firefox bug fix
    //     $input
    //     .on('focus', function () { $input.addClass('has-focus') })
    //     .on('blur', function () { $input.removeClass('has-focus') })
    //   })
    // })($, window, document)
  },
  mounted () {
    $('.sticker').sticky({
      topSpacing: 0,
      zIndex: 999
    })
    if (this.$route.params.model && this.$route.params.errorcode) {
      this.initialSearch(this.$route.params.model, this.$route.params.errorcode)
    }
  },
  watch: {
    '$route.query': 'setQuery',
    'isAuth': 'updateView'
  },
  computed: {
    filteredData () {
      var filteredData
      console.log('math')
      if (this.query) {
        filteredData = this.findNode(this.query, this.searchResults)
      } else {
        filteredData = this.searchResults
      }
      return filteredData
    }
  },
  methods: {
    updateView () {
      if (this.isAuth) {
        this.fetchData()
      }
    },
    firstStep () {
      // Clear query
      this.query = ''
      this.$router.push('/errorshooting/' + this.$route.params.model + '/' + this.$route.params.errorcode)
    },
    navPrev () {
      this.$router.go(-1)
    },
    setQuery () {
      console.log('Query Setted')
      if (this.$route.query.solution) {
        this.query = this.$route.query.solution
        console.log(this.$route.query.solution)
        console.log(this.query)
        console.log(typeof this.$route.query.solution)
      } else {
        this.query = null
      }
    },
    fetchData () {
      this.error = this.dealer = null
      this.loading = true
      var user
      if (Store.get('lymco-auth')) {
        user = Store.get('lymco-auth')
        Api.getMachine(user.id, user.is_login, (err, data) => {
          this.loading = false
          if (err) {
            this.error = err.toString()
          } else {
            this.models = data
          }
        })
      } else {
        this.loading = false
        this.$parent.$emit('showLogin', 1)
      }
    },
    searching () {
      if (this.isSearching) {
        clearTimeout(timer)
        timer = setTimeout(() => {
          this.isSearching = false
          console.log('tick')
        }, 3000)
      } else {
        this.isSearching = true
        console.log('searching')
        if (this.searchResults) {
          this.searchResults = null
        }
        timer = setTimeout(() => {
          this.isSearching = false
          console.log('tick')
        }, 3000)
      }
    },
    initialSearch (id, errorcode) {
      this.selectedModel = id
      this.error = this.dealer = null
      this.loading = true
      this.isSearching = false
      let errorstring
      if (errorcode) {
        errorstring = errorcode
      } else {
        errorstring = this.errorcode
      }
      var user
      if (Store.get('lymco-auth')) {
        user = Store.get('lymco-auth')
        Api.getSolution(user.id, user.is_login, id, errorstring, (err, data) => {
          this.loading = false
          if (err) {
            this.error = err.toString()
          } else {
            this.searchResults = data.error
            this.setQuery()
          }
        })
      } else {
        this.loading = false
        this.$parent.$emit('showLogin', 1)
      }
    },
    startSearch (id, errorcode) {
      this.selectedModel = id
      this.error = this.dealer = null
      this.loading = true
      this.isSearching = false
      let errorstring
      if (errorcode) {
        errorstring = errorcode
      } else {
        errorstring = this.errorcode
      }
      var user
      if (Store.get('lymco-auth')) {
        user = Store.get('lymco-auth')
        Api.getSolution(user.id, user.is_login, id, errorstring, (err, data) => {
          this.loading = false
          if (err) {
            this.error = err.toString()
          } else {
            this.searchResults = data.error
            this.setQuery()
            this.$router.push('/errorshooting/' + id + '/' + errorstring)
          }
        })
      } else {
        this.loading = false
        this.$parent.$emit('showLogin', 1)
      }
    },
    updateResults (id, data) {
      // Update searchResults via query string
      this.$router.push({query: { solution: id }})
    },
    findNode (id, currentNode) {
      var i
      var currentChild
      var result

      if (id === currentNode.id) {
        return currentNode
      } else {
        // Use a for loop instead of forEach to avoid nested functions
        // Otherwise "return" will not work properly
        for (i = 0; i < currentNode.steps.length; i += 1) {
          currentChild = currentNode.steps[i]
          // Search in the current child
          result = this.findNode(id, currentChild)
          // Return the result if the node has been found
          if (result !== false) {
            return result
          }
        }
        // The node has not been found and we have no more options
        return false
      }
    },
    updateFileInput (e) {
      var files = e.target.files || e.dataTransfer.files
      var filename = e.target.value.split('\\').pop()
      e.target.nextSibling.childNodes[0].innerText = filename
      // console.log(e.target.nextSibling.childNodes[0].innerText)
      if (!files.length) {
        return
      }
      this.errorFrom.files = files
    },
    sendErrors () {
      console.log(this.errorFrom.description)
      console.log(this.errorFrom.files)
      console.log(this.$route.fullPath)
      Api.sendErrorFrom(this.errorFrom.files, this.$route.fullPath, this.errorFrom.description, (err, data) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          console.log(data)
        }
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
    #errorshooting {
        background-color: $darkgray;
        color: $white;
        padding: 2em 0;
        box-sizing: border-box;
        background-image: url('../assets/images/components/error-bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: left bottom;
        transition: .3s all ease;
        min-height: 100vh;
        @include breakpoint(1280px) {
            background-size: auto 90%;
            background-position: right top;
        }
        @include breakpoint(1680px) {
            background-position: right top;
        }
        .title {
            h1 {
                margin: 0;
                color: $main;
            }
        }
        .errorshooting-wrapper {
          .middler {
            width: 100%; 
          }
        }
        .machine-type {
            background-color: rgba($black, .8);
            border-radius: 0 0 6px 6px;
            width: 90%;
            margin: auto; 
            box-sizing: border-box;
            padding: 1em 0;
            position: absolute;
            top: 56px;
            left: 0;
            right: 0;
            z-index: 99;
            text-align: left;
            h5 {
                margin: 0;
                padding: 0 1em;
                color: $main;
            }
            ul {
                padding: 0 0 0 0;
                margin: 1em 0;
                list-style-type: none;
                a {
                    font-size: 1.1em;
                    padding: .3em 0 .3em 3em;
                    display: block;
                    cursor: pointer;
                    &:hover{
                        background-color: $darkestgray;
                    }
                }
            }
        }
        .error-list {
            position: relative;
            &:before {
                content: '';
                border-bottom: 1px solid $white;
                width: 100%;
                position: absolute;
                top: 124px;
                left: 0;
                box-sizing: border-box;
                @include breakpoint(1900px) {
                    top: 80px;
                }
            }
            ul {
                padding: 0 0 0 0;
                margin: 0;
                list-style-type: none;
                @extend .clr;
                position: relative;
                li {
                    margin-top: 4em;
                    padding: 2em 2em 0 2em;
                    border: 1px solid rgba($white, .7);
                    box-sizing: border-box;
                    @include breakpoint(768px) {
                        @include gallery(6 of 12)
                    }
                    @include breakpoint(1280px) {
                        @include gallery(3 of 12 1)
                    }
                    @include breakpoint(1680px) {
                        @include gallery(3 of 12 2)
                    }
                }
                img {
                    width: 100%; 
                }
            }
            .title {
                position: relative;
                top: -3.5em;
                @include breakpoint(1280px) {
                    left: -4em;
                    width: 120%; 
                }
                @include breakpoint(1680px) {
                    left: -6em;
                    width: 130%; 
                }
                a {
                    position: relative;
                    box-shadow: 3px 3px 6px rgba($black, .66);
                }
                .fa {
                    position: absolute;
                    right: .8em;
                    top: .8em;
                }
            }
            .error-message {
                position: relative;
                top: -1.5em;
            }
            .download {
                margin: 2em 0 0 0;
                font-size: 12px;
            }
        }
        .error-pagination {
            text-align: center;
            font-size: 12px;
            @include breakpoint(1900px) {
                position: absolute;
                left: 0;
                top: 5.8em;
            }
            a {
                margin: 0 1em;
                color: $white;
                text-align: center;
                display: inline-block;
                vertical-align: middle;
                span {
                    display: block;
                }
            }
            .prev-step, .first-step {
                width: 25px;
                height: 25px;
                margin: auto;
                cursor: pointer;
            }
            .prev-step {
                background-image: url('../assets/images/components/prev-step.png');
            }
            .first-step {
                background-image: url('../assets/images/components/first-step.png');
            }
        }
    }
    .machine-search-form {
        .controls {
          position: relative;
          margin: 0;
        }
        input[type="text"] {
            background-color: $white;
            height: 56px;
            border-radius: 30px;
            padding: 0 0 0 5em;
        }
        .fa {
            color: $black;
            position: absolute;
            left: 1em;
            top: .5em;
        }
    }
    .send-errors {
      .block {
        display: inline-block;
        vertical-align: middle;
        width: 48%;
        margin-right: 2%;
        &:last-child {
          margin-right: 0;
        }
      }
      textarea {
        min-height: 100px;  
      }
      .fatty {
        padding: 1em 2em;
        border-radius: 6px;
      }
    }
</style>