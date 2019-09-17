<template>
  <div>
    <div class="px-12 py-8 mx-auto">
      <div class="mt-4">
        <asset :asset="asset" action="edit" />
      </div>
    </div>
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Asset Metrics
          </h2>
        </div>
        <div class="flex-shrink-0 ml-4">
          <span>edit button</span>
        </div>
      </div>
      <div class="mt-4">
        <asset-metrics :asset="asset" />
      </div>
    </div>
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              This asset is tied to the following organizations
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          Add to org
        </div>
      </div>
      <div class="mt-4">
        <OrganizationList />
      </div>
    </div>
  </div>
</template>

<script>
import Asset from '~/components/assets/Asset'
import AssetMetrics from '~/components/assets/Metrics'
import OrganizationList from '~/components/orgs/List'

export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    Asset,
    AssetMetrics
  },

  props: {
    asset: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Asset Details' }
  },

  data: () => ({
    //
  }),

  methods: {
    //
  }
}
</script>
