import axios from 'axios'

export const state = {
  validators: []
}

// getters
export const getters = {
  getValidatorByUuid: (state) => (uuid) => {
    return state.validators.find(validator => validator.uuid === uuid)
  },
  validators: state => (state.validators.length) ? state.validators : null
}

// actions
export const actions = {
  async fetchValidators ({ commit }) {
    const { data } = await axios.get('/api/validators')
    commit('SET_VALIDATORS', { validators: data.data })
  },

  async fetchValidator ({ commit, getters }, uuid) {
    let validator = getters.getValidatorByUuid(uuid)

    if (!validator) {
      const { data } = await axios.get('/api/validators/' + uuid)
      commit('SET_VALIDATOR', { validator: data.data })
    }
  }
}

// mutations
export const mutations = {
  SET_VALIDATORS (state, { validators }) {
    state.validators = validators
  },
  SET_VALIDATOR (state, { validator }) {
    state.validators.push(validator)
  }
}
