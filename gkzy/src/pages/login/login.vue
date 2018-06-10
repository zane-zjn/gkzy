<template>
  <div class="login">
    <div class="login_whole"><!--登录框内容 -->
      <div class="login_top"><!--登录框头部 -->
        高考志愿推荐系统
      </div>
      <div class="login_content"><!--登录框输入框 -->
        <el-form>
          <div class="input-control">
            <el-form-item>
              <el-input class="el-input" v-model="uname" placeholder="请输入帐号"></el-input>
            </el-form-item>
          </div>
          <div class="input-control">
            <el-form-item>
              <el-input @keyup.enter.native="login" class="el-input" v-model="upw" type="password" placeholder="请输入密码"></el-input>
            </el-form-item>
          </div>
        </el-form>

      </div>

      <div class="login_check"><!--验证码模块 -->
        <!--<router-link to="/home"><i>验证码</i></router-link>-->
        <!--<router-link to="/admin"><i>验证码</i></router-link>-->
        <!--<router-link to="/personal"><i>验证码</i></router-link>-->
      </div>
      <div class="login_button"><!--登录框登录按钮 -->
        <el-button class="el-button1" plain type="primary" @click="login">登录</el-button>
        <el-button class="el-button2" plain type="info" @click="test">注册</el-button>
      </div>
    </div>
  </div>
</template>
<script type="es6">
  import ElInput from '../../../node_modules/element-ui/packages/input/src/input.vue'
  import api from '../../api'

  export default {
    data () {
      return {
        uname: '',
        upw: ''
      }
    },
    components: {
      ElInput
    },
    methods: {
      test () {
        this.$router.push({path: '/reg'})
      },
      login () {
        api.post('/login', {'uname': this.uname, 'upw': this.upw}).then(res => {
            console.log(res)
            res = res.data
            if (0 === res.code) {
              this.$message.success('登录成功')
              console.log(res.data)
              window.localStorage.setItem('user', JSON.stringify(res.data))
              window.localStorage.setItem('token', res.data.token)
              this.$router.replace({
                path: '/home'
              })
            } else {
              this.$message.error(res.message)
            }
          }
        ).catch((err) => {
          this.$message.error(err)
        })

      }
    }

  }


</script>
<style scoped>
  .login {
    height: 100vh;
    margin: 0;
    padding: 0;
    background-image: url(../../image/bglogin.jpg);
    background-size: 100% 100%;
  }

  .login_whole {
    position: absolute;
    box-sizing: border-box;
    /*height: 360px;*/
    width: 500px;
    left: 50%;
    top: 50%;
    margin-left: -250px;
    margin-top: -200px;
    padding: 20px;
    border-radius: 10px;
    background-color: rgba(255, 255, 255, 0.1);

  }

  .login_top {
    height: 100px;
    line-height: 100px;
    text-align: center;
    font-size: 40px;
    color: #fff;
  }

  .login_content {
  }

  .login_content .input-control {
    margin: 10px auto;
    width: 350px;
  }

  .login_check {
    text-align: center;
  }

  .login_button {
    padding: 30px 0;
    text-align: center;
  }

  .el-button1 {
    margin-right: 50px;
  }

  .el-button2 {

    margin-left: 50px;
  }
</style>
