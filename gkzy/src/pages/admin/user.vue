<template>
  <div class="user-page">
    <div class="user-select">
      <el-input placeholder="请输入内容" v-model="userValue">
        <el-button slot="append" icon="el-icon-search" @click="selectUser"></el-button>
      </el-input>
    </div>
    <div class="select-result" v-if="userResult.length">
      <el-table
        :data="userResult"
        stripe
        style="width: 100%">
        <el-table-column
          prop="uid">
        </el-table-column>
        <el-table-column
          prop="uname">
        </el-table-column>
        <el-table-column>
          <template slot-scope="scope">
            {{scope.row.uemail || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          width="100">
          <template slot-scope="scope">
            {{scope.row.usex || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          width="100">
          <template slot-scope="scope">
            {{scope.row.uaddress || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          width="100">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="changePassword(scope.row.uid)">改密</el-button>
            <el-button type="text" size="small" @click="deleteUser(scope.row.uid)">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <hr>
    <div class="user-list">
      <el-table
        :data="users"
        stripe
        style="width: 100%">
        <el-table-column
          prop="uid"
          label="用户ID">
        </el-table-column>
        <el-table-column
          prop="uname"
          label="用户名">
        </el-table-column>
        <el-table-column
          label="用户邮箱">
          <template slot-scope="scope">
            {{scope.row.uemail || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          label="用户性别"
          width="100">
          <template slot-scope="scope">
            {{scope.row.usex || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          label="文理科"
          width="100">
          <template slot-scope="scope">
            {{scope.row.usubject || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          label="用户省份"
          width="100">
          <template slot-scope="scope">
            {{scope.row.uaddress || '（未设置）'}}
          </template>
        </el-table-column>
        <el-table-column
          label="操作"
          width="100">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="changePassword(scope.row.uid)">改密</el-button>
            <el-button type="text" size="small" @click="deleteUser(scope.row.uid)" class="text-danger">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadUsers()
    },
    data () {
      return {
        userResult: [],
        userValue: '',
        users: [
          {
            id: '123456789',
            name: '泥人渡江',
            password: 'as5a4gasfaag449afaf4a6fasf',
            email: '16556464@qq.com',
            sex: '男',
            address: '广东省'
          },
          {
            id: '000000001',
            name: '海阔天空',
            password: 'as5a4gasfaag449afaf4a6fasf',
            email: '19426654@qq.com',
            sex: '女',
            address: '广东省'
          },
          {
            id: '000000002',
            name: '问心无愧',
            password: 'as5a4gasfaag449afaf4a6fasf',
            email: '16546464@qq.com',
            sex: '女',
            address: '广东省'
          },
          {
            id: '000000005',
            name: '亢龙有悔',
            password: 'as5a4gasfaag449afaf4a6fasf',
            email: '32546464@qq.com',
            sex: '男',
            address: '广东省'
          },
          {
            id: '000000006',
            name: '三尺清风',
            password: 'as5a4gasfaag449afaf4a6fasf',
            email: '16876464@qq.com',
            sex: '难',
            address: '广东省'
          }
        ]
      }
    },
    methods: {
      loadUsers () {
        api.get('admin/user').then((res) => {
          res = res.data
          if (res.code === 0) {
            this.users = res.data
          } else {
            this.$message.error('加载数据错误')
          }
        })
      },
      changePassword (id) {
        this.$alert('确定重置密码？', '删除用户', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.put(`admin/user/${id}`)
                .then((res) => {
                  res = res.data
                  if (res.code === 0) {
                    this.$message.success('重置成功')
                  }
                })
            }
          }
        })
      },
      deleteUser (id) {
        this.$alert('确定删除该用户？', '删除用户', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.delete(`admin/user/${id}`).then((res) => {
                res = res.data
                if (res.code === 0) {
                  this.users = this.users.filter(u => u.uid !== id)
                  this.userResult = this.userResult.filter(u => u.uid !== id)
                  this.$message.success('删除成功')
                }
              })
            }
          }
        })
      },
      selectUser () {
        if (!this.userValue) {
          this.$message.error('请输入所需查询的用户名')
        } else {
          api.get(`admin/user?query=${this.userValue}`).then((res) => {
            res = res.data
            if (!res.data.length) {
              this.$message.error('不存在该用户')
              this.userResult = []
            } else {
              this.userResult = res.data
            }
          })
        }
      }
    }
  }
</script>
<style lang="less" scoped>
  .user-page {
    /*position: absolute;*/
    /*top:100px;*/
    /*left: 50%;*/
    /*margin-left:-350px;*/
    .user-select {
      width: 500px;
      margin: 20px auto;

    }

    .user-list {
      /*max-width: 800px;*/
      /*margin: 0 auto;*/
    }
  }
</style>
