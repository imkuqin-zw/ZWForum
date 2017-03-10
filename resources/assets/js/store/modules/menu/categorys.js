import lazyLoading from './lazyLoading'

export default {
  //name:'users',
  meta: {
    perm: 'cate',
    label: '分类管理',
    icon: 'fa-folder'
  },

  children: [
    {
      meta: {
        perm: 'list-cate',
        label: '分类列表',
      },
      path: '/cate/list',
      component: lazyLoading('categorys/List'),
    },
    {
      hide: true,
      meta: {
        perm: 'edit-cate',
        label: '编辑分类',
      },
      path: '/cate/:cateId/edit',
      component: lazyLoading('categorys/Edit'),
    },
    {
      meta: {
        perm: 'create-cate',
        label: '创建分类',
      },
      //name: '',
      path: '/cate/add',
      component: lazyLoading('categorys/Add')
    },
  ]
}