<template>
    <div class="content-wrapper animated " style="min-height: 298px;">
        <LevelBar></LevelBar>
        <transition mode="out-in" enter-active-class="fadeIn" leave-active-class="fadeOut" appear >
            <router-view ></router-view>
        </transition>
    </div>
</template>
<style>

</style>
<script>
    import LevelBar from './LevelBar'
    export default{
        components:{
            LevelBar
        }
    }
</script>
