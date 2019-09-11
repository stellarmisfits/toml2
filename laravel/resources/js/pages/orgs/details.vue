<template>
  <div class="flex-grow">
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organization Information
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              These are global fields in the <a href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#account-information">stellar.toml</a> file.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <GlobalUpdate />
        </div>
      </div>
      <Global />
    </div>

    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Accounts
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              A list of Stellar accounts that are controlled by this organization.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <GlobalUpdate />
        </div>
      </div>
      <div class="mt-4">
        <AccountList />
      </div>
    </div>
  </div>
</template>

<script>
import AccountList from '~/components/accounts/List'
import Global from '~/components/orgs/Global'
import GlobalUpdate from '~/components/orgs/GlobalUpdate'
export default {
  middleware: 'auth',

  components: {
    Global,
    GlobalUpdate,
    AccountList
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  methods: {
    //
  }
}
</script>
