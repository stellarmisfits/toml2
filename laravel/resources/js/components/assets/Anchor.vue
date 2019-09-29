<template>
  <div v-if="asset.anchored">
    <div class="flex -mx-4">
      <div class="w-1/3 px-2">
        <h3 class="text-md font-semibold">
          Anchor Details
        </h3>
        <div class="mt-4 text-sm text-gray-800">
          Assets can be anchored to fiat, crypto, stock, bond, commodity,
          realestate, or other.
        </div>
        <div class="mt-4 text-sm text-gray-800">
          The anchor should be given a descriptor E.g. USD, BTC,
          SBUX, or address of real-estate investment property.
        </div>
        <div class="mt-4 text-sm text-gray-800">
          Finally define the redemption instructions the asset holder will need
          to follow to redeem the asset for it's anchor.
        </div>
      </div>
      <div class="w-2/3 px-2">
        <div class="px-6 py-4 bg-white rounded-lg shadow-md overflow-hidden">
          <form class="spaced-y-4" @submit.prevent="update" @keydown="form.onKeydown($event)">
            <!-- anchor_asset_type -->
            <label class="block">
              <span class="form-label">Anchor Asset Type</span>
              <select
                v-model="form.anchor_asset_type"
                class="form-select"
                name="account_uuid"
              >
                <option :value="null">NONE</option>
                <option value="fiat">fiat</option>
                <option value="crypto">crypto</option>
                <option value="stock">stock</option>
                <option value="bond">bond</option>
                <option value="commodity">commodity</option>
                <option value="realestate">realestate</option>
                <option value="other">other</option>
              </select>
            </label>

            <!-- anchor_asset -->
            <label class="block">
              <span class="form-label">Anchor Asset Descriptor</span>
              <input v-model="form.anchor_asset" class="form-input">
            </label>

            <!-- redemption_instructions -->
            <label class="block">
              <span class="form-label">Redemption Instructions</span>
              <textarea v-model="form.redemption_instructions" rows="3" class="form-textarea" :class="{ 'is-invalid': form.errors.has('redemption_instructions') }" />
              <has-error :form="form" field="redemption_instructions" />
            </label>

            <!-- Save Button -->
            <div class="text-right">
              <a-button
                :loading="form.busy"
                type="white"
                class="btn-white"
              >
                Save
              </a-button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <hr class="my-10 border-b">

    <div class="flex -mx-4">
      <div class="w-1/3 px-2">
        <h3 class="text-md font-semibold">
          Collateral Details
        </h3>
        <div class="mt-4 text-sm text-gray-800">
          If this is an anchored crypto token, list of one or more public addresses
          that hold the assets for which you are issuing tokens.
        </div>
        <div class="mt-4 text-sm text-gray-800">
          For each address you list, add a message stating the addresses are
          reserved to back the issued asset, sign each message using the
          address's private key, and add the resulting string
          to this list as a base64-encoded raw signature.
        </div>
      </div>
      <div class="w-2/3 px-2">
        <div class="px-6 py-4 bg-white rounded-lg shadow-md overflow-hidden">
          <form class="spaced-y-4" @submit.prevent="update" @keydown="form.onKeydown($event)">
            <!-- collateral_addresses -->
            <label class="block">
              <span class="form-label">Collateral Addresses</span>
              <textarea v-model="form.collateral_addresses" class="form-textarea" rows="3" />
            </label>

            <!-- collateral_address_messages -->
            <label class="block">
              <span class="form-label">Collateral Address Messages</span>
              <textarea v-model="form.collateral_address_messages" class="form-textarea" rows="3" />
            </label>

            <!-- collateral_address_signatures -->
            <label class="block">
              <span class="form-label">Collateral Address Signatures</span>
              <textarea v-model="form.collateral_address_signatures" class="form-textarea" rows="3" />
            </label>

            <!-- Save Button -->
            <div class="text-right">
              <a-button
                :loading="form.busy"
                type="white"
                class="btn-white"
              >
                Save
              </a-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <a-well v-else class="p-6">
    This asset is not regulated.
  </a-well>
</template>
<script>
import Form from 'vform'
export default {
  props: {
    asset: { type: Object, required: true }
  },
  data: () => ({
    form: new Form({
      anchor_asset_type: null,
      anchor_asset: null,
      redemption_instructions: null,
      collateral_addresses: null,
      collateral_address_messages: null,
      collateral_address_signatures: null
    })
  }),
  created () {
    this.form.anchor_asset_type = this.asset.anchor_asset_type
    this.form.anchor_asset = this.asset.anchor_asset
    this.form.redemption_instructions = this.asset.redemption_instructions
    this.form.collateral_addresses = this.asset.collateral_addresses
    this.form.collateral_address_messages = this.asset.collateral_address_messages
    this.form.collateral_address_signatures = this.asset.collateral_address_signatures
  },
  methods: {
    async update () {
      try {
        const { data } = await this.form.patch('/api/assets/' + this.$route.params.uuid + '/anchor')
        this.$store.commit('asset/SET_ASSET', { asset: data.data })
      } catch (e) {
        throw e
      }
    }
  }
}
</script>
