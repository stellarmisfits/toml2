<template>
  <div class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">
        <router-link :to="{ name: 'accounts' }">
          Accounts
        </router-link>
        <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ account.slug }}</span>
      <span slot="dropdown">delete account</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <transition name="fade" mode="out-in">
        <router-view />
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
          params: { slug: this.$route.params.slug }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('account', ['getAccountBySlug']),
    account: function () {
      return this.getAccountBySlug(this.$route.params.slug)
    }
  }
}
</script>
