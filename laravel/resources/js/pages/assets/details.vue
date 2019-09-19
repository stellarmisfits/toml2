<template>
  <div>
    <div class="px-12 py-8 mx-auto">
      <div class="mt-4">
        <asset :asset="asset" action="edit" />
      </div>
    </div>
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Asset Metrics
          </h2>
        </div>
        <div class="flex-shrink-0 ml-4">
          <span>edit button</span>
        </div>
      </div>
      <div class="mt-4">
        <asset-metrics :asset="asset" />
      </div>
    </div>
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Asset Account
          </h2>
          <div class="mt-1 text-sm text-gray-700">
            <div class="max-w-2xl">
              This asset is associated with the following account.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <span>edit button</span>
        </div>
      </div>
      <div class="mt-4">
        <account
          v-if="account"
          :account="account"
          action="unlink"
        />
        <a-well class="px-6 py-6">
          <a-empty-list>
            No account found.
          </a-empty-list>
        </a-well>
      </div>
    </div>
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-1 text-sm text-gray-700">
            <div class="max-w-2xl">
              This asset is tied to the following organizations
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          Add to org
        </div>
      </div>
      <div class="mt-4">
        <OrganizationList
          action="unlink"
          empty-message="This asset has not been linked to any organizations"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Asset from '~/components/assets/Asset'
import Account from '~/components/accounts/Account'
import AssetMetrics from '~/components/assets/Metrics'
import OrganizationList from '~/components/orgs/List'
import { mapGetters } from 'vuex'
export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    Asset,
    AssetMetrics,
    Account
  },

  props: {
    asset: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Asset Details' }
  },

  data: () => ({
    //
  }),

  computed: {
    ...mapGetters('account', ['getAccountByUuid']),
    account: function () {
      return this.getAccountByUuid(this.asset.account_uuid)
    }
  },

  created () {
    if (this.asset.account_uuid) {
      this.$store.dispatch('account/fetchAccount', this.asset.account_uuid)
    }
  },

  methods: {
    //
  }
}
</script>
