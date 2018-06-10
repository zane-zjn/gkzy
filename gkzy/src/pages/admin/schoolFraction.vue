<template>
  <div class="fraction-page">
    <div class="tiaozhuan">
      <router-link :to="`/admin/schoolDescribe/${$route.params.sid}`"><i class="el-icon-arrow-left"></i>上一项</router-link>
      <router-link :to="`/admin/schoolMajor/${$route.params.sid}`">下一项 <i class="el-icon-arrow-right"></i></router-link>
    </div>
    <div class="year">
      <el-date-picker
        v-model="yearObj"
        type="year"
        placeholder="选择年">
      </el-date-picker>
      <el-button type="primary" @click="selectFraction">查找</el-button>
    </div>
    <div class="add">
      <el-button type="primary" icon="el-icon-plus" @click="addFraction">添加</el-button>
      <!--添加弹出框-->
      <el-dialog title="添加分数线" :visible.sync="dialogFormVisible1">
        <el-form label-width="80px">
          <el-form-item label="省份">
            <el-input v-model="fraction.fprovince"></el-input>
          </el-form-item>
          <el-form-item label="年份">
            <el-input v-model="fraction.fyear"></el-input>
          </el-form-item>
          <el-form-item label="文理科">
            <el-input v-model="fraction.fsubject"></el-input>
          </el-form-item>
          <el-form-item label="平均分">
            <el-input v-model="fraction.faverage"></el-input>
          </el-form-item>
          <el-form-item label="最低分">
            <el-input v-model="fraction.fmin"></el-input>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible1 = false">取 消</el-button>
          <el-button type="primary" @click="addFraction1">确 定</el-button>
        </div>
      </el-dialog>
    </div>
    <div class="table">
      <el-table
        :data="fractions"
        border
        style="width: 100%">
        <el-table-column
          prop="fprovince"
          label="省份">
        </el-table-column>
        <el-table-column
          prop="fyear"
          label="年份">
        </el-table-column>
        <el-table-column
          prop="fsubject"
          label="文理科">
        </el-table-column>
        <el-table-column
          prop="fmin"
          label="最低分">
        </el-table-column>
        <el-table-column
          prop="faverage"
          label="平均分">
        </el-table-column>
        <el-table-column
          label="操作">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="editFraction(scope.row)">编辑</el-button>
            <el-button type="text" size="small" @click="deleteFraction(scope.row.fid)" class="text-danger">删除
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <!--编辑弹出框-->
    <el-dialog title="录取分数线" :visible.sync="dialogFormVisible">
      <el-form label-width="80px">
        <el-form-item label="平均分">
          <el-input v-model="currentFraction.faverage"></el-input>
        </el-form-item>
        <el-form-item label="最低分">
          <el-input v-model="currentFraction.fmin"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="editFraction1">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadFraction()
    },
    data () {
      return {
        dialogFormVisible1: false,
        fraction: {},
        yearObj: null,
        fractions: [{fid: '1', fyear: '2016', faverage: '550', fmin: '500', fsubject: '理科', fprovince: '广东省'},
          {fid: '2', fyear: '2016', faverage: '550', fmin: '500', fsubject: '理科', fprovince: '胡降生'}],

        dialogFormVisible: false,
        currentFraction: {
          faverage: '',
          fmin: ''
        },
      }
    },
    methods: {
      loadFraction () {
        api.get(`admin/fraction?sid=${this.$route.params.sid}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.fractions = res.data
          } else {
            this.$message.error('加载数据失败')
          }
        })
      },
//      增
      addFraction () {
        this.dialogFormVisible1 = true
      },
      addFraction1 () {
        api.post(`admin/fraction?sid=${this.$route.params.sid}`, this.fraction).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.dialogFormVisible1 = false
            this.selectFraction()
            this.$message.success('添加成功')
            this.fraction = {}
          } else {
            this.$message.error('添加失败')
            this.dialogFormVisible1 = false
          }

        })
      },
//      删
      deleteFraction (id) {
        this.$alert('确定删除这条数据？', '删除分数线', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.delete(`admin/fraction/${id}`).then((res) => {
                res = res.data
                if (res.code === 0) {
                  this.$message.success('删除成功')
                  this.selectFraction()
                } else {
                  this.$message.error('删除失败')
                }
              })
            }
          }
        })
      },
//      改
      editFraction (f) {
        this.currentFraction = {...f}
        this.dialogFormVisible = true
      },
      editFraction1 () {
        api.put(`admin/fraction/${this.currentFraction.fid}`, this.currentFraction).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.$message.success('编辑成功')
            this.dialogFormVisible = false
            this.selectFraction()

          } else {
            this.$message.error('编辑失败')
            this.dialogFormVisible = false
          }
        })
      },

//      查
      selectFraction () {
        api.get(`admin/fraction?sid=${this.$route.params.sid}&fyear=${this.year}`).then(res => {
          res = res.data
          if (res.code === 0) {
            this.fractions = res.data
            this.$message.success('查询成功')
          } else {
            this.$message.error('操作异常')
          }
        })
      }
    },
    computed: {
      year () {
        if (!this.yearObj) {
          return ''
        }
        return (new Date(this.yearObj)).getFullYear()
      }
    }
  }
</script>
<style lang="less" scoped>
  .fraction-page {
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
    .year {
      width: 800px;
      margin: 30px auto;
      text-align: center;

    }
  }


</style>
