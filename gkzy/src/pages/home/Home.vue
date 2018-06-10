<template>
  <div class="home">
    <v-header></v-header>
    <div class="main-container">
      <router-view></router-view>
    </div>
    <v-footer class="footer"></v-footer>
  </div>
</template>
<script type="es6">


  import Header from './../../components/header/Header.vue'
  import Footer from './../../components/footer/Footer.vue'

  export default {

    components: {
      VHeader: Header,
      VFooter: Footer
    },
    create () {

    }
  }
</script>
<style lang="less" scoped>
  .home {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  router-view {
    /*min-height: 100%;*/
  }

  .main-container {
    flex: 1;
  }

  .footer {

  }
</style>
