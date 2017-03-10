<template>
    <section class="content animated">
        <div class="markdown-reply container box"  >
            <div class="box-header"></div>
            <div v-html="content"></div>
        </div>
    </section>
</template>
<style lang="scss" >
@import '../../../sass/markdown';
.emoji {
    width: 1.6em;
    display: inline-block;
    margin-bottom: 0;
    margin-top: -5px;
    margin-left: 5px;
}
</style>
<script>
 export default {
    data(){
        return {
            content:'',
        }
    },
    mounted(){
        this.getTagInfo()
    },
    methods: {
        getTagInfo(){
            axios.get(window.Domain + 'api/admin/reply/' + this.$route.params.replyId )
                .then(response => {
                    let data = response.data.data;
                    this.content = data.content
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    }
  }
</script>
