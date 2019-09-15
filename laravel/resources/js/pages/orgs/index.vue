<template>
  <div class="flex-grow">
    <a-breadcrumbs :tabs="tabs">
      <span slot="title">Organizations <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ organization.name }}</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <transition name="fade" mode="out-in">
        <router-view :organization="organization" />
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
          route: 'org.details',
          params: { uuid: this.$route.params.uuid }
        },
        {
          name: 'Resources',
          route: 'org.resources',
          params: { uuid: this.$route.params.uuid }
        },
        {
          name: 'Toml',
          route: 'org.toml',
          params: { uuid: this.$route.params.uuid }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('org', ['getOrgByUuid']),
    ...mapGetters('account', ['accounts']),
    organization: function () {
      const uuid = this.$route.params.uuid
      return this.getOrgByUuid(uuid)
    }
  },
  created () {
    this.$store.dispatch('org/fetchOrg', this.$route.params.uuid)
  }
}
</script>
