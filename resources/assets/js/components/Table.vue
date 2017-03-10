<template>
    <div class="row">
        <div class="col-xs-12">
            <div v-show="alertShow" class="alert alert-danger alert-dismissible"  >
                <button type="button" class="close" @click="alertShow = false" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> 删除失败！</h4>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th v-for="field in tableFields">{{ field.trans }}</th>
                            <th v-if="hasPerm( tableName )" >操作</th>
                        </tr>

                        <tr v-for="item in items" >
                            <td v-for="field in tableFields" >
                                <template v-if="field.trans === '头像' " >
                                    <img :src="domain + 'uploads/portraits/' + item[field.name]" style="width: 40px;height: 40px;border-radius: 50%;">
                                </template>
                                <template v-else >
                                    {{ item[field.name] }}
                                </template>
                            </td>
                            <td >
                                <ul class='fc-color-picker'>
                                    <li>
                                        <template v-if="displayShow && canPerm(tableName,'show')" >
                                            <router-link  :to=" '/'+ tableName +'/'+ item['id']+'/show' " style="font-size:16px;" class="text-aqua" title="查看"  >
                                                <i class="fa fa-eye"></i>
                                            </router-link>
                                        </template>
                                        <template v-else-if="canPerm(tableName,'edit')" >
                                        <router-link :to=" '/'+ tableName +'/'+ item['id'] + '/edit' " style="font-size:16px;" class="text-aqua" title="编辑"  >
                                            <i class="fa fa-edit"></i>
                                        </router-link>
                                        </template>
                                        <a v-if="canPerm(tableName,'delete')"  style="font-size:16px;" class="text-red" href="#" @click="setDeleteId(item['id'])" data-toggle="modal" data-target="#deleteModal"  title="删除" >
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        <div class="modal modal-danger  " id="deleteModal" >
                                            <div class="modal-dialog animated bounceIn">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title">提示</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>确定删除吗？</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">关闭</button>
                                                        <button type="button" @click="deleteClick()" data-dismiss="modal" class="btn btn-outline">确定</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <table-pagination ref="pagination" v-on:loadPage="loadPage" v-if="items.length > 0" ></table-pagination>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</template>
<style>
</style>
<script type="text/javascript" >
import TablePagination from './TablePagination.vue'

export default{
  props: {
    displayShow: {
      type: Boolean,
      dafault() {
        return false
      }
    },
    tableName:{
      type: String,
      required: false
    },
    tableFields: {
      type: Array,
      required: true
    },
    apiUrl: {
      type: String,
      required: true
    },
  },
  watch: {
    $route() {
      let pageNum = 1
      if (this.$route.query.page) {
        pageNum = this.$route.query.page
      }
      this.loadPage(pageNum)
    }
  },
  components: {
    TablePagination,
  },
  data() {
    return{
      domain: window.Domain,
      alertShow:false,
      deleteId:null,
      items: [],
      totalPage: 0,
      currentPage: 0,
      pagination: null
    }
  },

  created() {
    this.loadData()
  },
  methods: {
    hasPerm(key){
      var tmp = this.$store.state.app.permissions[key]
      if (tmp instanceof Array){
        if (tmp.indexOf('edit-' + key) > -1 || tmp.indexOf('show-' + key) > -1 || tmp.indexOf('delete-' + key) > -1)
          return true;
      }
      return false
    },
    canPerm(key,value){
      var tmp = this.$store.state.app.permissions[key]
      return (tmp.indexOf(value+'-'+key) > -1)? true:false
    },
    loadPage(page) {
      if (page == 'prev') {
        this.goPreviousPage()
      } else if (page == 'next') {
        this.goNextPage()
      } else {
        this.goPage(page)
      }
    },
    loadData() {
      var url = this.apiUrl;
      if (this.currentPage) {
        let page = ''
        if (url.indexOf('?') != -1) {
          page = '&page='
        } else {
          page = '?page='
        }
        url = url + page + this.currentPage
        this.$router.push(page + this.currentPage)
      }
      axios.get(url)
        .then(response => {
          this.pagination = response.data.meta.pagination
          this.items = response.data.data
          this.totalPage = response.data.meta.pagination.total_pages
          this.currentPage = response.data.meta.pagination.current_page

          if (this.items.length != 0) {
              this.$nextTick(() => {
                  this.$refs.pagination.$data.pagination = this.pagination
              })
          }
      });
    },
      goPreviousPage() {
          if (this.currentPage > 1) {
              this.currentPage--
              this.loadData()
          }
      },
      goNextPage() {
          if (this.currentPage < this.totalPage) {
              this.currentPage++
              this.loadData()
          }
      },
      goPage(page) {
          if (page != this.currentPage && (page > 0 && page <= this.totalPage)) {
              this.currentPage = page
              this.loadData()
          }
      },
      reload() {
          this.loadData()
      },
      setDeleteId(id){
        this.deleteId = id;
      },
      deleteClick(){
        if(this.deleteId){
          axios.delete(window.Domain+'api/admin/'+ this.tableName + '/' + this.deleteId)
            .then(response => {
                this.reload();
            })
            .catch(error => {
                this.alertShow = true;
            });
        }
      }
  }
}
</script>
