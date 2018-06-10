<template>
  <header>
    <div class="header">
      <div class="logo">
        <img src="/static/image/logo.jpg" alt="">
      </div>
      <div class="right">
        <div v-if="!user" class="login">
          <el-button size="mini" type="text" @click="test1">登录</el-button>
          |
          <el-button size="mini" type="text" @click="test2">注册</el-button>
        </div>
        <div v-else class="user">
          <router-link to="/personal">
            <el-button size="mini" type="text">{{user.uname}}</el-button>
          </router-link>
          |
          <el-button size="mini" type="text" @click="logout">退出</el-button>
        </div>
        <div class="top">
          <ul>
            <li>
              <router-link to="/home/major">首页</router-link>
            </li>
            <li>
              <router-link to="/home/recom">志愿推荐</router-link>
            </li>
            <li>
              <router-link to="/home/search">大学查询</router-link>
            </li>
            <li>
              <router-link to="/home/about">关于我们</router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bg"></div>
  </header>
</template>
<script type="es6">
  export default {
    data () {
      return {}
    },
    methods: {
      test1 () {
        this.$router.push({path: '/login'})
      },
      test2 () {
        this.$router.push({path: '/reg'})
      },
      logout () {
        window.localStorage.clear()
        this.$message.success('退出成功')
        this.$router.push('/')
      }
    },
    computed: {
      user () {
        if (window.localStorage.user)
          return JSON.parse(window.localStorage.user)
        else
          return null
      }
    }
  }
</script>
<style lang="less" scoped>
  header {
    position: relative;
    .header {
      display: flex;
      width: 960px;
      margin: 0 auto;
      .logo {
        width: 120px;
        height: 120px;
        background-color: #0251ff;
        img {
          width: 120px;
          height: 120px
        }
      }

      .right {
        flex: 1;
        .login {
          text-align: right;
        }
        .user {
          text-align: right;

        }
        .top {
          ul {
            li {
              display: inline-block;
              font-size: 25px;
              margin-right: 50px;
              margin-top: 10px;
              a {
                text-decoration: none;
                color: #fff;
              }
            }
            list-style: none;

          }
        }
      }
    }
    .bg {
      z-index: -1;
      position: absolute;
      left: 0;
      top: 25px;
      right: 0;
      bottom: 0;
      background-color: rgba(4, 162, 255, 0.7);
    }
  }

</style>
