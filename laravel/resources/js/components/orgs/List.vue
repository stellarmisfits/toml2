<template>
  <div v-if="orgs" class="spaced-y-6">
    <list-item
      v-for="org in orgs"
      :key="org.uuid"
      :org="org"
    />
  </div>
  <a-well v-else class="px-6 py-12">
    <empty-list
      message="No organizations have been added to this account."
    />
  </a-well>
</template>
<script>
import ListItem from '~/components/orgs/ListItem'
import { mapGetters } from 'vuex'
export default {
  components: {
    ListItem
  },
  data: () => ({
    //
  }),
  computed: {
    ...mapGetters({
      orgs: 'org/orgs'
    })
  }
}
</script>
