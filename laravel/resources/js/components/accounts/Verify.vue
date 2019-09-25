<template>
  <div>
    <div v-if="!account.verified && organization">
      <div>
        To verify this account you must first set the account's home domain to
        the organization's url listed below. Once you've submitted the update to
        the stellar network click verify so astrify can confirm the change.
      </div>
      <div class="mt-4">
        <pre class="text-sm bg-gray-800 text-white p-2 rounded">{{ organization.url }}</pre>
      </div>
      <div class="mt-4 -mx-2 flex justify-end">
        <a class="block w-1/3 px-2" :href="url" target="_blank">
          <a-button class="w-full" type="white">build transaction</a-button>
        </a>
        <a-button class="block w-1/3 px-2">
          verify
        </a-button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    account: { type: Object, required: true },
    organization: { type: Object, default: null }
  },
  data: () => ({
    modal: false
  }),

  computed: {
    eligibilityMessage () {
      if (!this.organization) {
        return 'To verify this account you must first link it to an organization.'
      }

      return 'test'
    },

    url () {
      return 'https://www.stellar.org/laboratory/#txbuilder?params=' + this.labParamsBase64 + '&network=test'
    },

    labParams () {
      const homeDomain = (this.organization) ? this.organization.url : null
      return {
        'attributes': {
          'sourceAccount': this.account.public_key,
          'sequence': null,
          'fee': '100'
        },
        'operations': [
          {
            'id': 0,
            'attributes': {
              'homeDomain': homeDomain
            },
            'name': 'setOptions'
          }
        ]
      }
    },

    labParamsBase64 () {
      if (!this.labParams) return null

      const dataJsonStr = JSON.stringify(this.labParams)
      return Buffer.from(dataJsonStr).toString('base64')
    }
  },

  created () {
    //
  },

  methods: {
    //
  }
}
</script>
