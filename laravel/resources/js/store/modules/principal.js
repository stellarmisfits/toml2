// import axios from 'axios'

export const state = {
  principals: [
    {
      uuid: '4130ff6c-c4d9-405b-b08d-240a29c4a302',
      name: 'Ben Bjurstrom',
      email: 'ben@example.com',
      keybase: 'benbjurstrom',
      telegram: 'benbjurstrom',
      twitter: 'benbjurstrom',
      github: 'benbjurstrom',
      idPhotoHash: '9E282BB800BDE560D935FDEF37A6F309C89CD85D7AF9DF26B234FBD62CCF50A1',
      verificationPhotoHash: '2300098D14932AA17F358B325FF950E2DF0BBF9D478E24CF62A4ED00CAC5F98B'
    }
  ]
}

// getters
export const getters = {
  getPrincipalByUuid: (state) => (uuid) => {
    return state.principals.find(principal => principal.uuid === uuid)
  },
  principals: state => (state.principals.length) ? state.principals : null
}
