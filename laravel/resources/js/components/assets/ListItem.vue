<template>
  <a-well>
    <router-link
      :to="{ name: 'asset.details', params: { uuid: asset.uuid }}"
      class="flex justify-between items-center px-6 py-6 hover:bg-gray-100 cursor-pointer"
    >
      <div class="flex-grow">
        <div class="flex justify-between items-center">
          <div class="flex items-center">
            <span>{{ asset.name }}</span>
          </div>
        </div>
        <div class="flex justify-between items-baseline mt-1">
          <span class="text-xs text-gray-600">
            <span class="inline-flex items-center">
              <span>{{ asset.code }}</span>
            </span>
          </span>
        </div>
        <div class="flex justify-between items-baseline mt-1">
          <div class="flex items-center spaced-x-1">
            <a-pill color="red">
              {{ (asset.verified) ? 'Verified' : 'Not Verified' }}
            </a-pill>
          </div>
        </div>
      </div>
      <unlink
        v-if="linked"
        :resource="asset"
        resource-type="ASSET"
      />
      <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-600 fill-current ml-4">
        <path d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z" />
      </svg>
    </router-link>
  </a-well>
</template>
<script>
import Unlink from '~/components/orgs/Unlink'
export default {
  components: {
    Unlink
  },
  props: {
    asset: { type: Object, required: true },
    linked: { type: Boolean, default: false }
  },
  data: () => ({
    //
  })
}
</script>
