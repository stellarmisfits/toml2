<template>
  <div class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">Principals</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Principals
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              Principal records can be added to an organization's stellar.toml
              <a class="font-medium underline" href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#point-of-contact-documentation">[[PRINCIPALS]]</a>
              section. The principal record contains identifying information for the primary point of contact or principal(s) of the organization.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <PrincipalsCreate />
        </div>
      </div>
      <div class="mt-4">
        <PrincipalsList />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import PrincipalsList from '~/components/principals/List'
import PrincipalsCreate from '~/components/principals/Create'
export default {
  middleware: 'auth',

  components: {
    PrincipalsList,
    PrincipalsCreate
  },
  metaInfo () {
    return { title: 'Principals' }
  },
  data () {
    return {
      //
    }
  },
  computed: {
    ...mapGetters('principal', ['principals'])
  },
  created () {
    this.$store.dispatch('principal/fetchPrincipals')
  }
}
</script>
