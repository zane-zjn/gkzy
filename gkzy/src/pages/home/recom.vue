<template>
  <div class="recom-page">
    <!--筛选条件div-->
    <div class="recom-condition">
      <div class="recom-school-list">
        <ul class="recom-ul-first">
          <li class="recom-li-first">
            <ul class="recom-ul">
              <li class="recom-li-top">院校属地：</li>
              <li v-for="item in sregion">
                <router-link :to="{query: queryAdd({sregion: item.name})}">
                  <el-button
                    :type="$route.query.sregion == item.name || (!$route.query.sregion && item.name == '不限')? 'primary' : 'text'"
                    size="mini">
                    {{item.name}}
                  </el-button>
                </router-link>
              </li>
              <hr>
            </ul>
          </li>
          <li class="recom-li-first">
            <ul class="recom-ul">
              <li class="recom-li-top">院校分类：</li>
              <li v-for="item in stype">
                <router-link :to="{query: queryAdd({stype: item.name})}">
                  <el-button
                    :type="$route.query.stype == item.name || (!$route.query.stype && item.name == '不限')? 'primary' : 'text'"
                    size="mini">{{item.name}}
                  </el-button>
                </router-link>
              </li>
              <hr>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!--文字div-->
    <div class="recom-notice">
      <el-alert type="warning" title="本网站推荐院校仅供参考，具体选择请再自行查阅信息后慎重决定！" :closable="false"></el-alert>
    </div>
    <!--推荐院校列表-->
    <div class="recom-school">
      <div class="school-list">
        <ul>
          <li v-for="item in school">
            <div class="list-content-school">
              <div :style="`background-image: url(${item.sphoto})`" class="picture">
                <!--<img src="./../../image/beijing.jpg" alt="">-->
              </div>
              <div class="school-name">
                <router-link :to="'/home/school/'+item.sid" class="router-id">{{item.sname}}</router-link>
              </div>
              <div class="text">
                <ul>
                  <li><span class="li-text">管理部门：<span>{{item.sarrang}}</span></span></li>
                  <li><span class="li-text">创建时间：<span>{{item.stime}}</span>年</span></li>
                  <li><span class="li-text">所属省份：<span>{{item.sregion}}</span></span></li>
                  <li><span class="li-text">院校类型：<span>{{item.stype}}</span></span></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

</template>
<script type="es6">
  import ElButton from '../../../node_modules/element-ui/packages/button/src/button.vue'
  import api from '../../api'

  export default {
    components: {
      ElButton
    },
    created () {
      this.filteredSchool()
    },
    data () {
      return {
        sregion: [
          {name: '不限'},
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
        stype: [
          {name: '不限'},
          {name: '综合类'},
          {name: '理工类'},
          {name: '财经类'},
          {name: '农林类'},
          {name: '林业类'},
          {name: '医药类'},
          {name: '师范类'},
          {name: '体育类'},
          {name: '语言类'},
          {name: '政法类'},
          {name: '艺术类'},
          {name: '民族类'},
          {name: '军事类'},
          {name: '商学院'},
        ],
        school: [
//          {
//            sid: '003',
//            name: '仲恺农业工程学院',
//            subjection: '教育部',
//            stime: '1927',
//            province: '广东省',
//            type: '综合类',
//            logo: '/static/image/zhongkai.png'
//          }
        ]
      }
    },
    methods: {
      // 过滤筛选学校
      filteredSchool () {
        api.get('/index/school/1', {
          params: this.$route.query
        }).then((res) => {
          this.school = res.data.data
        })
      },
      queryAdd (o) {
        return {
          ...this.$route.query,
          ...o,
        }
      }
    },
    computed: {
      query () {
        return this.$route.query
      }
    },
    watch: {
      query (val) {
        this.filteredSchool()
      }
    }
  }
</script>
<style lang="less" scoped>
  .recom-page {
    width: 960px;
    margin: 0 auto;
    /*筛选条件样式*/
    .recom-condition {
      margin-top: 10px;
      border: 1px solid rgba(0, 0, 0, 0.2);
      margin-bottom: 10px;
      .recom-ul-first {

        list-style-type: none;
        margin: 20px;
        padding-left: 0;
        .recom-li-first {
          .recom-ul {
            padding: 0;
            margin: 0;
            li {
              display: inline-block;
              margin: 0 5px;
            }
            .recom-li-top {
              font-weight: bold;
            }
          }

        }

      }
      hr {
        width: 100%;
        border: 1px dashed #E5E5E5;

      }
    }
    /*提示文字样式*/
    .recom-notice {
      text-align: center;
      font-size: 10px;
    }
    /*学校列表样式*/
    .recom-school {
      margin-top: 0;
      ul {
        padding: 0
      }
      li {
        list-style-type: none;
        padding-left: 0;
      }
      a {
        text-decoration: none;
        color: rgba(0, 0, 0, 0.8);
        font-family: "新宋体"
      }
      a:hover {
      }
      .list-content-school {
        display: flex;
        flex-direction: row;
        height: 120px;
        margin: 10px 0;
        padding: 5px 0;
        border-bottom: 1px solid #e5e5e5;
        .picture {
          width: 120px;
          height: 120px;
          background-position: center;
          background-size: 120px;
        }
        .school-name {
          text-align: center;
          width: 400px;
          font-size: 30px;
          line-height: 120px;
          .router-id {

          }
        }
        .text {
          width: 400px;
          padding-left: 50px;
          li {
            list-style-type: none;
            height: 30px;
            line-height: 30px;
          }
          .li-text {
            color: gray;

          }
        }
      }
      .list-page {
        text-align: center;
      }
    }
  }
</style>
