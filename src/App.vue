<template>
  <div>
    <p>{{$route.params}}</p>
    <p>{{$route.path}}</p>
    <ul>
      <li>
        <router-link to="/" activeClass="active">HOME</router-link>
      </li>
      <li>
        <router-link to="/post/1" activeClass="active">POST 1</router-link>
      </li>
      <li>
        <router-link to="/post/2" activeClass="active">POST 2</router-link>
      </li>
    </ul>
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
</template>

<script>
export default {
  data () {
    return {
      msg: 'Hello Vue'
    }
  }
}
</script>

<style lang="scss">
  // Global Styles
  @import "bower_components/bourbon/app/assets/stylesheets/bourbon";
  @import "bower_components/susy/sass/susy";
  @import "bower_components/breakpoint-sass/stylesheets/breakpoint";
  //Normalize
  @import "src/assets/styles/normalize";
  // Susy Global
  $susy: (
    columns: 12,
    gutters: .1,
    math: fluid,
  );
  @import "src/assets/styles/general/general";
  
</style>
