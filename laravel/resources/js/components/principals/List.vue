<template>
  <div v-if="principals" class="spaced-y-6">
    <list-item
      v-for="principal in principals"
      :key="principal.uuid"
      :principal="principal"
    />
  </div>
  <empty-list
    v-else
    message="No principals have been added to this account."
  />
</template>
<script>
import ListItem from '~/components/principals/ListItem'
import { mapGetters } from 'vuex'
export default {
  components: {
    ListItem
  },
  data: () => ({
    //
  }),
  computed: mapGetters({
    principals: 'principal/principals'
  })
}
</script>
