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
                   {name:'display_name',trans:'名字'},
                   {name:'description',trans:'角色描述'},
                   {name:'created_at',trans:'创建时间'},
               ],
           }
       },
       created () {
           this.apiUrl = window.Domain + 'api/admin/role';
           this.tableName = 'role';
       }
    }
</script>
