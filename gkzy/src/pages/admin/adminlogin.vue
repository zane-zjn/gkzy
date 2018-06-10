<template>
  <div class="admin-login">
    <div class="login-area">
      <div class="title1">
        管理员登录
      </div>
      <div class="content">
        <el-input placeholder="请输入帐号" v-model="name">
          <template slot="prepend">帐号</template>
        </el-input>
        <el-input type="password" placeholder="请输入密码" v-model="password">
          <template slot="prepend">密码</template>
        </el-input>
        <el-button @click="login" type="info">登录</el-button>
      </div>
    </div>
  </div>

</template>
<script type="es6">
  import api from '../../api'

  export default {
    data () {
      return {
        name: '',
        password: ''
      }
    },
    methods: {
      login () {
        if (this.name && this.password) {
          api.post('admin/login', {
            name: this.name,
            password: this.password
          }).then((res) => {
            res = res.data
            if (res.code === 0) {
              this.$message.success('登录成功')
              window.localStorage.setItem('token', res.data)
              this.$router.replace({
                path: '/admin'
              })
            } else {
              this.$message.error(res.message)
            }
          })
        } else {
          this.$message.error('用户名或密码不能为空')
        }
      }
    }
  }
</script>
<style lang="less" scoped>
  .admin-login {
    background-image: url(../../../static/image/bgadmin.jpg);
    background-size: 100% 100%;
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    .login-area {

      position: absolute;
      left: 50%;
      top: 50%;
      margin-top: -200px;
      margin-left: -250px;
      width: 500px;
      height: 400px;
      .title1 {
        margin-top: 20px;
        text-align: center;
        font-size: 30px;
        padding-bottom: 20px;
      }
      .content {
        text-align: center;
        width: 300px;
        margin: 20px auto 0;
        button {
          width: 300px;
          margin-top: 20px
        }
      }
    }
  }
</style>
