<template>
  <div class="flex-grow">
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organization Information
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              These are global fields in the <a href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#account-information">stellar.toml</a> file.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <GlobalUpdate />
        </div>
      </div>
      <Global />
    </div>
  </div>
</template>

<script>
import Global from '~/components/orgs/Global'
import GlobalUpdate from '~/components/orgs/GlobalUpdate'
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.organization.name }
  },

  components: {
    Global,
    GlobalUpdate
  },

  props: {
    organization: { type: Object, required: true }
  },

  methods: {
    //
  }
}
</script>
