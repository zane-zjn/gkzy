<template>
  <div class="admin-page">
    <div class="admin-header">
      <span>ADMIN</span>
    </div>
    <div class="admin-middle">
      <div class="admin-aside">
        <ul>
          <li>
            <router-link to="/admin/user">用户管理</router-link>
          </li>
          <li>
            <router-link to="/admin/adminSchool">院校管理</router-link>
          </li>
          <li>
            <router-link to="/admin/adminIndex">首页管理</router-link>
          </li>
        </ul>


      </div>
      <div class="admin-main">
       <router-view></router-view>
      </div>
    </div>

  </div>
</template>
<script type="es6">
  export default {}
</script>
<style lang="less" scoped>
  .admin-page {
    height: 100vh;
    margin: 0;
    padding: 0;
    display: flex;
    flex-flow: column;
    .admin-header {

      font-size: 20px;
      line-height: 50px;
      height: 50px;
      text-align: left;
      color: aqua;
      background-color: rgb(0, 0, 0);
      padding-left: 30px;
    }
    .admin-middle {
      position: relative;
      flex: 1;
      .admin-aside {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 150px;
        background: #303133;
        text-align: center;
        ul {
          margin: 0;
          padding: 0;
        }
        li{
          text-decoration: none;
          margin:0;
          padding: 10px 0;
          border: 1px solid gainsboro;
        }
        a {
          text-decoration: none;
          color: aliceblue;
          font-size: 20px;
        }
      }
      .admin-main {
        position: absolute;
        top: 0;
        left: 150px;
        right: 0;
        bottom: 0;
        overflow: auto;
      }
    }

  }
</style>
