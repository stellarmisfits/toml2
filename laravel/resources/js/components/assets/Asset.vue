<template>
  <a-list-item
    :image-url="asset.image"
    :image-title="asset.name"
    :action="action"
  >
    <dropdown v-if="action==='edit'" slot="imageAction">
      <div slot="link" class="fill-current h-6 w-6 z-10 absolute right-0 mr-4 mt-2">
        <fa icon="ellipsis-h" />
      </div>
      <template v-slot:dropdown="dropdownProps">
        <div class="py-2 w-32">
          <image-add :asset="asset" @close="dropdownProps.closeDropdown" />
          <image-remove v-if="asset.image" :asset="asset" @close="dropdownProps.closeDropdown" />
        </div>
      </template>
    </dropdown>
    <div slot="body">
      <div class="flex items-center spaced-x-1">
        <h4 class="font-semibold text-lg leading-tight truncate">
          {{ asset.name }}
        </h4>
        <a-pill class="ml-2" color="blue">
          {{ asset.status }}
        </a-pill>
      </div>
      <div class="mt-1">
        {{ asset.code }}
      </div>
      <div class="mt-2">
        {{ asset.desc }}
      </div>
    </div>
    <div slot="action">
      <unlink v-if="action==='unlink'" resource-type="ASSET" :resource="asset" />
      <fa v-if="action==='edit'" icon="edit" />
      <router-link
        v-if="action==='navigate'"
        :to="{ name: 'asset.details', params: { uuid: asset.uuid }}"
      >
        <fa icon="chevron-circle-right" class="hover:text-gray-400 cursor-pointer" />
      </router-link>
    </div>
    <div v-if="action==='edit'" slot="details">
      <div class="mt-2">
        {{ asset.code_template }}
      </div>
      <div class="mt-2">
        {{ asset.conditions }}
      </div>
    </div>
  </a-list-item>
</template>
<script>
import Unlink from '~/components/orgs/Unlink'
import ImageAdd from '~/components/assets/ImageAdd'
import ImageRemove from '~/components/assets/ImageRemove'
export default {
  components: {
    Unlink,
    ImageAdd,
    ImageRemove
  },
  props: {
    asset: { type: Object, required: true },
    action: { type: String, default: null }
  },
  data: () => ({
    //
  })
}
</script>
