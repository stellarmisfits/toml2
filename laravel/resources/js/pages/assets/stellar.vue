<template>
  <div>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Stellar Details for Asset
          </h2>
        </div>
        <div class="flex-shrink-0 ml-4">
          <span>edit button</span>
        </div>
      </div>
      <div class="mt-4">
        <asset :asset="asset" />
      </div>
    </div>
    <div class="px-12 py-8 mx-auto max-w-4xl">
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
import OrganizationList from '~/components/orgs/List'

export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    Asset
  },

  props: {
    asset: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Asset Network' }
  },

  data: () => ({
    //
  }),

  methods: {
    //
  }
}
</script>
