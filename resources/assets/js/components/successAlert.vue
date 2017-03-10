<template>
<div v-show="successShow" class="alert alert-success alert-dismissible"  >
    <button type="button" class="close" @click="successShow = false" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> 成功！</h4>
</div>
</template>

<script>
  export default{
    props: {
      successShow:false
    }
  }
</script>