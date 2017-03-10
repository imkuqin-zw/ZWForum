<template>
    <section class="content-header">
        <h1>{{ name }}</h1>
        <ol class="breadcrumb" >
            <li class="active" v-for="(item, index) in list" >
                <span class='' v-if="isLast(index)" >{{ showName(item) }}</span>
                <router-link :to="item.path" v-else-if="hasPath(item)">{{ showName(item) }}</router-link>
                <span class='' v-else >{{ showName(item) }}</span>

            </li>
        </ol>
    </section>
</template>
<style>

</style>
<script>

    export default{
        data () {
            return {
              list: null
            }
        },
        created () {
            this.getList();
        },
        computed: {
            name () {
              return this.$route.meta && this.$route.meta.label || this.$route.name
            }
        },
        methods: {
            getList () {
              let matched = this.$route.matched//.filter(item => item.name)
              let first = matched[0]
              if (first && (first.name !== 'home')) {
                matched = [{ name: '后台首页', path: '/' }].concat(matched)
              }
              this.list = matched
            },
            showName (item){
                return item.meta && item.meta.label || item.name
            },
            isLast(index){
                return index === this.list.length -1
            },
            hasPath(item){
                return item.path && item.path != '#'
            }
        },
        watch: {
            $route () {
              this.getList()
            },
        }
    }
</script>
