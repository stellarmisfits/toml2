<template>
  <div v-if="orgs" class="spaced-y-6">
    <organization
      v-for="org in orgs"
      :key="org.uuid"
      :org="org"
      :action="action"
    />
  </div>
  <a-well v-else class="px-6 py-12">
    <a-empty-list
      :message="emptyMessage"
    />
  </a-well>
</template>
<script>
import Organization from '~/components/orgs/Organization'
export default {
  components: {
    Organization
  },
  props: {
    orgs: { type: Array, default: () => [] },
    action: { type: String, default: null },
    emptyMessage: { type: String, required: true },
    resourceOwnerUuid: { type: String, default: null },
    resourceOwnerType: { type: String, default: null }
  },
  data: () => ({
    //
  })
}
</script>
