<template>
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <span class="logo-mini">ZWF</span>
            <span class="logo-lg"><b>ZWForum</b></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img :src="portraitsUrl+ userPortraitMin" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ user.name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img :src="portraitsUrl+ userPortraitMid" class="img-circle" alt="User Image">
                                <p>
                                    {{ user.name }}
                                    <small>{{ user.description }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a :href="domain" class="btn btn-default btn-flat">返回前台</a>
                                </div>
                                <div class="pull-right">
                                    <form id="logoutForm" method="post" :action="domain + 'logout'">
                                        <input type="hidden" name="_token" :value="token">
                                        <input type="submit" class="btn btn-default btn-flat" value="退出" />
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>
<style>

</style>
<script>

    export default {
        data () {
            return {
                token:'',
                domain:'',
                portraitsUrl:'',
                user: {}
            }
        },
        mounted() {
            this.portraitsUrl = window.PortraitsUrl
            this.user = window.User
            this.domain = window.Domain
            this.token = window.Laravel.csrfToken
        },
        computed:{
            userPortraitMin(){
                if(!this.user.portrait_min)
                    return 'profile-pic_min.png'
                else
                    return this.user.portrait_min
            },
            userPortraitMid(){
                if(!this.user.portrait_mid)
                    return 'profile-pic_mid.png'
                else
                    return this.user.portrait_mid
            }
        }

    }
</script>
