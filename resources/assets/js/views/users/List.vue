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
                   {name:'portrait_min',trans:'头像'},
                   {name:'name',trans:'名字'},
                   {name:'topic_count',trans:'文章数'},
                   {name:'topic_count',trans:'回复数'},
                   {name:'is_banned',trans:'是否禁用'},
                   {name:'created_at',trans:'创建时间'},
               ],
           }
       },
       created () {
           this.apiUrl = window.Domain + 'api/admin/user';
           this.tableName = 'user';
       }
    }
</script>
