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
      <div slot="dropdown" class="py-2 w-32">
        <router-link :to="{ name: 'settings.profile' }" class="dropdown-item">
          <fa class="mr-2" icon="cog" />Update
        </router-link>
        <a href="#" class="dropdown-item" @click.prevent="logout">
          <fa class="mr-2" icon="sign-out-alt" />Remove
        </a>
      </div>
    </dropdown>
    <div slot="body">
      <h4 class="font-semibold text-lg leading-tight truncate">
        {{ asset.name }}
      </h4>
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
        {{ asset.status }}
      </div>
      <div class="mt-2">
        {{ asset.conditions }}
      </div>
    </div>
  </a-list-item>
</template>
<script>
import Unlink from '~/components/orgs/Unlink'
export default {
  components: {
    Unlink
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
