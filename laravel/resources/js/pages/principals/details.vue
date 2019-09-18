<template>
  <div>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <div class="flex items-baseline justify-between">
        <h2 class="text-lg">
          Principal Details
        </h2>
      </div>
      <div class="mt-4">
        <principal
          :principal="principal"
          action="update"
        />
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
              This principal is tied to the following organizations.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          Add to org
        </div>
      </div>
      <div class="mt-4">
        <OrganizationList />
      </div>
    </div>
  </div>
</template>

<script>
import Principal from '~/components/principals/Principal'
import OrganizationList from '~/components/orgs/List'

export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    Principal
  },

  props: {
    principal: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Principal Details' }
  },

  data: () => ({
    //
  }),

  methods: {
    //
  }
}
</script>
