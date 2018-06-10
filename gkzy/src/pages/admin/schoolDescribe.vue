<template>
  <div class="describe-page">
    <div class="tiaozhuan">
      <router-link :to="`/admin/schoolRecruit/${$route.params.sid}`"><i class="el-icon-arrow-left"></i>上一项</router-link>
      <router-link :to="`/admin/schoolFraction/${$route.params.sid}`">下一项 <i class="el-icon-arrow-right"></i></router-link>
    </div>
    <div class="message">
      <span>学校信息</span>
      <el-form label-position="right" label-width="80px" :model="school">
        <el-form-item class="picture" label-width="0">
          <ul>
            <li>
              <el-upload
                class="avatar-uploader"
                action="https://api.sa.gqxqd.cn/upload"
                :show-file-list="false"
                :on-success="handleAvatarSuccess1"
                :before-upload="beforeAvatarUpload1">
                <img v-if="school.sphoto" :src="school.sphoto" class="image">
                <i v-else class="el-icon-plus"></i>
              </el-upload>
              <span>院校校徽</span>
            </li>
            <li>
              <el-upload
                class="avatar-uploader"
                action="https://api.sa.gqxqd.cn/upload"
                :show-file-list="false"
                :on-success="handleAvatarSuccess2"
                :before-upload="beforeAvatarUpload2">
                <img v-if="school.spicture" :src="school.spicture" class="image">
                <i v-else class="el-icon-plus"></i>
              </el-upload>
              <span>正门图片</span>
            </li>
          </ul>
        </el-form-item>
        <el-form-item label="院校名称">
          <el-input v-model="school.sname"></el-input>
        </el-form-item>
        <el-form-item label="院校类型">
          <el-input v-model="school.stype"></el-input>
        </el-form-item>
        <el-form-item label="创建时间">
          <el-input v-model="school.stime"></el-input>
        </el-form-item>
        <el-form-item label="所属省市">
          <el-input v-model="school.sregion"></el-input>
        </el-form-item>
        <el-form-item label="院校地址">
          <el-input v-model="school.saddress"></el-input>
        </el-form-item>
        <el-form-item label="院校特色">
          <el-input v-model="school.schara"></el-input>
        </el-form-item>
        <el-form-item label="学历层次">
          <el-input v-model="school.sarrang"></el-input>
        </el-form-item>
        <el-form-item label="学费信息">
          <el-input v-model="school.scost"></el-input>
        </el-form-item>
        <el-form-item label="官网链接">
          <el-input v-model="school.slink"></el-input>
        </el-form-item>
        <el-form-item label="在校人数">
          <el-input v-model="school.smember"></el-input>
        </el-form-item>
        <el-form-item label="男女比例">
          <el-input v-model="school.spropor"></el-input>
        </el-form-item>
        <el-form-item label="学校简介">
          <el-input type="textarea" v-model="school.sintroduction" :autosize="{minRows: 4, maxRows: 10}"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存</el-button>
        </el-form-item>
      </el-form>

    </div>

  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadSchool()
    },
    data () {
      return {
        school: {
          sphoto: '',
          spicture: '',
          sname: '北京大学',
          stype: '综合类',
          stime: '1989',
          sregion: '北京',
          saddress: '北京市海淀区颐和园路5号',
          schara: '985高校',
          sarrang: '本科',
          scost: '5000',
          slink: 'http://www.pku.edu.cn/',
          smember: '39852',
          spropor: '1：1',
          sintroduction: '这是北京大学'
        }

      }
    },
    methods: {
      loadSchool () {
        api.get(`admin/school?sid=${this.$route.params.sid}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.school = res.data
          } else {
            this.$message.error('加载数据失败')
          }
        })
      },
      handleAvatarSuccess1 (res) {
        if (!res.data) {
          this.$message.error('上传图片失败')
        } else {this.school.sphoto = res.data}
      },
      handleAvatarSuccess2 (res) {
        if (!res.data) {
          this.$message.error('上传图片失败')
        } else {
          this.school.spicture = res.data
        }
      },
      beforeAvatarUpload1 () {},
      beforeAvatarUpload2 () {},
      onSubmit () {
        this.$confirm('确定保存以上信息？', '大学管理', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'primary'
        }).then(() => {
          api.put(`admin/school/${this.$route.params.sid}`, this.school).then((res) => {
            res = res.data
            if (res.code === 0) {
              this.$message.success('保存成功')
            } else {
              this.$message.error('保存失败')
            }
          })
        }).catch(() => {

        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .describe-page {
    .tiaozhuan {
      a{
        text-decoration: none;
      }
      margin: 10px 0;
      text-align: center;
      .el-icon-arrow-left {
        text-decoration: none;
      }
      .el-icon-arrow-right {
        text-decoration: none;
      }

    }
    .message {
      width: 800px;
      margin: 30px auto 0;
      span {
        font-size: 25px;
        font-weight: bold;
      }
      .picture {
        margin: 0;
        text-align: center;
        padding: 0;
        ul {
          margin: 0;
          padding: 0;
        }
        li {
          display: inline-block;
          text-align: center
        }
        span {
          font-size: 14px;
          font-weight: 500;
          color: #606266;
        }
        .avatar-uploader {
          margin: 0 30px;
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
          .image {
          }
          .el-icon-plus {
            font-size: 50px;
            text-align: center;
          }
        }
      }
    }

  }
</style>
