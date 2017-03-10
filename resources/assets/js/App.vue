<template>
    <div class="wrapper" style="height: auto;">
        <nprogress-container></nprogress-container>
        <NavBar></NavBar>
        <SideBar></SideBar>
        <AppMain></AppMain>
        <FooterBar></FooterBar>
    </div>
</template>
<style lang="scss">
    @import '~animate.css/animate.min.css';
    .animated {
        animation-duration: .377s;
    }
    .nprogress-container {
        position: fixed !important;
        width: 100%;
        height: 100px;
        z-index: 2048;
        pointer-events: none;

        #nprogress {
            $color: #48e79a;

            .bar {
                background: $color;
            }
            .peg {
                box-shadow: 0 0 10px $color, 0 0 5px $color;
            }

            .spinner-icon {
                border-top-color: $color;
                border-left-color: $color;
            }
        }
    }
</style>
<script>
    import SideBar from 'components/layout/SideBar'
    import NavBar from 'components/layout/NavBar'
    import FooterBar from 'components/layout/FooterBar'
    import AppMain from 'components/layout/AppMain'
    import NprogressContainer from 'vue-nprogress/src/NprogressContainer'

    export default{
        components: {
            SideBar, NavBar, FooterBar, AppMain,
            NprogressContainer,
        },
        mounted(){
            this.getPerms()
        },
        methods:{
            getPerms(){
                this.$store.dispatch('initPerms')

            }
        },
    }
</script>