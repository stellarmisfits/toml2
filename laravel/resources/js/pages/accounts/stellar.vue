<template>
  <div>
    <div class="py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Stellar Details for Account
          </h2>
        </div>
        <div class="flex-shrink-0 ml-4">
          <span>edit button</span>
        </div>
      </div>
      <div class="mt-4">
        <account-list-item
          :account="account"
          action="edit"
        />
      </div>
    </div>
    <div class="py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              This account is tied to the following organizations
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          Add to org
        </div>
      </div>
      <div class="mt-4">
        <OrganizationList />
      </div>
    </div>
  </div>
</template>

<script>
import AccountListItem from '~/components/accounts/Account'
import OrganizationList from '~/components/orgs/List'

export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    AccountListItem
  },

  props: {
    account: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Account Stellar' }
  },

  data: () => ({
    //
  }),

  methods: {
    //
  }
}
</script>
