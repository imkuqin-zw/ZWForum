<template>
    <section class="content animated">
        <div class="box box-primary">
            <div class="box-body box-profile ">
                <div class="col-xs-12 col-md-2">
                    <img class="profile-user-img img-responsive img-circle" :src="portraitsUrl+ userPortrait" alt="User profile picture">
                </div>
                <div style="margin-top: 5px" class="col-xs-12 col-md-10">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 用户名 </div>
                            <div class="profile-info-value">
                                <span  >{{user.name}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 本次登陆时间 </div>
                            <div class="profile-info-value">
                                <span  >{{time}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name">角色 </div>
                            <div class="profile-info-value">
                                <template v-for="role in roles">
                                <span class="label label-info">{{role.display_name}}</span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style>
</style>
<script>
  export default{
    data(){
      return {
        time:'',
        roles:[],
        portraitsUrl:'',
        user:{}
      }
    },
    mounted() {
      this.portraitsUrl = window.PortraitsUrl
      this.user = window.User
      this.roles = window.Roles
      this.time = window.Time
    },
    computed: {
      userPortrait(){
        if (!this.user.portrait_mid)
          return 'profile-pic_min.png'
        else
          return this.user.portrait_mid
      },
    }
  }
</script>
<style lang="scss">
    .profile-picture {
        border: 1px solid #CCC;
        background-color: #FFF;
        padding: 4px;
        display: inline-block;
        max-width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        box-shadow: 1px 1px 1px rgba(0,0,0,.15);
    }
    .img-responsive{
        display: block;
        max-width: 100%;
        height: auto;
    }
    .profile-info-name {
        text-align: right;
        padding: 6px 10px 6px 4px;
        font-weight: 400;
        color: #667E99;
        background-color: transparent;
        width: 110px;
        vertical-align: middle;
    }
    .profile-info-value {
        padding: 6px 4px 6px 6px;
    }
    .profile-info-name, .profile-info-value {
        display: table-cell;
        border-top: 1px dotted #D5E4F1;
    }
    .profile-user-info-striped {
        border: 1px solid #DCEBF7;
        .profile-info-value {
            border-top: 1px dotted #DCEBF7;
            padding-left: 12px;
        }
        .profile-info-name {
            color: #336199;
            background-color: #EDF3F4;
            border-top: 1px solid #F7FBFF;
        }
    }
    .profile-user-info {
        display: table;
        width: 98%;
        width: calc(100% - 24px);
        margin: 0 auto;
    }
    .profile-info-row {
        display: table-row;
        &:first-child .profile-info-name{
            border-top: none;
        }

    }

</style>
