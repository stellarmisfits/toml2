// import axios from 'axios'

export const state = {
  accounts: [
    {
      uuid: '2130ff6c-c4d9-405b-b08d-240a29c4a302',
      publicKey: 'GA6MOVBKZSOGJ47PHWOLUSN46D6ODSZ7PQJ7NMHRRIS5Z7LP5L7ZZWL6',
      organizationUuid: 'd5a678a3-cb17-4e05-9345-6753d143decf',
      slug: 'example-account',
      verified: true
    }
  ]
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
