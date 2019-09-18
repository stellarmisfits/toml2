<template>
  <div v-if="accounts" class="spaced-y-6">
    <account
      v-for="account in accounts"
      :key="account.uuid"
      :account="account"
      :action="action"
    />
  </div>
  <a-well v-else class="px-6 py-12">
    <a-empty-list
      :message="message"
    />
  </a-well>
</template>
<script>
import Account from '~/components/accounts/Account'
import { mapGetters } from 'vuex'
export default {
  components: {
    Account
  },
  props: {
    accounts: { type: Array, default: () => [] },
    message: { type: String, required: true },
    action: { type: String, default: null }
  },
  data: () => ({
    //
  }),
  computed: {
    ...mapGetters({
      //
    })
  }
}
</script>
