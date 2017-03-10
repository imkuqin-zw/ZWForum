
const state = {
  permissions: {}
}

const mutations = {
  setPerms(state,payload){
    state.permissions = payload.perms
  }
}

const actions = {
    initPerms(context){
      axios.get(window.Domain + 'api/admin/user/perms')
        .then(response => {
          context.commit("setPerms",{perms: response.data});
        })
    }
}

export default {
  state,
  mutations,
  actions
}
