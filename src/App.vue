<template lang="pug">
  #wrapper
    transition(name="fade", mode="out-in")
      router-view
    footer#footer
      .footer-inner
        .block
          a(href="javascript:;") Privacy
          a(href="javascript:;") Term of use
        .block
          span
            | Lywentech, Co., Ltd. All rights reserved. | Designed by 
            a(href="javascript:;") SUBKARMA

    .off-canvas
      nav.off-canvas-navigation
    
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
