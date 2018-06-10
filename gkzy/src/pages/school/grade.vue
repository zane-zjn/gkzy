<template>
  <div class="grade-page">
    <div class="grade-select">
      <el-select v-model="fyear" placeholder="请选择年份">
        <el-option
          v-for="item in years"
          :key="item.fyear"
          :label="item.label"
          :value="item.fyear">
        </el-option>
      </el-select>
      <el-select v-model="fsubject" placeholder="请选择文理科">
        <el-option
          v-for="item in fsubjects"
          :key="item.fsubject"
          :label="item.label"
          :value="item.fsubject">
        </el-option>
      </el-select>
      <el-button type="primary" @click="loadGrade">查找</el-button>
    </div>
    <div class="grade-message">
      <el-table
        :data="schoolGrage"
        style="width: 100%">
        <el-table-column
          prop="fprovince"
          label="省份"
          width="180">
        </el-table-column>
        <el-table-column
          prop="fyear"
          label="年份">
        </el-table-column>
        <el-table-column
          prop="fmin"
          label="最低分"
          width="180">
        </el-table-column>
        <el-table-column
          prop="faverage"
          label="平均分">
        </el-table-column>
        <el-table-column
          prop="fsubject"
          label="理科">
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadGrade()
    },
    data () {
      return {
        fyear: '2016',
        years: [
          {
            fyear: '2016',
            label: '2016'
          }, {
            fyear: '2015',
            label: '2015'
          }, {
            fyear: '2014',
            label: '2014'
          }, {
            fyear: '2013',
            label: '2013'
          }, {
            fyear: '2012',
            label: '2012'
          }, {
            fyear: '2011',
            label: '2011'
          }],
        fsubject: '理科',
        fsubjects: [{
          fsubject: '文科',
          label: '文科'
        }, {
          fsubject: '理科',
          label: '理科'
        }],
        schoolGrage: []

      }
    },
    methods: {
      loadGrade () {
        api.get('index/fraction', {
          params: {
            sid: this.$route.params.sid,
            fyear: this.fyear,
            fsubject: this.fsubject
          }
        }).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.schoolGrage = res.data
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .grade-page {
    /*padding-top: 30px;*/
    .grade-select {
      margin: 10px 0;
    }
  }
</style>
