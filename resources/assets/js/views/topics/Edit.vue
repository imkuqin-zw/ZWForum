<template>
    <section class="content animated">
        <error-alert :errorShow="errorShow"></error-alert>
        <success-alert :successShow="successShow"></success-alert>
        <div class="box container-fluid" >
            <form class="form-horizontal"  @submit.prevent="validateBeforeSubmit">
                <div class="box-header"></div>
                <div class="form-group" :class="{ 'has-error': errors.has('title') }" >
                    <label for="title"  class="col-sm-2 control-label" >标题</label>
                    <div class="col-sm-9 col-md-6">
                        <input class="form-control" id="title" name="title" v-model='formData.title' v-validate:title.initial="'required'"  type="text" :value="formData.title">
                        <span v-show="errors.has('title')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span v-show="errors.has('title')" class="red-color help-block">{{ errors.first('title') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">分类</label>
                    <div class="col-sm-9 col-md-6">
                        <multiselect v-model="selected" select-label="回车选中" deselect-label="当前选中" track-by="name" label="name" placeholder="请选择分类" :options="categorys" :searchable="false" :allow-empty="false"></multiselect>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">内容</label>
                    <div class="col-sm-9 col-md-8">
                        <textarea id="editor"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">标签</label>
                    <div class="col-sm-9 col-md-6">
                        <multiselect v-model="selectedTags" :options="tags" :multiple="true" select-label="回车选中" deselect-label="当前选中" :close-on-select="false" :clear-on-select="false" :hide-selected="true" placeholder="添加标签" label="name" track-by="name"></multiselect>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"  class="col-sm-2 control-label" >是否禁止显示</label>
                    <div class="radio col-sm-9">
                        <label>
                            <input type="radio" v-model='formData.is_blocked' name="is_blocked"  value="yes" >是
                        </label>
                        <label>
                            <input type="radio" v-model='formData.is_blocked' name="is_blocked"  value="no" />否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"  class="col-sm-2 control-label" >是否加精</label>
                    <div class="radio col-sm-9">
                        <label>
                            <input type="radio" v-model='formData.is_excellent' name="is_excellent"  value="yes" >是
                        </label>
                        <label>
                            <input type="radio" v-model='formData.is_excellent' name="is_excellent"  value="no" />否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"  class="col-sm-2 control-label" >是否置顶</label>
                    <div class="radio col-sm-9">
                        <label>
                            <input type="radio" v-model='formData.is_top' name="is_top"  value="yes" >是
                        </label>
                        <label>
                            <input type="radio" v-model='formData.is_top' name="is_top"  value="no" />否
                        </label>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-9">
                        <button class="btn btn-primary" type="submit">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>

<script type="javascript">
    import {Multiselect} from 'vue-multiselect'
    import { default as SimpleMDE } from 'simplemde/dist/simplemde.min.js'
    import  'vendor/codemirror-4.inline-attachment.min.js'

    export default {
        data(){
            return {
                errorShow:false,
                successShow:false,
                tags:[],
                selectedTags:[],
                simplemde:'',
                selected: "",
                categorys: [],
                formData: {
                    tags:'',
                    title: '',
                    content:'',
                    category_id: '',
                    is_blocked: 'no',
                    is_excellent:'no',
                    is_top:'no'
                },
            }
        },
        components: {
            Multiselect,
        },
        mounted(){
            this.getCategorys()
            this.getTags()
            this.getTopicInfo()
            this.simplemde = new SimpleMDE({
                element: document.getElementById("editor"),
                placeholder: '请输入内容',
                forceSync: true
            })
            inlineAttachment.editors.codemirror4.attach(this.simplemde.codemirror, {
                uploadUrl: window.Domain + 'api/topic/uploadimg',
                extraParams: {
                    '_token': window.Laravel.csrfToken,
                },
                extraHeaders:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                onFileUploadResponse: function (xhr) {
                    var result = JSON.parse(xhr.responseText),
                            filename = result[this.settings.jsonFieldName];
                    if (result && filename) {
                        var newValue;
                        if (typeof this.settings.urlText === 'function') {
                            newValue = this.settings.urlText.call(this, filename, result);
                        } else {
                            newValue = this.settings.urlText.replace(this.filenameTag, filename);
                        }
                        var text = this.editor.getValue().replace(this.lastValue, newValue);
                        this.editor.setValue(text);
                        this.settings.onFileUploaded.call(this, filename);
                    }
                    return false;
                }
            });
        },
        methods: {
            validateBeforeSubmit() {
                this.$validator.validateAll().then(success => {
                    if (!success) {
                        return;
                    }
                    this.formData.category_id = this.selected.id;
                    for (var tmp in this.selectedTags){
                      if(tmp == 0)
                        this.formData.tags = this.selectedTags[tmp].id
                      else
                        this.formData.tags += ","+this.selectedTags[tmp].id
                    }

                    axios.put(window.Domain + 'api/admin/topic/' + this.$route.params.topicId,this.formData)
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
            getTopicInfo(){
                axios.get(window.Domain + 'api/admin/topic/' + this.$route.params.topicId)
                        .then(response => {
                            let data = response.data.data;
                            this.formData.title = data.title
                            this.formData.is_blocked = data.is_blocked
                            this.formData.is_excellent = data.is_excellent
                            this.formData.is_top = data.is_top
                            this.formData.content = data.content
                            this.selected = data.category.data
                            this.selectedTags = data.tags.data
                            //this.formData.category_id = data.category.data.id;
                            this.simplemde.value(data.content)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
            },
            getCategorys(){
                axios.get(window.Domain + 'api/admin/cate')
                    .then(response => {
                        let data = response.data.data;
                        this.categorys = data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getTags(){
                axios.get(window.Domain + 'api/admin/tag')
                    .then(response => {
                        let data = response.data.data;
                        this.tags = data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>
<style lang="scss" >

@import '~simplemde/dist/simplemde.min.css';

.editor-toolbar.fullscreen {
    z-index: 3000 !important;
}

.CodeMirror-fullscreen {
    z-index: 3000 !important;
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
