<template>
  <div class="footer_all"><!--底部组件总体div-->
    <div class="footer_top">
      <ul>
        <li>关于我们</li>
        <li>联系我们</li>
        <li>客户服务</li>
      </ul>
    </div><!--底部组件上部div-->
    <div class="footer_middle">Copyright © 2017 Gaokaopai.com 高考志愿推荐 版权所有</div><!--底部组件中部div-->

  </div>
</template>
<script type="es6">
  export default {}
</script>
<style lang="less" scoped>
  .footer_all {
    background-color: rgba(0, 0, 0, 0.84);
    color: rgba(168, 168, 168, 0.96);
    .footer_top {
      text-align: center;
      li {
        list-style: none;
        display: inline-block;
        margin: 10px 30px 0 30px;
      }
    }
    .footer_middle {
      text-align: center;
      padding-bottom: 20px;
    }

  }
</style>
