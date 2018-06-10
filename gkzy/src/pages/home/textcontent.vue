<template>
  <div class="text-page">
    <div class="title">
      <div v-model="title.atitle" class="title-t">{{title.atitle}}</div>
      <div v-model="title.author" class="title-a">— — {{title.author}}</div>
    </div>
    <div v-model="title.acontent" class="content">
      {{title.acontent}}
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created(){
      this.loadText()
    },
    data () {
      return {
        title: {
          aid: '',
          atitle: '',
          author: '',
          acontent: ''
        }
      }
    },
    methods: {
      loadText(){
        api.get(`index/article?aid=${this.$route.params.aid}`).then((res) =>{
          res = res.data
          if(res.code ===0)
            this.title = res.data
          else
            this.$message.error('加载数据失败')
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .text-page {
    width: 960px;
    margin: 0 auto;
    .title {

      .title-t {
        margin-top: 50px;
        text-align: center;
        font-size: 28px;
        font-weight: 500;
        letter-spacing: 10px;
      }
      .title-a {
        text-align: right;
        margin-right: 40px;
        font-size: 14px;
        font-weight: 300;
      }
    }
    .content {

    }
  }
</style>
