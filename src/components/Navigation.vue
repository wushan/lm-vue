<template lang="pug">
  #navigation
    ul
      li
        router-link.nav-link(to="/" activeClass="active") HOME
      li
        router-link.nav-link(to="/post/1" activeClass="active") POST 1
      li
        router-link.nav-link(to="/post/2" activeClass="active") POST 2
</template>

<script>
</script>

<style lang="scss">
</style>