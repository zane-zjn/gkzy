<template>
  <div class="recruit-page">
    <div class="tiaozhuan">
      <router-link :to="`/admin/schoolMajor/${$route.params.sid}`"><i class="el-icon-arrow-left"></i>上一项</router-link>
      <router-link :to="`/admin/schoolDescribe/${$route.params.sid}`">下一项 <i class="el-icon-arrow-right"></i></router-link>
    </div>
    <div class="select">
      <el-select v-model="rprovince" placeholder="请选择">
        <el-option
          v-for="item in provinces"
          :key="item.name"
          :label="item.name"
          :value="item.name">
        </el-option>
      </el-select>
      <el-button type="primary" @click="selectRecruit">查找</el-button>
      <el-button type="primary" @click="add_recruit">添加</el-button>
    </div>
    <div class="table">
      <el-table
        :data="recruits"
        border
        style="width: 100%">
        <el-table-column
          min-width="50%"
          prop="rmajor"
          label="专业名称">
        </el-table-column>
        <el-table-column
          min-width="30%"
          prop="rsubjest"
          label="文理科">
        </el-table-column>
        <el-table-column
          min-width="20%"
          prop="rnumber"
          label="招生人数">
        </el-table-column>
        <el-table-column
          fixed="right"
          label="操作"
          width="100">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="edit(scope.row)">编辑</el-button>
            <el-button type="text" size="small" @click="deleteRectuit(scope.row.rid)" class="text-danger">删除
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>


    <!--编辑功能弹出框-->
    <el-dialog title="录取分数线" :visible.sync="dialogFormVisible2">
      <el-form label-width="80px">
        <el-form-item label="文理科">
          <el-input v-model="currentRecruit.rsubjest"></el-input>
        </el-form-item>
        <el-form-item label="招生人数">
          <el-input v-model="currentRecruit.rnumber"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible2 = false">取 消</el-button>
        <el-button type="primary" @click="editRecruit">确 定</el-button>
      </div>
    </el-dialog>

    <!--添加弹出框-->
    <el-dialog title="录取分数线" :visible.sync="dialogFormVisible1">
      <el-form label-width="80px">
        <el-form-item label="专业名称">
          <el-input v-model="addRecruit.rmajor"></el-input>
        </el-form-item>
        <el-form-item label="省份">
          <el-input v-model="addRecruit.rprovince"></el-input>
        </el-form-item>
        <el-form-item label="文理科">
          <el-input v-model="addRecruit.rsubjest"></el-input>
        </el-form-item>
        <el-form-item label="招生人数">
          <el-input v-model="addRecruit.rnumber"></el-input>
        </el-form-item>

      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible1 = false">取 消</el-button>
        <el-button type="primary" @click="add_recruit1">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadRecruit()
    },
    data () {
      return {
        dialogFormVisible1: false,
        dialogFormVisible2: false,
        currentRecruit: {rnumber: '', rsubjest: ''},
        addRecruit: {rnumber: '', rmajor: '', rsubjest: '', rprovince: ''},
        rprovince: '',
        provinces: [
          {name: '北京'},
          {name: '上海'},
          {name: '重庆'},
          {name: '天津'},
          {name: '辽宁'},
          {name: '吉林'},
          {name: '黑龙江'},
          {name: '河北'},
          {name: '河南'},
          {name: '山东'},
          {name: '江苏'},
          {name: '山西'},
          {name: '陕西'},
          {name: '甘肃'},
          {name: '四川'},
          {name: '青海'},
          {name: '湖南'},
          {name: '湖北'},
          {name: '江西'},
          {name: '安徽'},
          {name: '浙江'},
          {name: '福建'},
          {name: '广东'},
          {name: '广西'},
          {name: '贵州'},
          {name: '云南'},
          {name: '海南'},
          {name: '台湾'},
          {name: '内蒙古'},
          {name: '新疆'},
          {name: '宁夏'},
          {name: '西藏'},
        ],
        recruits: [{rid: '1', rnumber: '3', rmajor: '信息与计算科学', rprovince: '广东', rsubjest: '理科'}]
      }
    },
    methods: {

//      更改
      edit (r) {
        this.currentRecruit = {...r}
        this.dialogFormVisible2 = true
      },
      editRecruit () {
        api.put(`admin/recruit/${this.currentRecruit.rid}`, this.currentRecruit).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.$message.success('编辑成功')
            this.dialogFormVisible2 = false
            this.selectFraction()

          } else {
            this.$message.error('编辑失败')
            this.dialogFormVisible2 = false
          }
        })
      },
//      添加
      add_recruit () {
        this.dialogFormVisible1 = true
      },
      add_recruit1 () {
        api.post('admin/recruit', {sid: this.$route.params.sid, ...this.addRecruit}).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.dialogFormVisible1 = false
            this.loadRecruit()
            this.$message.success('添加成功')
            this.addRecruit = {}
          } else {
            this.$message.error('添加失败')
            this.dialogFormVisible1 = false
          }

        })
      },
//      删除
      deleteRectuit (id) {
        this.$alert('确定删除这条数据？', '删除分数线', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.delete(`admin/recruit/${id}`).then((res) => {
                res = res.data
                if (res.code === 0) {
                  this.$message.success('删除成功')
                  this.loadRecruit()
                } else {
                  this.$message.error('删除失败')
                }
              })
            }
          }
        })
      },
//      查找
      selectRecruit () {
        api.get(`admin/recruit?sid=${this.$route.params.sid}&rprovince=${this.rprovince}`).then(res => {
          res = res.data
          if (res.code === 0) {
            this.recruits = res.data
            this.$message.success('查询成功')
          } else {
            this.$message.error('操作异常')
          }
        })
      },

      loadRecruit () {
        api.get(`admin/recruit?sid=${this.$route.params.sid}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.recruits = res.data
          } else {
            this.$message.error('加载数据失败')
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .recruit-page {
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

    .select {
      width: 600px;
      text-align: center;
      margin: 30px auto;
    }
  }
</style>
