<template>
  <a-list-item
    :image-url="org.logo"
    :image-title="org.name"
    :action="action"
  >
    <dropdown v-if="action==='edit'" slot="imageAction">
      <div slot="link" class="fill-current h-6 w-6 z-10 absolute right-0 mr-4 mt-2 text-white">
        <fa class="bg-gray-500 rounded-full" icon="chevron-circle-down" />
      </div>
      <template v-slot:dropdown="dropdownProps">
        <div class="py-2 w-32">
          <image-add model-type="organization" :model-uuid="org.uuid" @close="dropdownProps.closeDropdown" />
          <image-remove v-if="org.logo" model-type="organization" :model-uuid="org.uuid" @close="dropdownProps.closeDropdown" />
        </div>
      </template>
    </dropdown>
    <div slot="body">
      <div class="flex items-center spaced-x-1">
        <h4 class="font-semibold text-lg leading-tight truncate">
          {{ org.name }}
        </h4>
        <a-pill class="ml-2" color="blue">
          <span>{{ (org.published) ? 'Published' : 'Not Published' }}</span>
        </a-pill>
      </div>
      <div class="mt-1">
        {{ org.alias }}
      </div>
    </div>
    <div slot="action">
      <unlink
        v-if="action==='unlink'"
        :resource-type="resourceOwnerType"
        :resource-uuid="resourceOwnerUuid"
        :org="org"
        @organizationUnlinked="$emit('organizationUnlinked', $event)"
      />
      <edit-organization
        v-if="action==='edit'"
        :organization="org"
        action="update"
      />
      <router-link
        v-if="action==='navigate'"
        :to="{ name: 'org.details', params: { uuid: org.uuid }}"
      >
        <fa icon="chevron-circle-right" class="hover:text-gray-400 cursor-pointer" />
      </router-link>
    </div>
    <div v-if="action==='edit'" slot="details">
      <div class="mt-2">
        {{ org.description }}
      </div>
      <div class="mt-2">
        {{ org.url }}
      </div>
      <div class="mt-2">
        {{ org.dba }}
      </div>
    </div>
  </a-list-item>
</template>
<script>
import EditOrganization from '~/components/orgs/Upsert'
import Unlink from '~/components/orgs/OrganizationUnlink'
import ImageAdd from '~/components/ImageAdd'
import ImageRemove from '~/components/ImageRemove'
export default {
  components: {
    Unlink,
    EditOrganization,
    ImageAdd,
    ImageRemove
  },
  props: {
    org: { type: Object, required: true },
    action: {
      type: String,
      required: true,
      validator: (val) => ['edit', 'unlink', 'navigate'].includes(val)
    },
    resourceOwnerUuid: { type: String, default: '' },
    resourceOwnerType: { type: String, default: '' }
  },
  data: () => ({
    //
  })
}
</script>
