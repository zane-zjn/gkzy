<template>
  <div class="taap-page">
    <div class="taap-select">
      <el-select v-model="rprovince" placeholder="请选择省份">
        <el-option
          v-for="item in sprovince"
          :key="item.name"
          :label="item.name"
          :value="item.name">
        </el-option>
      </el-select>
      <el-button type="primary" @click="selectRecruit">查找</el-button>
    </div>
    <div class="taap-table">
      <el-table
        :data="Recruits"
        style="width: 100%">
        <el-table-column
          prop="rmajor"
          label="专业名称"
          width="180">
        </el-table-column>
        <el-table-column
          prop="rsubjest"
          label="文理科"
          width="180">

        </el-table-column>
        <el-table-column
          prop="rnumber"
          label="招生人数"
          width="180">
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'
  export default {
    data () {
      return {
        rprovince:'广东',
        sprovince: [
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
        Recruits: []
      }
    },
    methods:{
      selectRecruit(){
        api.get('index/recruit', {
          params: {
            sid: this.$route.params.sid,
            rprovince: this.rprovince
          }
        }).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.Recruits = res.data
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .taap-page {

    .taap-table{


    }
  }
</style>
