<template>
  <div class="px-12 py-8 mx-auto">
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
        <span>regulated toggle</span>
      </div>
    </div>
    <div class="mt-4">
      <asset-regulated :asset="asset" />
    </div>
  </div>
</template>

<script>
import AssetRegulated from '~/components/assets/Regulated'

export default {
  middleware: 'auth',

  components: {
    AssetRegulated
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
