<template>
    <section class="content animated">
        <error-alert :errorShow="errorShow"></error-alert>
        <success-alert :successShow="successShow"></success-alert>
        <div class="nav-tabs-custom" >
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基础信息</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">详细信息</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">角色</a></li>
                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">头像</a></li>
            </ul>
            <form class="form-horizontal"  @submit.prevent="validateBeforeSubmit">
                <div class="tab-content container-fluid">
                    <div class="tab-pane active" id="tab_1" >
                        <div class="box-header"></div>
                        <div class="form-group" :class="{ 'has-error': errors.has('email') }" >
                            <label for="email"  class="col-sm-2 control-label" >邮箱</label>
                            <div class="col-sm-9 col-md-6">
                                <input class="form-control" id="email" v-model='formData.email' name="email" v-validate:email.initial="'required|email'"  type="text" placeholder="">
                                <span v-show="errors.has('email')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                <span v-show="errors.has('email')" class="red-color help-block">{{ errors.first('email') }}</span>
                            </div>
                        </div>
                        <div class="form-group" :class="{ 'has-error': errors.has('name') }" >
                            <label for="name"  class="col-sm-2 control-label" >用户名</label>
                            <div class="col-sm-9 col-md-6">
                                <input class="form-control" id="name" name="name" v-model='formData.name' v-validate:email.initial="'required'"  type="text" placeholder="">
                                <span v-show="errors.has('name')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                <span v-show="errors.has('name')" class="red-color help-block">{{ errors.first('name') }}</span>
                            </div>
                        </div>
                        <div class="form-group" :class="{ 'has-error': errors.has('password') }" >
                            <label for="name"  class="col-sm-2 control-label" >密码</label>
                            <div class="col-sm-9 col-md-6">
                                <input class="form-control" id="password" name="password" v-model='formData.password' v-validate:password.initial="'required|min:6'"  type="password" placeholder="">
                                <span v-show="errors.has('password')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                <span v-show="errors.has('password')" class="red-color help-block">{{ errors.first('password') }}</span>
                            </div>
                        </div>
                        <div class="form-group" :class="{ 'has-error': errors.has('password_confirmation') }" >
                            <label for="name"  class="col-sm-2 control-label" >确认密码</label>
                            <div class="col-sm-9 col-md-6">
                                <input class="form-control" id="password_confirmation" name="password_confirmation" v-model='formData.password_confirmation' v-validate:password_confirmation.initial="'required|confirmed:password|min:6'"  type="password" placeholder="">
                                <span v-show="errors.has('password_confirmation')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                <span v-show="errors.has('password_confirmation')" class="red-color help-block">{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name"  class="col-sm-2 control-label" >是否禁用</label>
                            <div class="radio col-sm-9">
                                <label>
                                    <input type="radio" v-model='formData.is_banned' name="is_banned"  value="yes" >是
                                </label>
                                <label>
                                    <input type="radio" v-model='formData.is_banned' name="is_banned"  value="no" />否
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name"  class="col-sm-2 control-label" >是否管理员</label>
                            <div class="radio col-sm-9">
                                <label>
                                    <input type="radio" v-model='formData.is_admin' name="is_admin"  value="yes" >是
                                </label>
                                <label>
                                    <input type="radio" v-model='formData.is_admin' name="is_admin"  value="no" />否
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2" >
                        <div class="box-header"></div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">GitHub Name</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.github_name' name="github_name" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                请跟 GitHub 上保持一致
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">真实姓名</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.real_name' name="real_name" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：李小明
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">城市</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.city' name="city" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：北京、广州
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">公司</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.company' name="company" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：阿里巴巴
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">微博用户名</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.weibo_name' name="weibo_name" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：Overtrue
                            </div>
                        </div>

                        <div class="form-group" :class="{ 'has-error': errors.has('weibo_link') }">
                            <label for="" class="col-sm-2 control-label">微博个人页面</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.weibo_link' v-validate:weibo_link.initial="'url'" name="weibo_link" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                微博个人主页链接，如：http://weibo.com/laravelnews
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Twitter 帐号</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="formData.twitter_account" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：summer_charlie
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">个人网站</label>
                            <div class="col-sm-6">
                                <input class="form-control" v-model='formData.personal_website' name="personal_website" type="text" value="">
                            </div>
                            <div class="col-sm-4 help-block">
                                如：example.com，不需要加前缀 https://
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">个人简介</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" rows="3" v-model='formData.description' name="description" cols="50" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                            </div>
                            <div class="col-sm-4 help-block">
                                请一句话介绍你自己，大部分情况下会在你的头像和名字旁边显示
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_3" >
                        <div class="box-header"></div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">角色</label>
                            <div class="col-sm-9 col-md-6">
                                <multiselect v-model="selectedRoles" :options="roles" :multiple="true" select-label="回车选中" deselect-label="当前选中" :close-on-select="false" :clear-on-select="false" :hide-selected="true" placeholder="添加角色" label="display_name" track-by="display_name"></multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_4" >
                        <div class="box-header"></div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">头像</label>
                            <div class="col-sm-9 col-md-6">
                                <input id="avatar" @change="previewFile"  type="file">
                                <br>
                                <div style="max-width:200px;" >
                                    <img class="avatar-preview-img" :src="portrait" />
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
<script type="javascript" >
 import {Multiselect} from 'vue-multiselect'

 export default {
    data(){
        return {
            portrait:"",
            selectedRoles:[],
            roles:[],
            errorShow: false,
            successShow: false,
            formData:{
                email: '',
                name: '',
                password: '',
                password_confirmation:'',
                is_banned: 'no',
                is_admin: 'no',
                github_name:'',
                description:'',
                real_name:'',
                city:'',
                company:'',
                weibo_name:'',
                weibo_link:'',
                twitter_account:'',
                personal_website:'',
                roles:[],
                portrait:null
            },
        }
    },
    components:{
      Multiselect,
    },
    mounted(){
      this.getRoleInfo()
    },
    methods: {
        validateBeforeSubmit() {
            this.$validator.validateAll().then(success => {
                if (! success) {
                    return;
                }

                this.formData.roles = []
                for (var tmp in this.selectedRoles){
                    this.formData.roles.push(this.selectedRoles[tmp].id)
                }

                axios.post(window.Domain + 'api/admin/user',this.formData)
                    .then(response => {
                        this.errorShow = false
                        this.successShow = true
                    })
                    .catch(response => {
                        this.errorShow = true;
                        this.successShow = false;
                    });
            });
        },
        getRoleInfo(){
            axios.get(window.Domain + 'api/admin/role')
                    .then(response => {
                      var data = response.data.data
                      this.roles = data;
            })
        },
        previewFile (e) {
            let file = e.target.files[0];
            let supportedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if (file && supportedTypes.indexOf(file.type) >= 0) {
                this.showImage(file)
                console.log(this.formData.portrait)
            } else {
                this.formData.portrait = null
                this.portrait = null
            }
        },
        showImage(file){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => {
                this.portrait = e.target.result
                this.formData.portrait = e.target.result
            };

        }
      }
  }
