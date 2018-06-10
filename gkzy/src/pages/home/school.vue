<template>
  <!--<div style="display: none">{{$route.params.sid}}</div>-->
  <div class="school-page">
    <div class="school-top">
      <div class="school-picture">

      </div>
      <div class="school-message">
        <ul>
          <li class="school-name">
            <span>{{school.sname}}</span>
            <el-button
              @click="collected"
              :type="isStared ? 'danger' : 'default'"
              icon="el-icon-star-on">收藏
            </el-button>
          </li>
          <li><span class="school-text">学历层次：</span><span style="color: gray">{{school.sarrang}} </span></li>
          <li><span class="school-text">学校类型：</span><span style="color: gray">{{school.stype}}</span></li>
          <li><span class="school-text">创建时间：</span><span style="color: gray">{{school.stime}}年</span></li>
          <li><span class="school-text">学校地址：</span><span style="color: gray">{{school.saddress}}</span></li>
          <li><span class="school-text">官方网址：</span><span style="color: gray">{{school.slink}}</span></li>
        </ul>
      </div>
    </div>
    <div class="school-select">
      <div class="select-menu">
        <ul>
          <li>
            <router-link :to="`/home/school/${$route.params.sid}/describe`">学校简介</router-link>
          </li>
          <li>
            <router-link :to="`/home/school/${$route.params.sid}/grade`">录取分数线</router-link>
          </li>
          <li>
            <router-link :to="`/home/school/${$route.params.sid}/profession`">开设专业</router-link>
          </li>
          <li>
            <router-link :to="`/home/school/${$route.params.sid}/taap`">招生计划</router-link>
          </li>
          <li>
            <router-link :to="`/home/school/${$route.params.sid}/comment`">学校评论</router-link>
          </li>
        </ul>
        <hr style="margin: 0">
      </div>
      <div>
        <router-view></router-view>
      </div>
    </div>

  </div>

</template>
<script type="es6">

  import api from '../../api'
  import ElButton from '../../../node_modules/element-ui/packages/button/src/button.vue'

  export default {
    created () {
      this.loadschool()
      this.loadCollection()
    },
    components: {ElButton},
    data () {
      return {
        collectionMessage: {},
        isStared: false,
        school: {
          sid: '001',
          name: '北京大学',
          stime: '1989',
          province: '北京市',
          type: '综合类',
          picture: '/static/image/北京大学.jpg',
          address: '北京市海淀区颐和园路5号',
          chara: '985高校',
          arrang: '本科',
          cost: '5000',
          link: 'www.pku.edu.cn/',
          memeber: '20000',
          propor: '1:1'
        },
        collection: 'el-icon-star-off'
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
      },
      loadCollection () {
        api.get(`index/collection/${this.$route.params.sid}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            if (res.data) {
              this.isStared = true
              this.collectionMessage = res.data
            } else {
              this.isStared = false
            }

          } else {
            this.isStared = false
          }
        })
      },
      collected () {
        if (!this.isStared)
          this.addCollection()
        else
          this.deleteCollection()
      },
      deleteCollection () {
        api.delete(`index/collection/${this.collectionMessage.cid}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.isStared = false
          } else {
            this.isStared = true
            this.$message('操作失败')
          }
        })
      },
      addCollection () {
        api.post(`index/collection`, {sid: this.$route.params.sid}).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.isStared = true
            this.collectionMessage = res.data
          } else {
            this.isStared = true
            this.$message('操作失败')
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .school-page {
    width: 960px;
    margin: 0 auto;
    .school-top {
      display: flex;
      flex-flow: row;
      border-top: 1px solid rgba(0, 0, 0, 0.2);
      height: 250px;
      margin: 10px 0;
      padding: 20px 0;
      .school-picture {
        flex-shrink: 0;
        width: 320px;
        height: 250px;
        background: url("/static/image/北京大学-1.jpg") center;
        background-size: 320px 250px;
      }
      .school-message {
        width: 400px;
        padding-top: 30px;
        padding-left: 50px;
        ul {
          margin: 0;
          padding: 0;
        }
        li {
          list-style: none;
          margin: 5px 0;
        }
        .school-name {
          display: inline-block;
          height: 60px;
          font-size: 30px;
          line-height: 60px;
          button {
            vertical-align: middle;
          }
          span {
            margin-right: 50px;
          }
        }
        .school-text {
          color: rgba(0, 0, 0, 0.85);
          font-weight: bold;
        }

      }
    }
    .school-select {
      .select-menu {

        ul {
          margin: 0;
          padding: 0;

        }
        li {
          margin: 0;
          padding: 0 2px;
          display: inline-block;
          list-style-type: none;
          height: 30px;
          font-size: 20px;
          line-height: 30px;

          background-color: rgba(117, 204, 255, 0.36);
        }
        a {
          text-decoration: none;
          color: rgba(0, 0, 0, 0.8);
        }
      }
    }
  }

</style>
