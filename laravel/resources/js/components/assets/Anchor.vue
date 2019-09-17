<template>
  <a-well>
    <div class="bg-white text-sm">
      <div v-if="asset.is_asset_anchored">
        <!-- redemption_instructions -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Redemption Instructions</span><br>
            <div class="text-gray-600 ml-2">These are instructions to redeem the underlying asset from tokens.</div>
            <textarea v-model="asset.redemption_instructions" class="form-textarea font-mono text-sm mt-2 block w-full" rows="3" placeholder="..." />
          </label>
        </div>

        <!-- anchor_asset_type -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Anchor Asset Type</span><br>
            <div class="text-gray-600 ml-2">Type of asset anchored. Can be fiat, crypto, stock, bond, commodity, realestate, or other.</div>
            <select
              v-model="asset.anchor_asset_type"
              class="form-select mt-2 text-sm font-mono"
              name="account_uuid"
            >
              <option :value="null">NONE</option>
              <option :value="null">fiat</option>
              <option :value="null">crypto</option>
              <option :value="null">stock</option>
              <option :value="null">bond</option>
              <option :value="null">commodity</option>
              <option :value="null">realestate</option>
              <option :value="null">other</option>
            </select>
          </label>
        </div>

        <!-- anchor_asset -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Anchor Asset Descriptor</span><br>
            <span class="text-gray-600 ml-2 block">Code or symbol for asset that token is anchored to. E.g. USD, BTC, SBUX, Address of real-estate investment property.</span>
            <input v-model="asset.anchor_asset" class="form-textarea font-mono text-sm mt-2 block w-full" placeholder="...">
          </label>
        </div>

        <!-- collateral_addresses -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Collateral Addresses</span><br>
            <div class="text-gray-600 ml-2">If this is an anchored crypto token, list of one or more public addresses that hold the assets for which you are issuing tokens.</div>
            <textarea v-model="asset.collateral_addresses" class="form-textarea font-mono text-sm mt-2 block w-full" rows="3" placeholder="..." />
          </label>
        </div>

        <!-- collateral_address_messages -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Collateral Address Messages</span><br>
            <div class="text-gray-600 ml-2">Messages stating that funds in the collateral_addresses list are reserved to back the issued asset.</div>
            <textarea v-model="asset.collateral_address_messages" class="form-textarea font-mono text-sm mt-2 block w-full" rows="3" placeholder="..." />
          </label>
        </div>

        <!-- collateral_address_signatures -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Collateral Address Signatures</span><br>
            <div class="text-gray-600 ml-2">These prove you control the collateral_addresses. For each
              address you list, sign the entry in collateral_address_messages
              with the address's private key and add the resulting string
              to this list as a base64-encoded raw signature.
            </div>
            <textarea v-model="asset.collateral_address_signatures" class="form-textarea font-mono text-sm mt-2 block w-full" rows="3" placeholder="..." />
          </label>
        </div>
      </div>
      <div v-else>
        This asset is un-anchored.
      </div>
    </div>
  </a-well>
</template>
<script>
export default {
  props: {
    asset: { type: Object, required: true }
  },
  data: () => ({
    //
  })
}
</script>
