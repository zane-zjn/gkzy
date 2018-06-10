import Vue from 'vue'
import Router from 'vue-router'
import Home from './../pages/home/Home.vue'
import login from './../pages/login/login.vue'
import reg from './../pages/login/reg.vue'
import admin from './../pages/admin/admin.vue'
import major from '../pages/home/major.vue'
import recom from '../pages/home/recom.vue'
import search from '../pages/home/search.vue'
import about from '../pages/home/about.vue'
import school from '../pages/home/school.vue'
import personal from '../pages/user/personal.vue'
import describe from '../pages/school/describe.vue'
import grade from '../pages/school/grade.vue'
import profession from '../pages/school/profession.vue'
import taap from '../pages/school/taap.vue'
import user from '../pages/admin/user.vue'
import adminSchool from '../pages/admin/adminSchool.vue'
import adminIndex from '../pages/admin/adminIndex.vue'
import schoolDescribe from '../pages/admin/schoolDescribe.vue'
import schoolFraction from '../pages/admin/schoolFraction.vue'
import schoolMajor from '../pages/admin/schoolMajor.vue'
import schoolRecruit from '../pages/admin/schoolRecruit.vue'
import adminlogin from '../pages/admin/adminlogin.vue'
import textcontent from '../pages/home/textcontent.vue'
import comment from '../pages/school/comment.vue'

Vue.use(Router)

export default new Router({
  // mode: 'history',
  routes: [
    {
      path: '/',
      redirect: '/login'
    },
    // 登录页面路由
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/adminlogin',
      name: 'adminlogin',
      component: adminlogin
    },

    {
      path: '/login',
      name: 'login',
      component: login
    },
    // 注册
    {
      path: '/reg',
      name: 'reg',
      component: reg
    },
    // 主页面路由
    {
      path: '/home',
      component: Home,
      children: [
        {// 首页
          path: '',
          redirect: 'major'
        },
        {// 首页
          path: 'major',
          name: 'major',
          component: major
        },
        {// 推荐页面
          path: 'recom',
          name: 'recom',
          component: recom
        },
        {// 查找页面
          path: 'search',
          name: 'search',
          component: search
        },
        {// 关于我们页面
          path: 'about',
          name: 'about',
          component: about
        },
        {// 文章具体界面
          path: 'textcontent/:aid',
          name: 'textcontent',
          component: textcontent
        },
        // 学校具体页面路由
        {
          path: 'school/:sid',
          component: school,
          children: [
            {
              path: '/',
              redirect: 'describe'
            },
            {// 学校简介
              path: 'describe',
              name: 'describe',
              component: describe
            },
            {// 录取分数线
              path: 'grade',
              name: 'grade',
              component: grade
            },
            {// 专业分数线
              path: 'profession',
              name: 'profession',
              component: profession
            },
            {// 招生计划
              path: 'taap',
              name: 'taap',
              component: taap
            },
            {// 学校评论
              path: 'comment',
              name: 'comment',
              component: comment
            }
          ]
        }

      ]
    },
    // 管理员
    {
      path: '/admin',
      component: admin,
      children: [{
        path: '',
        redirect: 'user'
      }, {
        path: 'user',
        name: 'user',
        component: user
      }, {
        path: 'adminSchool',
        name: 'adminSchool',
        component: adminSchool
      }, {
        path: 'adminIndex',
        name: 'adminIndex',
        component: adminIndex
      }, {
        path: 'schoolDescribe/:sid',
        name: 'schoolDescribe',
        component: schoolDescribe
      }, {
        path: 'schoolFraction/:sid',
        name: 'schoolFraction',
        component: schoolFraction
      }, {
        path: 'schoolMajor/:sid',
        name: 'schoolMajor',
        component: schoolMajor
      }, {
        path: 'schoolRecruit/:sid',
        name: 'schoolRecruit',
        component: schoolRecruit
      }
      ]
    },
    // 用户
    {
      path: '/personal',
      name: 'personal',
      component: personal
    }
  ]
})
