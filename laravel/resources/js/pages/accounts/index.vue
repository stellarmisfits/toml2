<template>
  <div class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">Accounts</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Accounts
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              All of the Stellar accounts tied to your user account are listed below.
              To verify a stellar account you must set the home domain to astrify.com.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <AccountCreate />
        </div>
      </div>
      <div class="mt-4">
        <AccountList />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import AccountList from '~/components/accounts/List'
import AccountCreate from '~/components/accounts/Create'
export default {
  middleware: 'auth',

  components: {
    AccountList,
    AccountCreate
  },
  data () {
    return {
      //
    }
  },
  computed: {
    ...mapGetters('account', ['accounts'])
  }
}
</script>
