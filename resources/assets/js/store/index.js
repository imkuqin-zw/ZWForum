import Vue from 'vue'
import Vuex from 'vuex'
import menu from './modules/menu'
import app from './modules/app'
import * as getters from './getters'

Vue.use(Vuex)

const store = new Vuex.Store({
  strict: true,  // process.env.NODE_ENV !== 'development',
  getters,
  modules: {
    menu,
    app
  },
  state: {
    //pkg
  },
  mutations: {
  }
})

export default store