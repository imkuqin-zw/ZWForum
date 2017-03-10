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
               perm:[],
               apiUrl:'',
               tableName:'',
               tableFields:[
                   {name:'id',trans:'id'},
                   {name:'title',trans:'标题'},
                   {name:'reply_count',trans:'回复数'},
                   {name:'is_top',trans:'是否置顶'},
                   {name:'reply_count',trans:'回复数'},
                   {name:'vote_count',trans:'点赞数'},
                   {name:'is_blocked',trans:'是否禁止显示'},
                   {name:'is_excellent',trans:'是否加精'},
                   {name:'user',trans:'文章创建者'},
                   {name:'category',trans:'分类名'},
                   {name:'created_at',trans:'创建时间'},

               ],
           }
       },
       created () {
           this.apiUrl = window.Domain + 'api/admin/topic';
           this.tableName = 'topic';
       }
    }
</script>
