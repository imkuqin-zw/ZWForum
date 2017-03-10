import lazyLoading from './lazyLoading'

export default {
  //name:'users',
  meta: {
    perm: 'tag',
    label: '标签管理',
    icon: 'fa-tag'
  },

  children: [
    {
      meta: {
        perm: 'list-tag',
        label: '标签列表',
      },
      path: '/tag/list',
      component: lazyLoading('tags/List'),
    },
    {
      hide: true,
      meta: {
        perm: 'edit-tag',
        label: '编辑标签',
      },
      path: '/tag/:tagId/edit',
      component: lazyLoading('tags/Edit'),
    },
    {
      meta: {
        perm: 'create-tag',
        label: '创建标签',
      },
      path: '/tag/add',
      component: lazyLoading('tags/Add')
    },
  ]
}