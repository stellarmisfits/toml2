<template>
  <div>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Validator Details
          </h2>
        </div>
        <div class="flex-shrink-0 ml-4">
          <span>edit button</span>
        </div>
      </div>
      <div>
        <a-well class="mt-4">
          <div class="px-6 py-4">
            <div class="flex justify-between items-center">
              {{ validator.displayName }}
            </div>
            <div class="mt-2 text-xs text-gray-600">
              {{ validator.publicKey }}
            </div>
          </div>
          <div>
            <div class="px-6 py-2 bg-gray-100 border-t text-xs text-gray-700 font-bold uppercase">
              Details
            </div>
            <div>
              <div class="flex justify-between items-center px-6 py-4 border-t">
                <div class="text-sm text-gray-900">
                  {{ validator.alias }}
                </div>
                <div class="text-sm text-gray-700">
                  Alias
                </div>
              </div>
              <div class="flex justify-between items-center px-6 py-4 border-t">
                <div class="text-sm text-gray-900">
                  {{ validator.host }}
                </div>
                <div class="text-sm text-gray-700">
                  Host
                </div>
              </div>
              <div class="flex justify-between items-center px-6 py-4 border-t">
                <div class="text-sm text-gray-900">
                  {{ validator.history }}
                </div>
                <div class="text-sm text-gray-700">
                  History
                </div>
              </div>
            </div>
          </div>
        </a-well>
      </div>
    </div>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              This validator record is published by the following organizations:
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <!-- Add to org -->
        </div>
      </div>
      <div class="mt-4">
        <OrganizationList />
      </div>
    </div>
  </div>
</template>

<script>
import OrganizationList from '~/components/orgs/List'

export default {
  middleware: 'auth',

  components: {
    OrganizationList
  },

  props: {
    validator: { type: Object, required: true }
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    //
  }),

  methods: {
    //
  }
}
</script>
