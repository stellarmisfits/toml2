<template>
  <div class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">Assets</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Assets
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              All of the Stellar assets tied to your user asset are listed below.
              To verify a stellar asset you must set the home domain to astrify.com.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <AssetCreate
            action="create"
          />
        </div>
      </div>
      <div class="mt-4">
        <AssetList
          :assets="assets"
          action="navigate"
          empty-message="No asset records have been added."
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import AssetList from '~/components/assets/List'
import AssetCreate from '~/components/assets/Upsert'
export default {
  middleware: 'auth',

  components: {
    AssetList,
    AssetCreate
  },
  data () {
    return {
      //
    }
  },
  computed: {
    ...mapGetters('asset', ['assets'])
  },
  created () {
    this.$store.dispatch('asset/fetchAssets')
  }
}
</script>
