import lazyLoading from './lazyLoading'

export default {
  //name:'users',
  meta: {
    perm: 'user',
    label: '用户管理',
    icon: 'fa-user'
  },

  children: [
    {
      meta: {
        perm: 'list-user',
        label: '用户列表',
      },
      path: '/user/list',
      component: lazyLoading('users/List'),
    },
    {
      hide: true,
      meta: {
        perm: 'edit-user',
        label: '编辑用户',
      },
      path: '/user/:userId/edit',
      component: lazyLoading('users/Edit'),
    },
    {
      meta: {
        perm: 'create-user',
        label: '创建用户',
      },
      //name: '',
      path: '/user/add',
      component: lazyLoading('users/Add')
    },
  ]
}