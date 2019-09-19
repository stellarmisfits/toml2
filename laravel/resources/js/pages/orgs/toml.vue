<template>
  <div class="px-12 py-8 mx-auto max-w-4xl">
    <div class="flex items-baseline justify-between">
      <div>
        <h2 class="text-lg">
          Toml Preview
        </h2>
        <div class="mt-2 text-sm text-gray-700">
          <div class="max-w-2xl">
            Below you will find a generated TOML file for this organization.
            Feel free to copy it to your hosting provider. Or take advantage of
            our free hosting as part of our PRO plan>
          </div>
        </div>
      </div>
      <div class="flex-shrink-0 ml-4">
        <button class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all" @click.prevent="">
          Download
        </button>
      </div>
    </div>
    <div>
      <a-well class="mt-4">
        <Org :org="organization" />
        <div>
          <div
            class="px-6 py-2 bg-gray-100 border-t text-xs text-gray-700 font-bold uppercase tracking-wider"
          >
            TOML Preview
          </div>
          <div class="bg-white px-6 py-4 overflow-auto">
            <pre class="font-mono text-xs text-gray-700">{{ toml }}</pre>
          </div>
        </div>
      </a-well>
    </div>
  </div>
</template>

<script>
import Org from '~/components/orgs/Organization'
import { mapState } from 'vuex'
export default {
  middleware: 'auth',

  components: {
    Org
  },

  props: {
    organization: { type: Object, required: true }
  },

  computed: {
    ...mapState('org', ['toml'])
  },

  created () {
    this.$store.dispatch('org/fetchToml', this.organization)
  },

  metaInfo () {
    return { title: 'TOML Preview' }
  },

  methods: {
    //
  }
}
</script>
