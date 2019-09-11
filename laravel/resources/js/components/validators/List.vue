<template>
  <div v-if="validators" class="spaced-y-6">
    <list-item
      v-for="validator in validators"
      :key="validator.uuid"
      :validator="validator"
    />
  </div>
  <empty-list
    v-else
    message="No validators have been added to this account."
  />
</template>
<script>
import ListItem from '~/components/validators/ListItem'
import { mapGetters } from 'vuex'
export default {
  components: {
    ListItem
  },
  data: () => ({
    //
  }),
  computed: mapGetters({
    validators: 'validator/validators'
  })
}
</script>
