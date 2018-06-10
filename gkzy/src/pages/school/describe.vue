<template>
  <div class="describe-page">
    <div v-html="school.sintroduction.replace('\n', '<br>')" class="text">
    </div>
    <div class="describe-message">
      <ul>
        <li>学费信息 <br>{{school.scost}}元/年</li>
        <li>在校人数<br>{{school.smember}}人</li>
        <li>男女比例<br>{{school.spropor}}</li>
      </ul>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadschool()
    },
    data () {
      return {
        school: {sintroduction: ''},
      }
    },
    methods: {
      loadschool () {
        api.put(`index/school/${this.$route.params.sid}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.school = res.data
          } else {
            this.$message('加载数据失败')
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .describe-page {

    .text {
      margin: 0 20px;
    }
    .describe-message {

      ul {
        display: flex;
        flex-flow: row;
        margin: 20px 0;
        padding: 0;
      }
      li {
        list-style: none;
        flex: 1;
        text-align: center;
        border: 1px solid gray;
      }

    }
  }
</style>
