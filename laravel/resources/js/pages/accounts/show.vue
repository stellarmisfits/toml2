<template>
  <div v-if="account" class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">
        <router-link :to="{ name: 'accounts' }">
          Accounts
        </router-link>
        <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ account.alias }}</span>
      <span slot="dropdown">delete account</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <transition name="fade" mode="out-in">
        <router-view :account="account" />
      </transition>
    </div>
  </div>
</template>

<script>
import ABreadcrumbs from '~/components/Breadcrumbs'
import { mapGetters } from 'vuex'
export default {
  components: { ABreadcrumbs },
  middleware: 'auth',
  data () {
    return {
      tabs: [
        {
          name: 'General',
          route: 'account.details',
          params: { uuid: this.$route.params.uuid }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('account', ['getAccountByUuid']),
    account: function () {
      return this.getAccountByUuid(this.$route.params.uuid)
    }
  },
  created () {
    this.$store.dispatch('account/fetchAccount', this.$route.params.uuid)
  }
}
</script>
