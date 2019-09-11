<template>
  <div v-if="accounts" class="spaced-y-6">
    <list-item
      v-for="account in accounts"
      :key="account.uuid"
      :account="account"
    />
  </div>
  <empty-list
    v-else
    message="No accounts have been added to this account."
  />
</template>
<script>
import ListItem from '~/components/accounts/ListItem'
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
      accounts: 'account/accounts'
    })
  }
}
</script>
