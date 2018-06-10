<template>
  <div class="search-page">
    <!--搜索框-->
    <div class="search-input">
      <el-input placeholder="请输入所查询的学校名" v-model="searchKeyword">
        <el-button slot="append" icon="el-icon-search" @click="searchSchool"></el-button>
      </el-input>
    </div>
    <!--筛选条件-->
    <div class="search-condition">
      <!--总体筛选条件 class="search-li-first"一级li的class search-ul二级ul的class-->
      <ul class="search-ul-first">
        <li class="search-li-first">
          <ul class="search-ul">
            <li class="search-li-top">院校属地：</li>
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
        <li class="search-li-first">
          <ul class="search-ul">
            <li class="search-li-top">院校分类：</li>
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
        <li class="search-li-first">
          <ul class="search-ul">
            <li class="search-li-top">学历层次：</li>
            <li v-for="item in sarrang">
              <router-link :to="{query: queryAdd({sarrang: item.name})}">
                <el-button
                  :type="$route.query.sarrang == item.name || (!$route.query.sarrang && item.name == '不限')? 'primary' : 'text'"
                  size="mini">{{item.name}}
                </el-button>
              </router-link>

            </li>
            <hr>
          </ul>
        </li>
        <li class="search-li-first">
          <ul class="search-ul">
            <li class="search-li-top">院校特色：</li>
            <li v-for="item in schara">
              <router-link :to="{query: queryAdd({schara: item.name})}">
                <el-button
                  :type="$route.query.schara == item.name || (!$route.query.schara && item.name == '不限')? 'primary' : 'text'"
                  size="mini">{{item.name}}
                </el-button>
              </router-link>
            </li>
            <hr>
          </ul>
        </li>
      </ul>
    </div>
    <!--大学列表-->
    <div class="search-list">
      <!--顶部显示-->
      <div class="list-top">
        <span class="list-top-text">一共找到<span class="list-top-number" v-model="total">{{total}}</span>所学校</span>
      </div>
      <!--大学列表内容-->
      <div class="list-content">
        <ul>
          <!--每个大学的li-->
          <li v-for="item in school">
            <div class="list-content-school">
              <!--大学校徽-->
              <div :style="`background-image: url(${item.sphoto})`" class="picture">
                <!--<img src="./../../image/beijing.jpg" alt="">-->
              </div>
              <!--大学名称-->
              <div class="school-name">
                <router-link :to="'/home/school/'+item.sid" class="router-id">{{item.sname}}</router-link>
              </div>
              <!--大学信息-->
              <div class="text">
                <ul>
                  <li><span class="li-text">学历层次：<span>{{item.sarrang}}</span></span></li>
                  <li><span class="li-text">创建时间：<span>{{item.stime}}</span>年</span></li>
                  <li><span class="li-text">所属省份：<span>{{item.sregion}}</span></span></li>
                  <li><span class="li-text">院校类型：<span>{{item.stype}}</span></span></li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <!--分页-->
      <div class="list-page" v-if="pageShow">
        <el-pagination
          @current-change="handleCurrentChange"
          :current-page.sync="currentPage"
          :page-size="pageSize"
          layout="prev, pager, next, jumper"
          :total="total">
        </el-pagination>
      </div>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'
  import ElButton from '../../../node_modules/element-ui/packages/button/src/button.vue'

  export default {
    created () {
      this.filteredSchool()
    },
    components: {ElButton},
    data () {
      return {
        pageShow: true,
        pageSize: 5,
        currentPage: 1,
        total: 10,
        searchKeyword: '',
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
        sarrang: [
          {name: '不限'},
          {name: '本科'},
          {name: '专科'}
        ],
        schara: [
          {name: '不限'},
          {name: '211工程'},
          {name: '985高校'},
          {name: '自主招生'}
        ],
        school: [
          {
            sid: '001',
            name: '北京大学',
            subjection: '教育部',
            stime: '1989',
            province: '北京市',
            type: '综合类',
            logo: '/static/image/beijing.jpg'
          },
          {
            sid: '002',
            name: '清华大学',
            subjection: '教育部',
            stime: '1911',
            province: '北京市',
            type: '理工类',
            logo: '/static/image/qinghua.jpg'
          },
          {
            sid: '003',
            name: '仲恺农业工程学院',
            subjection: '教育部',
            stime: '1927',
            province: '广东省',
            type: '综合类',
            logo: '/static/image/zhongkai.png'
          },
          {
            sid: '004',
            name: '中山大学',
            subjection: '教育部',
            stime: '1924',
            province: '广东省',
            type: '综合类',
            logo: '/static/image/huanong.jpg'
          },
          {
            sid: '005',
            name: '华南农业大学',
            subjection: '教育部',
            stime: '1922',
            province: '广东省',
            type: '农业类',
            logo: '/static/image/huanan.jpg'
          },
        ]
      }
    },
    methods: {
      handleCurrentChange (val) {
        this.currentPage = val
        this.filteredSchool()
      },
      //    搜索学校
      searchSchool: function () {
        api.get(`/index/school?keyWord=${this.searchKeyword}`).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.school = res.data
            this.total = this.school.length
            this.pageShow = false
          } else {
            return this.$message.error('找不到该学校！')
          }
        })
      },
      schoolCount () {
        api.get('/index/school?count=1', {
          params: {
            ...this.$route.query
          }
        }).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.total = res.data
          } else {
            this.$message.error('找不到数据')
          }
        })
      },
      // 过滤筛选学校
      filteredSchool () {
        this.schoolCount()
        api.get('/index/school', {
          params: {
            page: this.currentPage,
            size: this.pageSize,
            ...this.$route.query
          }
        }).then((res) => {
          this.school = res.data.data
          this.pageShow = true
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

  .search-page {
    width: 960px;
    margin: 0 auto;
    /*搜索框样式*/
    .search-input {
      width: 600px;
      margin: 10px auto;
    }
    /*筛选条件框样式*/
    .search-condition {
      border: 1px solid rgba(0, 0, 0, 0.2);
      margin-bottom: 10px;
      .search-ul-first {

        list-style-type: none;
        margin: 20px;
        padding-left: 0;
        .search-li-first {
          .search-ul {
            padding: 0;
            margin: 0;
            li {
              display: inline-block;
              margin: 0 5px;
            }
            .search-li-top {
              font-weight: bold;
            }
          }

        }

      }
    }
    /*大学列表样式*/
    .search-list {
      /*列表首部显示*/
      .list-top {
        text-align: right;
        background-color: #e5e5e5;
        color: rgba(0, 0, 0, 0.7);

        .list-top-number {
          color: orangered;
        }
      }
      /*单个列表内样式*/
      .list-content {
        margin-top: 0;
        ul {
          padding: 0
        }
        li {
          list-style-type: none;
          padding-left: 0;
        }

        .list-content-school {
          display: flex;
          flex-direction: row;
          height: 120px;
          margin: 10px 0;
          padding: 5px 0;
          border-bottom: 1px solid #e5e5e5;
          a {
            text-decoration: none;
            color: rgba(0, 0, 0, 0.8);
            font-family: "新宋体"
          }
          a:hover {
            color: rgba(4, 162, 255, 0.7)
          }
          .picture {
            width: 120px;
            height: 120px;
            background-position: center;
            background-size: 120px;
          }
          .picture:hover {
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
      }
      .list-page {
        text-align: center;
      }
    }
    hr {
      width: 100%;
      border: 1px dashed #E5E5E5;

    }
  }


</style>
