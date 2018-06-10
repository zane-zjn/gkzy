<template>
  <div class="major-page">
    <div class="tiaozhuan">
      <router-link :to="`/admin/schoolFraction/${$route.params.sid}`"><i class="el-icon-arrow-left"></i>上一项</router-link>
      <router-link :to="`/admin/schoolRecruit/${$route.params.sid}`">下一项 <i class="el-icon-arrow-right"></i></router-link>
    </div>
    <el-button type="primary" @click="add_Major">添加</el-button>
    <el-table
      :data="Majors"
      border
      style="width: 100%">
      <el-table-column
        min-width="25%"
        prop="mname"
        label="专业名称">
      </el-table-column>
      <el-table-column
        min-width="25%"
        prop="mtype"
        label="专业类型">
      </el-table-column>
      <el-table-column
        min-width="50%"
        prop="mintroduce"
        label="专业描述">
      </el-table-column>
      <el-table-column
        fixed="right"
        label="操作"
        width="100">
        <template slot-scope="scope">
          <el-button type="text" size="small" @click="edit(scope.row)">编辑</el-button>
          <el-button type="text" size="small" @click="deleteMajor(scope.row.mid)" class="text-danger">删除</el-button>
        </template>
      </el-table-column>
    </el-table>
    <!--编辑功能弹出框-->
    <el-dialog title="录取分数线" :visible.sync="dialogFormVisible2">
      <el-form label-width="80px">
        <el-form-item label="专业名称">
          <el-input v-model="currentMajor.mname"></el-input>
        </el-form-item>
        <el-form-item label="专业类型">
          <el-input v-model="currentMajor.mtype"></el-input>
        </el-form-item>
        <el-form-item label="专业描述">
          <el-input type="textarea" v-model="currentMajor.mintroduce"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible2 = false">取 消</el-button>
        <el-button type="primary" @click="editMajor">确 定</el-button>
      </div>
    </el-dialog>

    <!--添加功能对话框-->

    <el-dialog title="录取分数线" :visible.sync="dialogFormVisible1">
      <el-form label-width="80px">
        <el-form-item label="专业名称">
          <el-input v-model="addMajor.mname"></el-input>
        </el-form-item>
        <el-form-item label="专业类型">
          <el-input v-model="addMajor.mtype"></el-input>
        </el-form-item>
        <el-form-item label="专业描述">
          <el-input type="textarea" v-model="addMajor.mintroduce"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible1 = false">取 消</el-button>
        <el-button type="primary" @click="add_Major1">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadMajor()
    },
    data () {
      return {
        dialogFormVisible1: false,
        dialogFormVisible2: false,
        currentMajor: {mname: '', mtype: '', mintroduce: ''},
        addMajor: {mname: '', mtype: '', mintroduce: ''},
        Majors: [{mid: '1', mname: '信息与计算科学', mtype: '数学类', mintroduce: '主要学习各种程序语言'}]
      }
    },
    methods: {
//      更改
      edit (m) {
        this.currentMajor = {...m}
        this.dialogFormVisible2 = true
      },
      editMajor(){
        api.put(`admin/major/${this.currentMajor.mid}`,this.currentMajor).then(res => {
          res = res.data
          if (res.code === 0) {
            this.$message.success('修改成功')
            this.dialogFormVisible2 = false
            this.loadMajor()
          } else {
            this.dialogFormVisible2 = false
            this.$message.error('操作异常')
          }
        })
      },
//      删除
      deleteMajor (id) {
        this.$confirm('确定删除？', '专业信息', {
          confirmButtonText: '确定',
        }).then(() => {
          api.delete(`admin/major/${id}`).then(res => {
            res = res.data
            if (res.code === 0) {
              this.$message.success('删除成功')
              this.loadMajor()
            } else {
              this.$message.error('操作异常')
            }
          })
        }).catch(() => {
          this.$message({
            type: 'info',
            message: '已取消删除'
          })
        })
      },

//      添加
      add_Major () {
        this.dialogFormVisible1 = true
      },

      add_Major1 () {
        api.post(`admin/major?aid=${this.$route.params.aid}`, this.addMajor).then(res => {
          res = res.data
          if (res.code === 0) {
            this.dialogFormVisible1 = false
            this.loadMajor()
          } else {
            this.$message.error('操作异常')
          }

        })
      },
//      查询
      loadMajor () {
        api.get(`admin/major?sid=${this.$route.params.sid}`).then(res => {
          res = res.data
          if (res.code === 0) {
            this.Majors = res.data
          } else {
            this.$message.error('数据加载失败')
          }

        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .major-page {
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
    margin-top: 30px;
  }
</style>
