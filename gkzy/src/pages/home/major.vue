<template>
  <div class="major_all">
    <div class="major_ppt">
      <div class="block">
        <el-carousel class="el-carousel"> <!--幻灯片-->
          <el-carousel-item v-for="item in pictures" :key="item.rname" class="el-carousel-item">
            <img :src="item.rcontent" alt="">
          </el-carousel-item>
        </el-carousel>
      </div>
    </div>
    <div class="major_text">
      <ul>
        <li v-for="item in textTitles">
          <router-link :to="`textcontent/${item.aid}`">{{item.atitle}}</router-link>
        </li>
      </ul>
    </div>
    <div class="major_link">
      <ul>
        <li v-for="item in weblink" class="afsda"><a :href="item.rcontent">{{item.rname}}</a></li>
      </ul>
    </div>
  </div>

</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadArticle()
      this.loadPicture()
      this.loadLink()
    },
    data () {
      return {
        pictures: [],

        textTitles: [],
        weblink: []
      }
    },
    methods: {
      loadPicture () {
        api.get('index/resources', {params: {rtype: 'picture'}}).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.pictures = res.data
          } else {
            this.$message.error('数据加载失败')
          }
        })
      },
      loadLink () {
        api.get('index/resources', {params: {rtype: 'link'}}).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.weblink = res.data
          } else {
            this.$message.error('数据加载失败')
          }
        })
      },
      loadArticle () {
        api.get('index/article').then((res) => {
          res = res.data
          if (res.code === 0) {
            this.textTitles = res.data
          } else {
            this.$message.error('数据加载失败')
          }
        })
      }
    }

  }
</script>
<style lang="less" scoped>
  .major_all {

    width: 960px;
    margin: 0 auto;
  }

  /*幻灯片主体div样式*/
  .major_ppt {
    height: 400px;
  }

  .el-carousel {
    height: 400px;
  }

  .el-carousel-item {
    color: #475669;
    height: 400px;
    img {
      width: 100%;

    }
  }

  /*幻灯片底色*/
  .el-carousel-item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel-item:nth-child(2n+1) {
    background-color: #d3dce6;

  }

  .major_text {
    margin-top: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);

  }

  ul {
    margin: 0;
    padding: 0;
  }

  li {
    list-style-type: none;
    display: inline-block;
    width: 450px;
    margin: 10px 0 10px 20px;
  }

  a {
    text-decoration: none;
    color: rgba(0, 0, 0, 0.64);
  }

  .major_link {
    margin-top: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);
  }
</style>
