<template>
  <div v-if="asset" class="flex-grow">
    <a-breadcrumbs :tabs="tabs">
      <span slot="title">
        <router-link :to="{ name: 'assets' }">
          Assets
        </router-link>
        <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ asset.name }}</span>
      <span slot="dropdown">delete asset</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <transition name="fade" mode="out-in">
        <router-view :asset="asset" />
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
          route: 'asset.details',
          params: { uuid: this.$route.params.uuid }
        },
        {
          name: 'Anchor',
          route: 'asset.anchor',
          params: { uuid: this.$route.params.uuid }
        },
        {
          name: 'Stellar',
          route: 'asset.stellar',
          params: { uuid: this.$route.params.uuid }
        },
        {
          name: 'Regulated',
          route: 'asset.regulated',
          params: { uuid: this.$route.params.uuid }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('asset', ['getAssetByUuid']),
    asset: function () {
      return this.getAssetByUuid(this.$route.params.uuid)
    }
  },
  created () {
    this.$store.dispatch('asset/fetchAsset', this.$route.params.uuid)
  }
}
</script>
