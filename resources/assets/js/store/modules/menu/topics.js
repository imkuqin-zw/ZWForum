import lazyLoading from './lazyLoading'

export default {
  //name:'users',
  meta: {
    perm: 'topic',
    label: '话题管理',
    icon: 'fa-book'
  },

  children: [
    {
      meta: {
        perm: 'list-topic',
        label: '话题列表',
      },
      path: '/topic/list',
      component: lazyLoading('topics/List'),
    },
    {
      hide: true,
      meta: {
        perm: 'edit-topic',
        label: '编辑话题',
      },
      path: '/topic/:topicId/edit',
      component: lazyLoading('topics/Edit'),
    }
  ]
}