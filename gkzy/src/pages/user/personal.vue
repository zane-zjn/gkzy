<template>
  <div class="personal-page">
    <div class="personal-select">
      <el-menu
        default-active="2"
        class="el-menu-vertical-demo">
        <el-menu-item index="2">
          <i class="el-icon-menu"></i>
          <span slot="title" @click="toMessage">个人信息</span>
        </el-menu-item>
        <el-menu-item index="3">
          <i class="el-icon-menu"></i>
          <span slot="title" @click="toCollection">收藏院校</span>
        </el-menu-item>
        <el-menu-item index="4">
          <i class="el-icon-setting"></i>
          <span slot="title" @click="toSafe">安全中心</span>
        </el-menu-item>
      </el-menu>
    </div>

    <!--个人信息-->
    <div v-if="userMessage" class="personal-content1">
      <div class="personal-picture">
        <el-upload
          class="avatar-uploader"
          action="https://api.sa.gqxqd.cn/upload"
          :show-file-list="false"
          :on-success="handleAvatarSuccess1"
          :before-upload="beforeAvatarUpload1">
          <img v-if="user.uphoto" :src="user.uphoto" class="image">
          <i v-else class="el-icon-plus"></i>
        </el-upload>
        <span>用户头像</span>
      </div>
      <div class="personal-message">
        <el-input v-model="user.uname" disabled>
          <template slot="prepend">　用户名</template>
        </el-input>
        <el-input v-model="user.usex">
          <template slot="prepend">用户性别</template>
        </el-input>
        <el-input v-model="user.ufraction">
          <template slot="prepend">高考分数</template>
        </el-input>
        <el-input v-model="user.usubject">
          <template slot="prepend">　文理科</template>
        </el-input>
        <el-input v-model="user.uaddress">
          <template slot="prepend">用户地址</template>
        </el-input>
        <el-input v-model="user.umail">
          <template slot="prepend">用户邮箱</template>
        </el-input>
        <el-button type="primary" @click="editMessage">修改</el-button>
      </div>
    </div>
    <!--安全中心-->
    <div v-if="userSafe" class="personal-content2">
      <el-input type="password" v-model="oldPassword">
        <template slot="prepend">原密码</template>
      </el-input>
      <el-input type="password" v-model="newPassword">
        <template slot="prepend">新密码</template>
      </el-input>
      <el-input type="password" v-model="newPasswordCheck">
        <template slot="prepend">新密码</template>
      </el-input>
      <el-button type="primary" @click="editPassword">确认</el-button>
    </div>
    <!--院校收藏-->
    <div v-if="userCollection" class="school-collection">
      <ul v-if="schools.length">
        <!--每个大学的li-->
        <li v-for="item in schools">
          <div class="list-content-school">
            <!--大学校徽-->
            <div :style="`background-image: url(${item.school.sphoto})`" class="picture">
              <!--<img src="./../../image/beijing.jpg" alt="">-->
            </div>
            <!--大学名称-->
            <div class="school-name">
              <router-link :to="'/home/school/'+item.sid" class="router-id">{{item.school.sname}}</router-link>
            </div>
            <!--大学信息-->
            <div class="text">
              <ul>
                <li><span class="li-text">学历层次：<span>{{item.school.sarrang}}</span></span></li>
                <li><span class="li-text">创建时间：<span>{{item.school.stime}}</span>年</span></li>
                <li><span class="li-text">所属省份：<span>{{item.school.sregion}}</span></span></li>
                <li><span class="li-text">院校类型：<span>{{item.school.stype}}</span></span></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
      <div v-else class="nodata">尊敬的 <span>{{user.uname}}</span>,你还没有收藏的院校</div>
    </div>
  </div>

