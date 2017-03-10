<template>
    <aside class="main-sidebar">
        <section class="sidebar">
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <!--<li class="header">ZWForum</li>-->
                <li class="treeview" v-for="(item, index) in menu" >
                    <router-link :to="item.path" v-if="item.path" >
                        <i :class="['fa', item.meta.icon]"></i>
                        <span>{{ item.meta.label || item.name }}</span>
                    </router-link>

                    <template v-else-if="hasPerm(item.meta.perm)">
                    <a>
                        <i :class="['fa', item.meta.icon]"></i>
                        <span>{{ item.meta.label || item.name }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul v-if="item.children && item.children.length" class="treeview-menu" style="display: none;">
                        <li v-for="subItem in item.children" v-if="subItem.path && isMenuShow(subItem) ">
                            <template v-if="canPerm(item.meta.perm,subItem.meta.perm)" >
                            <router-link :to="generatePath(item, subItem)">
                                <i class="fa fa-circle-o"></i>
                                {{ subItem.meta && subItem.meta.label || subItem.name }}
                            </router-link>
                            </template>
                        </li>
                    </ul>
                    </template>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
    </aside>
</template>
<style>
</style>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  computed:{
    ...mapGetters({
      menu: 'menuitems'
    }),
  },
  methods:{
    generatePath (item, subItem) {
      return `${item.component ? item.path + '/' : ''}${subItem.path}`
    },
    isMenuShow(item){
      if('hide' in item && item.hide )
        return false;
      else
        return true;
    },
    hasPerm(key){
      return this.$store.state.app.permissions.hasOwnProperty(key)
    },
    canPerm(key,value){
      return this.$store.state.app.permissions[key].indexOf(value) != -1
    }
  },
}
</script>