</script>
<style lang="scss" >
    .avatar-preview-img {
        padding: 3px;
        border: 1px solid #c8dcdb;
        border-radius: 6px;
        vertical-align: middle;
        max-width: 100%;
        box-sizing: border-box;
    }
    .form-control-feedback{
        right: 15px;
    }
    .red-color{
        color:red;
    }

    fieldset[disabled] .multiselect {
        pointer-events: none;
    }

    .multiselect__spinner {
        position: absolute;
        right: 1px;
        top: 1px;
        width: 48px;
        height: 35px;
        background: #fff;
        display: block;
    }

    .multiselect__spinner:before,
    .multiselect__spinner:after {
        position: absolute;
        content: "";
        top: 50%;
        left: 50%;
        margin: -8px 0 0 -8px;
        width: 16px;
        height: 16px;
        border-radius: 100%;
        border-color: #41B883 transparent transparent;
        border-style: solid;
        border-width: 2px;
        box-shadow: 0 0 0 1px transparent;
    }

    .multiselect__spinner:before {
        animation: spinning 2.4s cubic-bezier(0.41, 0.26, 0.2, 0.62);
        animation-iteration-count: infinite;
    }

    .multiselect__spinner:after {
        animation: spinning 2.4s cubic-bezier(0.51, 0.09, 0.21, 0.8);
        animation-iteration-count: infinite;
    }

    .multiselect__loading-enter-active,
    .multiselect__loading-leave-active {
        transition: opacity 0.4s ease-in-out;
        opacity: 1;
    }

    .multiselect__loading-enter,
    .multiselect__loading-leave-active {
        opacity: 0;
    }

    .multiselect,
    .multiselect__input,
    .multiselect__single {
        font-family: inherit;
        font-size: 14px;
        touch-action: manipulation;
    }

    .multiselect {
        box-sizing: content-box;
        display: block;
        position: relative;
        width: 100%;
        min-height: 40px;
        text-align: left;
        color: #35495E;
    }

    .multiselect * {
        box-sizing: border-box;
    }

    .multiselect:focus {
        outline: none;
    }

    .multiselect--disabled {
        pointer-events: none;
        opacity: 0.6;
    }

    .multiselect--active {
        z-index: 50;
    }

    .multiselect--active .multiselect__current,
    .multiselect--active .multiselect__input,
    .multiselect--active .multiselect__tags {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .multiselect--active .multiselect__select {
        transform: rotateZ(180deg);
    }

    .multiselect--above.multiselect--active .multiselect__current,
    .multiselect--above.multiselect--active .multiselect__input,
    .multiselect--above.multiselect--active .multiselect__tags {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .multiselect__input,
    .multiselect__single {
        position: relative;
        display: inline-block;
        min-height: 20px;
        line-height: 20px;
        border: none;
        border-radius: 5px;
        background: #fff;
        padding: 1px 0 0 5px;
        width: calc(100%);
        transition: border 0.1s ease;
        box-sizing: border-box;
        margin-bottom: 8px;
    }

    .multiselect__tag ~ .multiselect__input,
    .multiselect__tag ~ .multiselect__single {
        width: auto;
    }

    .multiselect__input:hover,
    .multiselect__single:hover {
        border-color: #cfcfcf;
    }

    .multiselect__input:focus,
    .multiselect__single:focus {
        border-color: #a8a8a8;
        outline: none;
    }

    .multiselect__single {
        padding-left: 6px;
        margin-bottom: 8px;
    }

    .multiselect__tags {
        min-height: 40px;
        display: block;
        padding: 8px 40px 0 8px;
        border-radius: 5px;
        border: 1px solid #E8E8E8;
        background: #fff;
    }

    .multiselect__tag {
        position: relative;
        display: inline-block;
        padding: 4px 26px 4px 10px;
        border-radius: 5px;
        margin-right: 10px;
        color: #fff;
        line-height: 1;
        background: #41B883;
        margin-bottom: 8px;
        white-space: nowrap;
    }

    .multiselect__tag-icon {
        cursor: pointer;
        margin-left: 7px;
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        font-weight: 700;
        font-style: initial;
        width: 22px;
        text-align: center;
        line-height: 22px;
        transition: all 0.2s ease;
        border-radius: 5px;
    }

    .multiselect__tag-icon:after {
        content: "×";
        color: #266d4d;
        font-size: 14px;
    }

    .multiselect__tag-icon:focus,
    .multiselect__tag-icon:hover {
        background: #369a6e;
    }

    .multiselect__tag-icon:focus:after,
    .multiselect__tag-icon:hover:after {
        color: white;
    }

    .multiselect__current {
        line-height: 16px;
        min-height: 40px;
        box-sizing: border-box;
        display: block;
        overflow: hidden;
        padding: 8px 12px 0;
        padding-right: 30px;
        white-space: nowrap;
        margin: 0;
        text-decoration: none;
        border-radius: 5px;
        border: 1px solid #E8E8E8;
        cursor: pointer;
    }

    .multiselect__select {
        line-height: 16px;
        display: block;
        position: absolute;
        box-sizing: border-box;
        width: 40px;
        height: 38px;
        right: 1px;
        top: 1px;
        padding: 4px 8px;
        margin: 0;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .multiselect__select:before {
        position: relative;
        right: 0;
        top: 65%;
        color: #999;
        margin-top: 4px;
        border-style: solid;
        border-width: 5px 5px 0 5px;
        border-color: #999999 transparent transparent transparent;
        content: "";
    }

    .multiselect__placeholder {
        color: #ADADAD;
        display: inline-block;
        margin-bottom: 10px;
        padding-top: 2px;
    }

    .multiselect--active .multiselect__placeholder {
        display: none;
    }

    .multiselect__content {
        position: absolute;
        list-style: none;
        display: block;
        background: #fff;
        width: 100%;
        max-height: 240px;
        overflow: auto;
        padding: 0;
        margin: 0;
        border: 1px solid #E8E8E8;
        border-top: none;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        z-index: 50;
    }

    .multiselect--above .multiselect__content {
        bottom: 100%;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom: none;
        border-top: 1px solid #E8E8E8;
    }

    .multiselect__content::webkit-scrollbar {
        display: none;
    }

    .multiselect__element {
        display: block;
    }

    .multiselect__option {
        display: block;
        padding: 12px;
        min-height: 40px;
        line-height: 16px;
        text-decoration: none;
        text-transform: none;
        vertical-align: middle;
        position: relative;
        cursor: pointer;
        white-space: nowrap;
    }

    .multiselect__option:after {
        top: 0;
        right: 0;
        position: absolute;
        line-height: 40px;
        padding-right: 12px;
        padding-left: 20px;
    }

    .multiselect__option--highlight {
        background: #41B883;
        outline: none;
        color: white;
    }

    .multiselect__option--highlight:after {
        content: attr(data-select);
        background: #41B883;
        color: white;
    }

    .multiselect__option--selected {
        background: #F3F3F3;
        color: #35495E;
        font-weight: bold;
    }

    .multiselect__option--selected:after {
        content: attr(data-selected);
        color: silver;
    }

    .multiselect__option--selected.multiselect__option--highlight {
        background: #FF6A6A;
        color: #fff;
    }

    .multiselect__option--selected.multiselect__option--highlight:after {
        background: #FF6A6A;
        content: attr(data-deselect);
        color: #fff;
    }

    .multiselect--disabled {
        background: #ededed;
        pointer-events: none;
    }

    .multiselect--disabled .multiselect__current,
    .multiselect--disabled .multiselect__select {
        background: #ededed;
        color: #a6a6a6;
    }

    .multiselect__option--disabled {
        background: #ededed;
        color: #a6a6a6;
        cursor: text;
        pointer-events: none;
    }

    .multiselect__option--disabled.multiselect__option--highlight {
        background: #dedede !important;
    }

    .multiselect-enter-active,
    .multiselect-leave-active {
        transition: all 0.15s ease;
    }

    .multiselect-enter,
    .multiselect-leave-active {
        opacity: 0;
    }

    @keyframes spinning {
        from { transform:rotate(0) }
        to { transform:rotate(2turn) }
    }
</style>