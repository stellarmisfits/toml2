<template>
  <div class="flex-grow">
    <div class="px-12 py-8 mx-auto max-w-4xl">
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
          <LinkAccount :org="organization" />
        </div>
      </div>
      <div class="mt-4">
        <AccountList
          :accounts="linkedAccounts"
          message="No account records have been linked to this organization"
          action="unlink"
        />
      </div>
    </div>

    <div class="px-12 py-8 mx-auto max-w-4xl">
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
          <LinkAsset :org="organization" />
        </div>
      </div>
      <div class="mt-4">
        <AssetList
          :assets="linkedAssets"
          message="No assets records have been linked to this organization"
          action="unlink"
        />
      </div>
    </div>

    <div class="px-12 py-8 mx-auto max-w-4xl">
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
          <LinkPrincipal :org="organization" />
        </div>
      </div>
      <div class="mt-4">
        <PrincipalList
          :principals="linkedPrincipals"
          message="No principals records have been linked to this organization"
          :linked="true"
        />
      </div>
    </div>

    <div class="px-12 py-8 mx-auto max-w-4xl">
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
          <LinkValidator :org="organization" />
        </div>
      </div>
      <div class="mt-4">
        <ValidatorList
          :validators="linkedValidators"
          message="No validators records have been linked to this organization"
          :linked="true"
        />
      </div>
    </div>
  </div>
</template>

<script>
import AccountList from '~/components/accounts/List'
import LinkAccount from '~/components/orgs/LinkAccount'
import AssetList from '~/components/assets/List'
import LinkAsset from '~/components/orgs/LinkAsset'
import PrincipalList from '~/components/principals/List'
import LinkPrincipal from '~/components/orgs/LinkPrincipal'
import ValidatorList from '~/components/validators/List'
import LinkValidator from '~/components/orgs/LinkValidator'
import { mapGetters } from 'vuex'
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.organization.name + ' Resources' }
  },

  components: {
    LinkAccount,
    AccountList,
    LinkAsset,
    AssetList,
    PrincipalList,
    LinkPrincipal,
    ValidatorList,
    LinkValidator
  },

  props: {
    organization: { type: Object, required: true }
  },

  computed: {
    ...mapGetters({
      linkedAccounts: 'org/linkedAccounts',
      linkedAssets: 'org/linkedAssets',
      linkedPrincipals: 'org/linkedPrincipals',
      linkedValidators: 'org/linkedValidators'
    })
  },

  created () {
    this.$store.dispatch('org/fetchLinkedAccounts', this.$route.params.uuid)
    this.$store.dispatch('org/fetchLinkedAssets', this.$route.params.uuid)
    this.$store.dispatch('org/fetchLinkedPrincipals', this.$route.params.uuid)
    this.$store.dispatch('org/fetchLinkedValidators', this.$route.params.uuid)
  },

  methods: {
    //
  }
}
</script>
