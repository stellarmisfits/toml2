// import axios from 'axios'

export const state = {
  orgs: [
    {
      uuid: 'd5a678a3-cb17-4e05-9345-6753d143decf',
      name: 'Lotto\' Gelato',
      slug: 'lotto-gelato',
      published: true
    },
    {
      uuid: '4130ff6c-c4d9-405b-b08d-240a29c9a302',
      name: 'Tunnel Tusk, Ltd',
      slug: 'tunnel-tusk',
      published: false
    }
  ]
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
