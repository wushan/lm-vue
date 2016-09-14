<template>
  <div id="app">
    <img src="./assets/logo.png">
    <h1>{{ msg }} !!!</h1>
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
