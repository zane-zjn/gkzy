<template>
  <div class="profession-page">
    <el-table
      :data="major"
      style="width: 100%">
      <el-table-column
        prop="mname"
        label="专业名称"
        width="180">
      </el-table-column>
      <el-table-column
        prop="mtype"
        label="专业类别"
        width="180">

      </el-table-column>
      <el-table-column
        prop="mintroduce"
        label="专业描述">
      </el-table-column>
    </el-table>
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
        major: [
          {
            mname: '政治学与行政学',
            mtype: '法学类',
            mintroduce: '本专业培养具有一定马克思主义理论素养和政治学、行政学方面的基本理论和专门知识，能在党政机关、新闻出版机构、企事业和社会团体等位从事教学科研、行政管理等方面工作的政治学和行政学高级专门人才。'
          },
        ]
      }

    },
    methods: {
      loadMajor () {
        api.get('index/major', {params: {sid: this.$route.params.sid}}).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.major = res.data
          } else {
            this.message.error('加载数据失败')
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .profession-page {

  }
</style>
