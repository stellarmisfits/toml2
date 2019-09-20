<template>
  <div class="flex-grow">
    <div class="py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Accounts
          </h2>
          <div class="mt-1 text-sm text-gray-700">
            <div class="max-w-2xl">
              Lists of the account resources that are tied to this organization.
              Account records that are linked to an organization will show up in the
              organizations TOML file under the ACCOUNTS array.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <resource-link
            :org="organization"
            :unlinked-resources="unlinkedAccounts"
            resource-type="account"
            @success="updateAccounts"
          />
        </div>
      </div>
      <div class="mt-4">
        <AccountList
          :accounts="linkedAccounts"
          empty-message="No account records have been linked to this organization"
          action="unlink"
        />
      </div>
    </div>

    <div class="py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Assets
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              Lists of the asset resources that are tied to this organization.
              Asset records that are linked to an organization will show up in the
              organizations TOML file under the CURRENCIES array.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <resource-link
            :org="organization"
            :unlinked-resources="unlinkedAssets"
            resource-type="asset"
            @success="updateAssets"
          />
        </div>
      </div>
      <div class="mt-4">
        <AssetList
          :assets="linkedAssets"
          empty-message="No assets records have been linked to this organization"
          action="unlink"
        />
      </div>
    </div>

    <div class="mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Principals
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              Lists of the principal resources that are tied to this organization.
              Principal records that are linked to an organization will show up in the
              organizations TOML file under the PRINCIPALS array.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <resource-link
            :org="organization"
            :unlinked-resources="unlinkedPrincipals"
            resource-type="principal"
            @success="updatePrincipals"
          />
        </div>
      </div>
      <div class="mt-4">
        <PrincipalList
          :principals="linkedPrincipals"
          empty-message="No principals records have been linked to this organization"
          action="unlink"
        />
      </div>
    </div>

    <div class="mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Validators
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              Lists of the validator resources that are tied to this organization.
              Validator records that are linked to an organization will show up in the
              organizations TOML file under the VALIDATORS array.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <resource-link
            :org="organization"
            :unlinked-resources="unlinkedValidators"
            resource-type="validator"
            @success="updateValidators"
          />
        </div>
      </div>
      <div class="mt-4">
        <ValidatorList
          :validators="linkedValidators"
          empty-message="No validators records have been linked to this organization"
          action="unlink"
        />
      </div>
    </div>
  </div>
</template>

<script>
import AccountList from '~/components/accounts/List'
import AssetList from '~/components/assets/List'
import PrincipalList from '~/components/principals/List'
import ValidatorList from '~/components/validators/List'
import ResourceLink from '~/components/orgs/ResourceLink'
import { mapGetters } from 'vuex'
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.organization.name + ' Resources' }
  },

  components: {
    AccountList,
    AssetList,
    PrincipalList,
    ValidatorList,
    ResourceLink
  },

  props: {
    organization: { type: Object, required: true }
  },

  computed: {
    ...mapGetters({
      linkedAccounts: 'org/linkedAccounts',
      linkedAssets: 'org/linkedAssets',
      linkedPrincipals: 'org/linkedPrincipals',
      linkedValidators: 'org/linkedValidators',

      unlinkedAccounts: 'org/unlinkedAccounts',
      unlinkedAssets: 'org/unlinkedAssets',
      unlinkedPrincipals: 'org/unlinkedPrincipals',
      unlinkedValidators: 'org/unlinkedValidators'
    })
  },

  created () {
    this.updateAccounts()
    this.updateValidators()
    this.updateAssets()
    this.updatePrincipals()
  },

  methods: {
    updateValidators () {
      this.$store.dispatch('org/fetchLinkedValidators', this.organization.uuid)
      this.$store.dispatch('org/fetchUnlinkedValidators', this.organization.uuid)
    },
    updateAccounts () {
      this.$store.dispatch('org/fetchLinkedAccounts', this.organization.uuid)
      this.$store.dispatch('org/fetchUnlinkedAccounts', this.organization.uuid)
    },
    updatePrincipals () {
      this.$store.dispatch('org/fetchLinkedPrincipals', this.organization.uuid)
      this.$store.dispatch('org/fetchUnlinkedPrincipals', this.organization.uuid)
    },
    updateAssets () {
      this.$store.dispatch('org/fetchLinkedAssets', this.organization.uuid)
      this.$store.dispatch('org/fetchUnlinkedAssets', this.organization.uuid)
    }
  }
}
</script>
