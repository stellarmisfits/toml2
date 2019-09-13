import axios from 'axios'

export const state = {
  orgs: [],
  toml: null
}

// getters
export const getters = {
  getOrgByUuid: (state) => (uuid) => {
    return state.orgs.find(org => org.uuid === uuid)
  },
  getOrgBySlug: (state) => (slug) => {
    return state.orgs.find(org => org.slug === slug)
  },
  orgs: state => (state.orgs.length) ? state.orgs : null
}

// actions
export const actions = {
  async fetchOrgs ({ commit }) {
    const { data } = await axios.get('/api/organizations')
    commit('SET_ORGS', { orgs: data.data })
  },

  async fetchOrg ({ commit, getters }, uuid) {
    let org = getters.getOrgByUuid(uuid)

    if (!org) {
      const { data } = await axios.get('/api/organizations/' + uuid)
      commit('SET_ORG', { org: data.data })
    }
  },

  async fetchToml ({ commit }, org) {
    const { data } = await axios.get('/api/organizations/' + org.uuid + '/toml')
    commit('SET_TOML', { toml: data.toml })
  }
}

// mutations
export const mutations = {
  SET_ORGS (state, { orgs }) {
    state.orgs = orgs
  },
  SET_ORG (state, { org }) {
    state.orgs.push(org)
  },
  SET_TOML (state, { toml }) {
    state.toml = toml
  }
}
