import lazyLoading from './lazyLoading'

export default {
  //name: '权限管理',
  //path: '#',
  meta: {
    perm: 'role',
    label: '权限管理',
    icon: 'fa-lock',
    expanded: false
  },

  children: [
    {
      // name: '角色列表',
      meta: {
        perm: 'list-role',
        label: '角色列表',
      },
      path: '/role/list',
      component: lazyLoading('permisions/List')
    },
    {
      hide: true,
      meta: {
        perm: 'edit-role',
        label: '编辑角色',
      },
      path: '/role/:roleId/edit',
      component: lazyLoading('permisions/Edit'),
    },
    {
      meta: {
        perm: 'create-role',
        label: '创建角色',
      },
      //name: '',
      path: '/role/add',
      component: lazyLoading('permisions/Add')
    },
  ]
}
