<template>
  <div class="index-page">
    <div class="index-title">
      <span>首页轮播图管理</span>
      <hr>
    </div>
    <div class="index-picture">
      <!--图片1-->
      <div v-for="i in 4" :key="i" class="item">
        <el-upload
          class="avatar-uploader"
          action="https://api.sa.gqxqd.cn/upload"
          :show-file-list="false"
          :on-success="handleAvatarSuccess(i)"
          :before-upload="beforeAvatarUpload(i)">
          <img v-if="imageUrl['A'+i]" :src="imageUrl['A'+i]" class="image">
          <i v-else class="el-icon-plus"></i>
        </el-upload>
      </div>
    </div>
    <!--首页文章管理-->
    <div class="index-title">
      <span>首页文章管理</span>
      <hr>
    </div>
    <div class="index-text">
      <el-button type="primary" @click="add_article">添加</el-button>
      <el-table
        :data="articles"
        border>
        <el-table-column
          prop="atitle"
          label="文章题目">
        </el-table-column>
        <el-table-column
          prop="author"
          label="文章作者">
        </el-table-column>
        <el-table-column
          label="操作"
          width="100">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="editArticle(scope.row)">编辑</el-button>
            <el-button type="text" size="small" @click="deleteArticle(scope.row.aid)" class="text-danger">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
      <!--文章编辑功能弹出框-->
      <el-dialog title="首页文章" :visible.sync="dialogFormVisible2">
        <el-form label-width="80px">
          <el-form-item label="文章题目">
            <el-input v-model="currentArticle.atitle"></el-input>
          </el-form-item>
          <el-form-item label="文章作者">
            <el-input v-model="currentArticle.author"></el-input>
          </el-form-item>
          <el-form-item label="文章内容">
            <el-input type="textarea" v-model="currentArticle.acontent"></el-input>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible2 = false">取 消</el-button>
          <el-button type="primary" @click="editArticle1">确 定</el-button>
        </div>
      </el-dialog>

      <!--文章添加功能对话框-->

      <el-dialog title="首页文章" :visible.sync="dialogFormVisible1">
        <el-form label-width="80px">
          <el-form-item label="文章题目">
            <el-input v-model="addArticle.atitle"></el-input>
          </el-form-item>
          <el-form-item label="文章作者">
            <el-input v-model="addArticle.author"></el-input>
          </el-form-item>
          <el-form-item label="文章内容">
            <el-input type="textarea" v-model="addArticle.acontent"></el-input>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible1 = false">取 消</el-button>
          <el-button type="primary" @click="addArticle1">确 定</el-button>
        </div>
      </el-dialog>

    </div>
    <!--首页链接管理-->
    <div class="index-title">
      <span>首页链接管理</span>
      <hr>
    </div>
    <div class="index-link">
      <el-button type="primary" @click="add_link">添加</el-button>
      <el-table
        :data="links"
        border>
        <el-table-column
          prop="rname"
          label="链接名称">
        </el-table-column>
        <el-table-column
          prop="rcontent"
          label="链接地址">
        </el-table-column>
        <el-table-column
          label="操作"
          width="100">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="editLink(scope.row)">编辑</el-button>
            <el-button type="text" size="small" @click="deleteLink(scope.row.rid)" class="text-danger">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
      <!--链接编辑功能弹出框-->
      <el-dialog title="首页链接" :visible.sync="dialogFormVisible4">
        <el-form label-width="80px">
          <el-form-item label="链接名称">
            <el-input v-model="currentLink.rname"></el-input>
          </el-form-item>
          <el-form-item label="链接地址">
            <el-input v-model="currentLink.rcontent"></el-input>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible4 = false">取 消</el-button>
          <el-button type="primary" @click="editLink1">确 定</el-button>
        </div>
      </el-dialog>

      <!--链接添加功能对话框-->

      <el-dialog title="首页链接" :visible.sync="dialogFormVisible3">
        <el-form label-width="80px">
          <el-form-item label="链接名称">
            <el-input v-model="addLink.rname"></el-input>
          </el-form-item>
          <el-form-item label="链接地址">
            <el-input v-model="addLink.rcontent"></el-input>
          </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible3 = false">取 消</el-button>
          <el-button type="primary" @click="addLink1">确 定</el-button>
        </div>
      </el-dialog>
    </div>
  </div>
