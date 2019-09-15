import axios from 'axios'

export const state = {
  principals: []
}

// getters
export const getters = {
  getPrincipalByUuid: (state) => (uuid) => {
    return state.principals.find(principal => principal.uuid === uuid)
  },
  principals: state => (state.principals.length) ? state.principals : null
}

// actions
export const actions = {
  async fetchPrincipals ({ commit }) {
    const { data } = await axios.get('/api/principals')
    commit('SET_PRINCIPALS', { principals: data.data })
  },

  async fetchPrincipal ({ commit, getters }, uuid) {
    let principal = getters.getPrincipalByUuid(uuid)

    if (!principal) {
      const { data } = await axios.get('/api/principals/' + uuid)
      commit('SET_PRINCIPAL', { principal: data.data })
    }
  }
}

// mutations
export const mutations = {
  SET_PRINCIPALS (state, { principals }) {
    state.principals = principals
  },
  SET_PRINCIPAL (state, { principal }) {
    state.principals.push(principal)
  }
}
