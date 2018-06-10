<template>
  <div class="admin-school-page">
    <div class="select">
      <el-input placeholder="请输入内容" v-model="schoolName">
        <el-button slot="append" icon="el-icon-search" @click="selectSchool"></el-button>
      </el-input>
    </div>

    <!--搜索结果显示-->
    <div class="selectResult" v-if="selectResult.length">
      <el-table :data="selectResult"
                border
                width="100%">
        <el-table-column
          prop="sname">
        </el-table-column>
        <el-table-column>
          <template slot-scope="scope">
            <router-link :to="'schoolDescribe/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column>
          <template slot-scope="scope">
            <router-link :to="'schoolFraction/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column>
          <template slot-scope="scope">
            <router-link :to="'schoolMajor/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column>
          <template slot-scope="scope">
            <router-link :to="'schoolRecruit/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column
          label="操作"
          width="90">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="deleteSchool(scope.row.sid)" class="text-danger">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <hr>
    <!--学校总体展示-->
    <div class="school-list">
     <div>
       <el-button type="warning" icon="el-icon-plus" @click="addSchool">添加</el-button>

     </div>
      <el-table :data="schools"
                width="100%">
        <el-table-column
          prop="sname"
          label="院校名称">
        </el-table-column>
        <el-table-column
          label="院校简介">
          <template slot-scope="scope">
            <router-link :to="'schoolDescribe/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column
          label="录取分数线">
          <template slot-scope="scope">
            <router-link :to="'schoolFraction/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column
          label="开设专业">
          <template slot-scope="scope">
            <router-link :to="'schoolMajor/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column
          label="招生计划">
          <template slot-scope="scope">
            <router-link :to="'schoolRecruit/'+scope.row.sid">
              <el-button>点击编辑</el-button>
            </router-link>
          </template>
        </el-table-column>
        <el-table-column
          label="操作"
          width="90">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="deleteSchool(scope.row.sid)" class="text-danger">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <!--@size-change="handleSizeChange"-->
    <div class="list-page">
      <el-pagination
        @current-change="handleCurrentChange"
        :current-page.sync="currentPage"
        :page-size="pageSize"
        layout="prev, pager, next, jumper"
        :total="total">
      </el-pagination>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadSchoolCount()
      this.loadSchools()
    },
    data () {
      return {

        selectResult: [],
        currentPage: 1,
        total: 50,
        pageSize: 5,
        schools: [
          {sid: 1, sname: '仲恺农业工程学院'},
          {sid: 2, sname: '北京大学'},
          {sid: 3, sname: '清华大学'},
          {sid: 4, sname: '中山大学'},
          {sid: 5, sname: '华南农业大学'},
          {sid: 6, sname: '机电技术学院'},
        ],
        schoolName: '',
      }
    },
    methods: {
      loadSchools () {
        api.get(`admin/school?page=${this.currentPage}&size=${this.pageSize}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.schools = res.data
          } else {
            this.$message.error('加载数据错误')
          }
        })
      },
      loadSchoolCount () {
        api.get('admin/school?count=1').then((res) => {
          res = res.data
          if (res.code === 0) {
            this.total = res.data
          } else {
            this.$message.error('加载数据错误')
          }
        })
      },
      handleCurrentChange (val) {
        this.currentPage = val
        this.loadSchools()
      },
      // 查询学校
      selectSchool () {
        api.get(`admin/school?query=${this.schoolName}`)
          .then((res) => {
            res = res.data
            this.selectResult = res.data
          })
      },
      // 添加学校
      addSchool () {
        this.$prompt('请输入院校名称', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          inputPattern: /^[\u2E80-\u9FFF]+$/,
          inputErrorMessage: '只能输入中文'
        }).then(({value}) => {
          api.post(`admin/school`, {value: value}).then((res) => {
            res = res.data
            if (res.code === 0) {
              this.$message.success('添加成功')
            } else {
              this.$message.error('添加失败')
            }
          })
//          console.log(value)

        }).catch(() => {
          this.$message({
            type: 'info',
            message: '取消输入'
          })
        })
      },
//      删除学校
      deleteSchool (id) {
        this.$alert('确定删除该学校？', '删除院校', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.delete(`admin/school/${id}`).then((res) => {
                res = res.data
                if (res.code === 0) {
                  this.schools = this.schools.filter(s => s.sid !== id);
                  this.selectResult = this.selectResult.filter(s => s.sid !== id);
                  this.$message.success('删除成功');
                  this.loadSchools();
                  this.loadSchoolCount();
                }
              })
            }
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .admin-school-page {

    .select {
      width: 600px;
      margin: 20px auto;

    }
    .school-list {

      /*a{*/
      /*text-decoration: none;*/

      /*}*/
    }
    .list-page {
      margin: 0 auto;
      text-align: center;
    }

  }

</style>
