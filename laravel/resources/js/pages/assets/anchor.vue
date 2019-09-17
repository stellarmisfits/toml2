<template>
  <div class="px-12 py-8 mx-auto">
    <div class="flex items-baseline justify-between">
      <div>
        <h2 class="text-lg">
          Asset Anchor
        </h2>
        <div class="mt-1 text-sm text-gray-700">
          <div class="max-w-2xl">
            If this asset is an anchor for another asset you can define it here.
          </div>
        </div>
      </div>
      <div class="flex-shrink-0 ml-4">
        <span>anchor toggle</span>
      </div>
    </div>
    <div class="mt-4">
      <asset-anchor :asset="asset" />
    </div>
  </div>
</template>

<script>
import AssetAnchor from '~/components/assets/Anchor'

export default {
  middleware: 'auth',

  components: {
    AssetAnchor
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
