<template>
  <div class="about-page">
    <div class="about-aside">
      <!--<span>关于我们</span>-->
      <el-menu  class="el-menu-vertical-demo" backgroundColor="rgb(235, 248, 255)">
        <el-menu-item index="4">
          <span>关于我们</span>
        </el-menu-item>
      </el-menu>
    </div>
    <div class="about-main">
      <ul>
        <li>
          <span class="span-title">网站简介</span><br>
          <span class="span-text">第一高考网，隶属于远播教育集团。
         远播教育成立于2007年，目前已发展成为总部位于上海，14家分公司及机构遍布于海内外，
         集教育平台、国际教育、素养教育、高考教育、教育研究为一体的拥有高端教育资源的大型跨国教育集团，
         致力于培养具有全球视野的国际化创新人才，共同实现线上线下、国内和国外教育资源的无缝对接，
         为广大学子提供更优质的教育服务和教育资源。2016年8月18日，集团新三板挂牌上市，开启了新的征程，
         在秉承着为追求进步的人贡献价值的使命，远播教育在成为最专业最可信赖的教育服务机构的路上更进一步。</span>
        </li>
        <li>
          <span class="span-title">个人简介</span><br>
          <span class="span-text"> 企业使命：为不断追求进步的人贡献价值
          第一高考网成立于2009年，是远播教育集团顺应国家高考改革的趋势，结合广大高中生及家长的急切需求，
         由著名教育学者熊丙奇博士领衔研发，提供生涯规划、学习提升、高考历年数据查询、志愿填报智能模拟等相应内容，
         组成前程规划系统核心模块，帮助学生更清晰认识自己、提早了解高校、科学定位专业、明确未来走向和高考志愿智能模拟等，累计用户达到160万。
          第一高考网近年来更进一步为高中生提供自招综评课程、
         升学规划咨询、志愿填报咨询等个性化服务，有来自上海交通大学、同济大学、复旦大学、
         北京师范大学等数几十名专家讲师强力助阵，得到学生、家长、学校及教育专家的一致好评，
         是业内知名的一站式升学服务综合平台！</span>
        </li>
      </ul>
    </div>

  </div>

</template>
<script type="es6">

  export default {
    components: {}
  }
</script>
<style lang="less" scoped>

  .about-page {
    display: flex;
    flex-flow: row;
    width: 960px;
    margin: 0 auto;
    .about-aside {
      flex-shrink: 0;
      width: 120px;
      height: 85vh;
      background-color: rgba(179, 212, 231, 0.37);
    }
    .about-main {
      padding: 0 20px 0 20px;
      flex-grow: 1;
      background-color:rgba(115,115,115,0.1);
      ul{padding-left: 0;margin: 0}
      li{list-style-type: none;margin: 20px 0}
      .span-title{
          font-size: 20px;
      }
      .span-text{
        display: inline-block;
        text-indent: 2em;
      }
    }

  }
</style>