</template>
<script type="es6">
  import api from '../../api'

  export default {
    created () {
      this.loadImage()
      this.loadArticles()
      this.loadLinks()
    },
    data () {
      return {
        dialogFormVisible1: false,
        dialogFormVisible2: false,
        dialogFormVisible3: false,
        dialogFormVisible4: false,
        currentArticle: {aid: '', atitle: '', author: '', acontent: ''},
        addArticle: {atitle: '', author: '', acontent: ''},
        currentLink: {rname: '', rcontent: ''},
        addLink: {rname: '', rcontent: ''},
        imageUrl: {
          'A1': '',
          'A2': '',
          'A3': '',
          'A4': '',
        },
        links: [{rid: '1', rname: '高考志愿网', rcontent: 'http://www.gkzy.com/'}],
        articles: [{aid: '1', atitle: '高考大保健', author: 'π', acontent: 'asdfbaskgdb asdghashd fasdf'}]
      }
    },
    methods: {
      loadImage () {
        api.get(`admin/resources?rtype=picture`).then((res) => {
          res = res.data
          res.data.map((r) => {
            this.imageUrl[r.rname] = r.rcontent
          })
        })
      },
      loadArticles () {
        api.get('admin/article').then((res) => {
          res = res.data
          this.articles = res.data
        })
      },
      loadLinks () {
        api.get(`admin/resources?rtype=link`).then((res) => {
          res = res.data
          this.links = res.data
        })
      },
      handleAvatarSuccess (i) {
        return (res) => {
          res.data = res.data.split('&')[0]
          this.imageUrl['A' + i] = res.data
          api.put(`admin/resources/A${i}?pic=1`, {rcontent: res.data}).then((res) => {
            res = res.data
            if (res.code === 0) {
              this.$message.success('更改成功')
            } else {
              this.$message.error('更改失败')
            }
          })
        }
      },
      beforeAvatarUpload (i) {
//        console.log(i)
      },
//      添加文章
      add_article () {
        this.dialogFormVisible1 = true
      },
      addArticle1 () {
        api.post('admin/article', this.addArticle).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.$message.success('添加成功')
            this.dialogFormVisible1 = false
            this.addArticle = []
            this.loadArticles()
          } else {
            this.$message.error('添加失败')
            this.dialogFormVisible1 = false
          }
        })
      },
//      编辑文章
      editArticle (a) {
        this.currentArticle = {...a}
        this.dialogFormVisible2 = true
      },
      editArticle1 () {
        api.put(`admin/article/111`, this.currentArticle).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.dialogFormVisible2 = false
            this.$message.success('编辑成功')
            this.loadArticles()
          } else {
            this.dialogFormVisible2 = false
            this.$message.error('编辑失败')

          }

        })
      },
//      删除文章
      deleteArticle (id) {
        this.$alert('确定删除该文章？', '首页文章', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.delete(`admin/article/${id}`).then((res) => {
                res = res.data
                if (res.code === 0) {
                  this.$message.success('删除成功')
                  this.loadArticles()
                } else {
                  this.$message.error('删除失败')
                  this.dialogFormVisible4 = false
                }
              })
            }
          }
        })
      },
//      添加链接
      add_link () {
        this.dialogFormVisible3 = true
      },
      addLink1 () {
        api.post('admin/resources', this.addLink).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.loadLinks()
            this.$message.success('添加成功')
            this.dialogFormVisible3 = false
          } else {
            this.$message.error('添加失败')
            this.dialogFormVisible3 = false
          }
        })
      },
//      编辑链接
      editLink (l) {
        this.currentLink = {...l}
        this.dialogFormVisible4 = true
      },
      editLink1 () {
        api.put('admin/resources/dd?link=1', this.currentLink).then((res) => {
          res = res.data
          if (res.code === 0) {
            this.loadLinks()
            this.$message.success('更改成功')
            this.dialogFormVisible4 = false

          } else {
            this.$message.error('更改失败')
            this.dialogFormVisible4 = false
          }
        })
      },
//      删除链接
      deleteLink (id) {
        this.$alert('确定删除该链接？', '链接', {
          confirmButtonText: '确定',
          callback: action => {
            if (action === 'confirm') {
              api.delete(`admin/resources/${id}`).then((res) => {
                res = res.data
                if (res.code === 0) {
                  this.$message.success('删除成功')
                  this.loadLinks()
                } else {
                  this.$message.error('更改失败')
                  this.dialogFormVisible4 = false
                }
              })
            }
          }
        })
      }
    }
  }
</script>
<style lang="less" scoped>
  .index-page {
    .index-title {
      font-size: 20px;
      margin: 20px 10%;
    }
    .index-picture {
      display: flex;
      width: 500px;
      margin: 10px auto;
      .item {
        flex: 1;
        .avatar-uploader {
          width: 100px;
          height: 100px;
          line-height: 100px;
          font-size: 50px;
          text-align: center;
          border: 1px dashed gray;
          border-radius: 10px;
          overflow: hidden;
          &:hover {
            color: #04a2ff;
            border-color: rgba(4, 162, 255, 0.7);
          }
          .image {
            width: 100%;
          }
          .el-icon-plus {
            font-size: 50px;
            text-align: center;
          }
        }
      }
    }
    .index-text {
      width: 600px;
      margin: 20px auto;
    }
    .index-link {
      width: 600px;
      margin: 20px auto;
    }
  }
</style>
