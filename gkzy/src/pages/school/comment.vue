<template>
  <div class="comment-page">
    <div>
      <ul>
        <li v-for="item in comments" class="comment-list">
          <div class="image">
            <img :src="item.uphoto" alt="">
          </div>
          <div class="content">
            <div class="content-name">
              <span class="nnn">{{item.uname}}</span>
              <span class="ttt">{{item.ctime}}</span>
            </div>
            <div class="content-text">
              <span>{{item.ccontent}}</span>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="comment-area">
      <el-input
        type="textarea"
        :rows='4'
        :autosize="{ minRows: 4, maxRows: 4}"
        placeholder="请输入内容"
        v-model="ccontent">
      </el-input>

      <el-button type="primary" size="small" @click="pingLun">发送</el-button>
    </div>

  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created(){
      this.selectComment()
    },
    data () {
      return {
        comments: [{cid: '', uname: '吱吱', uphoto: '', sname: '', ctime: '2016-05-15 23：46：44', ccontent: '这个学校好好'}],
        ccontent: '',
      }
    },
    methods: {
      pingLun () {
        api.put(`index/comment/${this.$route.params.sid}`, {ccontent: this.ccontent}).then((res) => {
            res =res.data
          if(res.code ===0){
            this.ccontent = null
            this.selectComment()

          }else {
            this.$message.error('留言失败')
          }
        })
      },
      selectComment(){
        api.get(`index/comment?sid=${this.$route.params.sid}`).then((res)=>{
          res =res.data
          if(res.code ===0){
            this.comments = res.data
          }else {
            this.$message.error('加载数据失败')
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .comment-page {
    ul {
      margin: 0;
      padding: 0
    }
    li {
      padding: 10px 0;
      list-style-type: none;
      border-bottom: 1px solid rgba(29, 29, 29, 0.3);
    }
    .comment-list {
      display: flex;
      flex-flow: row nowrap;
      .image {
        width: 50px;
        height: 50px;
        img{width: 100%;
        }
      }
      .content {
        margin-left: 20px;
        .content-name {
          height: 25px;

          .nnn {
            font-size: 18px;
            font-weight: 600;
          }
          .ttt {
            margin-left: 30px;
            font-size: 12px;
            color: #999;
          }
        }
        .content-text {

        }
      }
    }
    .comment-area {
      margin: 50px 50% 0 0;
      button {
        margin-top: 20px;
      }
    }
  }
</style>
