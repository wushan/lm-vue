<template lang="pug">
  .post
    .loading(v-if="loading") Loading...
    .error(v-if="error") {{error}}
    p Params: {{$route.params.id}}
    h2 內部連結2
    page-navigation
    transition(name="slide")
      .content(v-if="post", :key="post.id")
        h2 Title: {{post.title}}
        p Body: {{post.body}}
        p ID: {{post.id}}
  
</template>

<script>
import Api from '../api'
import Navigation from './Navigation.vue'
export default {
  components: {
    'page-navigation': Navigation
  },
  data () {
    return {
      loading: false,
      post: null,
      error: null
    }
  },
  created () {
    this.fetchData()
  },
  watch: {
    '$route': 'fetchData'
  },
  methods: {
    fetchData () {
      this.error = this.post = null
      this.loading = true

      Api.getPost(this.$route.params.id, (err, post) => {
        this.loading = false
        if (err) {
          this.error = err.toString()
        } else {
          this.post = post
        }
      })
    }
  }
}
</script>

<style lang="scss">

</style>
