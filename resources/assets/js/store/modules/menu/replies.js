import lazyLoading from './lazyLoading'

export default {
  //name:'users',
  meta: {
    perm: 'reply',
    label: '评论管理',
    icon: 'fa-commenting'
  },

  children: [
    {
      meta: {
        perm: 'list-reply',
        label: '评论列表',
      },
      path: '/reply/list',
      component: lazyLoading('replies/List'),
    },
    {
      hide: true,
      meta: {
        perm: 'show-reply',
        label: '显示评论',
      },
      path: '/reply/:replyId/show',
      component: lazyLoading('replies/Show'),
    },
  ]
}