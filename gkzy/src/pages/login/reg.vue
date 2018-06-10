<template>
  <div class="login">
    <div class="login_whole"><!--注册框内容 -->
      <div class="login_top"><!--注册框头部 -->
        高考志愿推荐系统
      </div>

      <div class="login_content"><!--登录框输入框 -->
        <el-form>
          <div class="input-control">
            <el-form-item>
              <el-input class="el-input" v-model="ruleForm.uname" placeholder="请输入用户名"></el-input>
            </el-form-item>
          </div>
          <div class="input-control">
            <el-form-item>
              <el-input class="el-input" v-model="ruleForm.upw" type="password" placeholder="请输入密码"></el-input>
            </el-form-item>
          </div>
        </el-form>
      </div>
      <div class="login_button"><!--登录框登录按钮 -->
        <el-button class="el-button1" plain type="primary" @click="regUser">注册</el-button>
        <el-button class="el-button2" plain type="info" @click="restart1">重置</el-button>
      </div>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'


  export default {
    data () {
      return {
        ruleForm: {
          uname: '',
          upw: ''
        },

      }

    },
  methods: {
    regUser(){
      if(!this.ruleForm.uname){
        return this.$message.error('用户名不能为空')
      }
      if(!this.ruleForm.upw){
        return this.$message.error('密码不能为空')
      }else {
        api.post('/user', this.ruleForm).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.$message.success('注册成功')
            this.$router.replace({
              path: '/login'
            })
          } else {
            this.$message.error(res.message)
          }
          console.log(res)
        })
          .catch((err) => {
            this.$message.error(err)
          })
      }

    },

    restart1(){
      this.ruleForm = []
    }
  }
  }
</script>
<style scoped>
  /* 背景样式*/
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