</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.toMessage()
    },
    data () {
      return {
        userCollection: false,
        userMessage: true,
        userSafe: false,
        oldPassword: '',
        newPassword: '',
        newPasswordCheck: '',
        schools: [
//          {
//          sid: '001',
//          name: '北京大学',
//          subjection: '教育部',
//          stime: '1989',
//          province: '北京市',
//          type: '综合类',
//          logo: '/static/image/beijing.jpg'
//        }
        ],
        user: {
          uid: '123456789',
          uname: '泥人渡江',
          usex: '男',
          ufraction: '500',
          uaddress: '广东省',
          umail: '16556464@qq.com',
          uphoto: '',
          usubject: ''
        }
      }
    },
    methods: {

      //      获取用户个人信息
      toMessage () {
        this.userCollection = false
        this.userMessage = true
        this.userSafe = false
        api.get('index/user').then((res) => {
          res = res.data
          if (res.code === 0) {
            this.user = res.data
          } else {
            this.$message.error('加载数据失败')
          }
        })
      },
//     修改用户信息
      editMessage () {
        api.put('/user/1', this.user).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.$message.success('修改成功')
          } else {
            this.$message.error('操作失败')
          }
        })
      },
//      获取收藏列表
      toCollection () {
        this.userCollection = true
        this.userMessage = false
        this.userSafe = false
        api.get('index/collection').then((res) => {
          res = res.data
          if (res.code === 0) {
            this.schools = res.data
          } else {
            this.$message.error('加载数据失败')
          }
        })
      },

//      更改密码的方法
      toSafe () {
        this.userCollection = false
        this.userMessage = false
        this.userSafe = true
      },
      editPassword () {
        if (this.newPassword !== this.newPasswordCheck) {
          return this.$message.error('前后输入的新密码不一致')
        } else {
          api.put('index/user', {oldPassword: this.oldPassword, newPassword: this.newPassword}).then((res) => {
            res = res.data
            if (res.code === 0)
              this.$message.success('更改成功')
            else
              this.$message.error(res.message)
          })
        }

      },
      handleAvatarSuccess1 (res) {
        if (!res.data) {
          this.$message.error('上传图片失败')
        } else {
          this.user.uphoto = res.data
          console.log(this.user)
        }
      },
      beforeAvatarUpload1 () {

      }
    }
  }
</script>
<style lang="less" scoped>
  .personal-page {
    display: flex;
    flex-direction: row;
    .personal-select {

      border-right: 1px solid gray;
      height: 100vh;
    }
    .personal-content1 {

      width: 100%;
      padding-top: 30px;
      .personal-picture {
        span {
          color: #909399;
        }
        text-align: center;
        .avatar-uploader {
          margin: 0 auto;
          width: 100px;
          height: 100px;
          line-height: 100px;
          font-size: 50px;
          text-align: center;
          border: 1px dashed gray;
          border-radius: 10px;
          overflow: hidden;
          &:hover {
            color: #04a2ff;
            border-color: rgba(4, 162, 255, 0.7);
          }
          .el-icon-plus {
            font-size: 50px;
            text-align: center;
          }

        }
      }
      .personal-message {
        width: 600px;
        margin: 0 auto;
        padding-top: 30px;
        text-align: center;
        button {
          margin-top: 30px;
        }
      }
    }
    .personal-content2 {
      width: 600px;
      margin: 50px auto;
      text-align: center;
      button {
        margin-top: 30px;
      }
    }
    .school-collection {
      margin: 0 auto;
      ul{
        padding-left: 0;
      }
      li {
        list-style-type: none
      }
      .nodata {
        text-align: center;
        span {
          color: #E6A23C;
        }
      }
      .list-content-school {
        display: flex;
        flex-direction: row;
        height: 120px;
        margin: 10px 0;
        padding: 5px 0;
        border-bottom: 1px solid #e5e5e5;
        a {
          text-decoration: none;
          color: rgba(0, 0, 0, 0.8);
          font-family: "新宋体"
        }
        a:hover {
          color: rgba(4, 162, 255, 0.7)
        }
        .picture {
          width: 120px;
          height: 120px;
          background-position: center;
          background-size: 120px;
        }
        .picture:hover {
        }
        .school-name {
          text-align: center;
          width: 400px;
          font-size: 30px;
          line-height: 120px;
          .router-id {

          }
        }
        .text {
          width: 400px;
          padding-left: 50px;
          li {
            list-style-type: none;
            height: 30px;
            line-height: 30px;
          }
          .li-text {
            color: gray;

          }
        }

      }
    }
  }
</style>
