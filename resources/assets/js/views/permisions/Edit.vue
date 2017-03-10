<template>
    <section class="content animated">
        <error-alert :errorShow="errorShow"></error-alert>
        <success-alert :successShow="successShow"></success-alert>
        <div class="nav-tabs-custom" >
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基础信息</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">权限分配</a></li>
            </ul>
            <form class="form-horizontal"  @submit.prevent="validateBeforeSubmit">
                <div class="tab-content container-fluid">
                    <div class="tab-pane active" id="tab_1" >
                        <div class="box-header"></div>
                        <div class="form-group" :class="{ 'has-error': errors.has('display_name') }" >
                            <label for="name"  class="col-sm-2 control-label" >角色展示名</label>
                            <div class="col-sm-9 col-md-6">
                                <input class="form-control" id="display_name" name="display_name" v-model='formData.display_name' v-validate:display_name.initial="'required'"  type="text" >
                                <span v-show="errors.has('display_name')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                <span v-show="errors.has('display_name')" class="red-color help-block">{{ errors.first('display_name') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">描述</label>
                            <div class="col-sm-9 col-md-6">
                                <textarea class="form-control" rows="3" v-model='formData.description' name="description" cols="50" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2" >
                        <div class="box-header"></div>
                        <div class="form-group" v-for=" (permission,index) in permissions" >
                            <div class="col-sm-2 ">
                                <div  class="checkbox ">
                                    <label style="font-weight: 700;" >
                                        <input v-model="allChecked[index]" @click="checkedAll(index)"  type="checkbox"> {{ trans[index] }}
                                    </label>
                                </div>
                            </div>
                            <div  class="col-sm-10 ">
                                <div class="checkbox">
                                    <label v-for="(item,index_2) in permission" style="margin-right:10px;" >
                                        <input v-model="checkedPerms[index]" :id="index_2" :value="item.id" type="checkbox"> {{ item.display_name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>
<style>
.form-control-feedback{
    right: 15px;
}
.red-color{
    color:red;
}
</style>
<script type="javascript" >

    export default {
        data(){
            return {
                errorShow:false,
                successShow:false,
                allChecked:{user:false,role:false,cate:false,tag:false,topic:false,reply:false},
                trans:{user:'用户管理',role:'角色管理',cate:'分类管理',tag:'标签管理',topic:'话题管理',reply:'回复管理'},
                permissions:[],
                checkedPerms:{user:[],role:[],cate:[],tag:[],topic:[],reply:[]},
                formData:{
                    display_name:'',
                    description: '',
                    perms:[]
                },
            }
        },
        mounted(){
            this.getPerms()
            this.getRoleInfo()
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then(success => {
                    if (! success) {
                        return;
                    }
                    this.formData.perms = []
                    for (var index in this.checkedPerms){
                        this.checkedPerms[index].forEach(item=>{
                            this.formData.perms.push(item);
                        })
                    }
                    axios.put(window.Domain + 'api/admin/role/'+ this.$route.params.roleId,this.formData)
                            .then(response => {
                              this.errorShow = false;
                              this.successShow = true;
                            })
                            .catch(function (error) {
                                this.errorShow = true;
                                this.successShow = false;
                            });
                });
            },
            getPerms(){
                axios.get(window.Domain + 'api/admin/perms')
                        .then(response => {
                            this.permissions = response.data;
                            //console.log(this.formData.perms)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
            },
            checkedAll(index){
                if (this.allChecked[index]){
                    this.checkedPerms[index] = []
                    this.permissions[index].forEach(item=>{
                        this.checkedPerms[index].push(item.id)
                    })
                }else{
                    this.checkedPerms[index] = []
                }
            },
            getRoleInfo(){
                axios.get(window.Domain + 'api/admin/role/' + this.$route.params.roleId)
                        .then(response => {
                            let data = response.data.data;
                            this.formData.display_name = data.display_name
                            this.formData.description =data.description
                            var perms = data.perms.data
                            for (var item in perms){
                              this.checkedPerms[perms[item].type].push(perms[item].id)
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
            },
        }
    }
</script>
