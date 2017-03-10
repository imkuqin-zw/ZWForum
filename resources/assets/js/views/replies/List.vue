<template>
    <section class="content animated">
        <vue-table :apiUrl="apiUrl" :displayShow="displayShow" :tableName='tableName' :tableFields="tableFields" ></vue-table>
    </section>
</template>
<style>
</style>
<script type="text/javascript">
    export default{
       data(){
           return {
               displayShow:true,
               apiUrl:'',
               tableName:'',
               tableFields:[
                   {name:'id',trans:'id'},
                   {name:'topic',trans:'话题标题'},
                   {name:'user',trans:'发表用户'},
                   {name:'created_at',trans:'创建时间'},
               ],
           }
       },
       created () {
           this.apiUrl = window.Domain + 'api/admin/reply';
           this.tableName = 'reply';
       }
    }
</script>
