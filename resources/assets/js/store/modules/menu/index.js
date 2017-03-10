import lazyLoading from './lazyLoading'
import users from './users'
import permisions from './permisions'
import categorys from './categorys'
import tags from './tags'
import topics from './topics'
import replies from './replies'

const state = {
  items: [
    {
      name: 'home',
      path: '/',
      meta: {
        label: '后台首页',
        icon: 'fa-home'
      },
      component: lazyLoading('home', true)
    },
    users,
    permisions,
    categorys,
    tags,
    topics,
    replies,
  ]
}

export default {
  state
}