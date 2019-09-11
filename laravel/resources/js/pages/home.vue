<template>
  <div class="flex-grow flex flex-col">
    <a-breadcrumbs>
      <span slot="title">Dashboard</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              All of the organizations your account has access to will be
              listed here. Organizations are the building blocks of TOML files
              on the Stellar network. Assets must be tied to an organization through
              a Steallar account.
              To read more about TOML files and organizations <a href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#issuer-documentation">click here</a>.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <create-org />
        </div>
      </div>
      <div class="mt-4">
        <list-orgs />
      </div>
    </div>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Accounts
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              All of the accounts your account has access to will be
              listed here. Accounts are Stellar accounts. To read more about
              accounts on the Stellar network <a href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#issuer-documentation">click here</a>.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <create-account />
        </div>
      </div>
      <div class="mt-4">
        <list-accounts />
      </div>
    </div>
  </div>
</template>

<script>
import ListAccounts from '~/components/accounts/List'
import CreateAccount from '~/components/accounts/Create'
import ListOrgs from '~/components/orgs/List'
import CreateOrg from '~/components/orgs/Create'
export default {
  components: {
    ListAccounts,
    CreateAccount,
    ListOrgs,
    CreateOrg
  },
  middleware: 'auth',
  data: () => ({
    createAccountModal: false,
    createOrganizationModal: false
  }),
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
