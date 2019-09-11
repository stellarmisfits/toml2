// import axios from 'axios'

export const state = {
  validators: [
    {
      uuid: '4130ff6c-c4d9-405b-b08d-240a29c4a302',
      alias: 'domain-us',
      displayName: 'Domain United States',
      host: 'core-us.domain.com:11625',
      publicKey: 'GA6MOVBKZSOGJ47PHWOLUSN46D6ODSZ7PQJ7NMHRRIS5Z7LP5L7ZZWL6',
      history: 'http://history.domain.com/prd/core-live/core_live_003/'
    }
  ]
}

// getters
export const getters = {
  getValidatorByUuid: (state) => (uuid) => {
    return state.validators.find(validator => validator.uuid === uuid)
  },
  validators: state => (state.validators.length) ? state.validators : null
}
