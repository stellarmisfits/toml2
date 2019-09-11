<template>
  <div v-if="orgs" class="spaced-y-6">
    <list-item
      v-for="org in orgs"
      :key="org.uuid"
      :org="org"
    />
  </div>
  <empty-list
    v-else
    message="No organizations have been added to this account."
  />
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
