import axios from 'axios'

export const state = {
  assets: []
}

// getters
export const getters = {
  getAssetByUuid: (state) => (uuid) => {
    return state.assets.find(asset => asset.uuid === uuid)
  },
  getAssetBySlug: (state) => (slug) => {
    return state.assets.find(asset => asset.slug === slug)
  },
  assets: state => (state.assets.length) ? state.assets : null
}

// actions
export const actions = {
  async fetchAssets ({ commit }) {
    const { data } = await axios.get('/api/assets')
    commit('SET_ASSETS', { assets: data.data })
  },

  async fetchAsset ({ commit, getters }, options) {
    let asset = getters.getAssetByUuid(options.uuid)

    if (!asset || options.force) {
      const { data } = await axios.get('/api/assets/' + options.uuid)
      commit('SET_ASSET', { asset: data.data })
    }
  }
}

// mutations
export const mutations = {
  SET_ASSETS (state, { assets }) {
    state.assets = assets
  },
  SET_ASSET (state, { asset }) {
    state.assets = [
      ...state.assets.filter(element => element.uuid !== asset.uuid),
      asset
    ]
  }
}
