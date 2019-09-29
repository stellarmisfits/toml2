<template>
  <div class="py-8 mx-auto">
    <div class="flex items-baseline justify-between">
      <div>
        <h2 class="text-lg">
          Asset Regulated
        </h2>
        <div class="mt-1 text-sm text-gray-700">
          <div class="max-w-2xl">
            Indicates whether or not this is a sep0008 regulated asset. If missing, false is assumed.
          </div>
        </div>
      </div>
      <div class="flex-shrink-0 ml-4">
        <regulated-switch
          :key="asset.uuid + asset.regulated"
          :asset="asset"
        />
      </div>
    </div>
    <div class="mt-4">
      <asset-regulated :asset="asset" />
    </div>
  </div>
</template>

<script>
import AssetRegulated from '~/components/assets/Regulated'
import RegulatedSwitch from '~/components/assets/RegulatedSwitch'

export default {
  middleware: 'auth',

  components: {
    AssetRegulated,
    RegulatedSwitch
  },

  props: {
    asset: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Asset Anchor' }
  },

  data: () => ({
    //
  }),

  methods: {
    //
  }
}
</script>
