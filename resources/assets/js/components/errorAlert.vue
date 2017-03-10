<template>
<div v-show="errorShow" class="alert alert-danger alert-dismissible"  >
    <button type="button" class="close" @click="errorShow = false" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> 失败！</h4>
</div>
</template>

<script>
    export default{
      props: {
        errorShow:false
      }
    }
</script>