import axios from 'axios'

export const state = {
  accounts: []
}

// getters
export const getters = {
  getAccountByUuid: (state) => (uuid) => {
    return state.accounts.find(account => account.uuid === uuid)
  },
  getAccountBySlug: (state) => (slug) => {
    return state.accounts.find(account => account.slug === slug)
  },
  accounts: state => (state.accounts.length) ? state.accounts : null
}

// actions
export const actions = {
  async fetchAccounts ({ commit }) {
    const { data } = await axios.get('/api/accounts')
    commit('SET_ACCOUNTS', { accounts: data.data })
  },

  async fetchAccount ({ commit, getters }, uuid) {
    let account = getters.getAccountByUuid(uuid)

    if (!account) {
      const { data } = await axios.get('/api/accounts/' + uuid)
      commit('SET_ACCOUNT', { account: data.data })
    }
  }
}

// mutations
export const mutations = {
  SET_ACCOUNTS (state, { accounts }) {
    state.accounts = accounts
  },
  SET_ACCOUNT (state, { account }) {
    state.accounts.push(account)
  }
}
