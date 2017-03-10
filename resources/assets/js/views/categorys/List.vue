<template>
    <section class="content animated">
        <vue-table :apiUrl="apiUrl" :tableName='tableName' :tableFields="tableFields" ></vue-table>
    </section>
</template>
<style>
</style>
<script type="text/javascript">
    export default{
       data(){
           return {
               apiUrl:'',
               tableName:'',
               tableFields:[
                   {name:'id',trans:'id'},
                   {name:'name',trans:'名字'},
                   {name:'topic_count',trans:'文章数'},
                   {name:'is_blocked',trans:'是否显示话题'},
                   {name:'order',trans:'排序'},
                   {name:'is_display',trans:'是否禁用'},
                   {name:'created_at',trans:'创建时间'},
               ],
           }
       },
       created () {
           this.apiUrl = window.Domain + 'api/admin/cate';
           this.tableName = 'cate';
       }
    }
</script>
