<template>
  <div class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">
        <router-link :to="{ name: 'principals' }">
          Principals
        </router-link>
        <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ principal.name }}</span>
      <span slot="dropdown">delete principal</span>
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
          route: 'principal.details',
          params: { uuid: this.$route.params.uuid }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('principal', ['getPrincipalByUuid']),
    principal: function () {
      return this.getPrincipalByUuid(this.$route.params.uuid)
    }
  }
}
</script>
