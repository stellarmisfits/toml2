<template>
  <div class="flex-grow">
    <a-breadcrumbs :tabs="tabs">
      <span slot="title">Organizations <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ organization.name }}</span>
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
          route: 'org.details',
          params: { slug: this.$route.params.slug }
        },
        {
          name: 'Assets',
          route: 'settings.password',
          params: { slug: this.$route.params.slug }
        },
        {
          name: 'Toml',
          route: 'org.toml',
          params: { slug: this.$route.params.slug }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('org', ['getOrgBySlug']),
    ...mapGetters('account', ['accounts']),
    organization: function () {
      const id = this.$route.params.slug
      console.log(id)
      return this.getOrgBySlug(id)
    }
  }
}
</script>
