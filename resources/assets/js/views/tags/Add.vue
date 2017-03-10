<template>
    <section class="content animated">
        <error-alert :errorShow="errorShow"></error-alert>
        <success-alert :successShow="successShow"></success-alert>
        <div class="box container-fluid" >
            <form class="form-horizontal"  @submit.prevent="validateBeforeSubmit">
                <div class="box-header"></div>
                <div class="form-group" :class="{ 'has-error': errors.has('name') }" >
                    <label for="name"  class="col-sm-2 control-label" >标签名</label>
                    <div class="col-sm-9 col-md-6">
                        <input class="form-control" id="name" name="name" v-model='formData.name' v-validate:email.initial="'required'"  type="text" :value="formData.name">
                        <span v-show="errors.has('name')" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span v-show="errors.has('name')" class="red-color help-block">{{ errors.first('name') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">描述</label>
                    <div class="col-sm-9 col-md-6">
                        <textarea class="form-control" rows="3" v-model='formData.description' name="description" cols="50" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"  class="col-sm-2 control-label" >是否禁用</label>
                    <div class="radio col-sm-9">
                        <label>
                            <input type="radio" v-model='formData.is_display' name="is_display"  value="yes" >是
                        </label>
                        <label>
                            <input type="radio" v-model='formData.is_display' name="is_display"  value="no" />否
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
<style>
.form-control-feedback{
    right: 15px;
}
.red-color{
    color:red;
}
</style>
<script>
 export default {
    data(){
        return {
            successShow:false,
            errorShow:false,
            formData:{
                name: '',
                description: '',
                is_display: 'no',
            },
        }
    },
    methods: {
        validateBeforeSubmit() {
            this.$validator.validateAll().then(success => {
                if (! success) {
                    return;
                }

                axios.post(window.Domain + 'api/admin/tag',this.formData)
                    .then(response => {
                      this.errorShow = false;
                      this.successShow = true;
                    })
                    .catch(function (error) {
                      this.errorShow = true;
                      this.successShow = false;
                    });
            });
        }
    }
  }
</script>
