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
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              This principal is linked to the following organizations.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <link-organization
            resource-type="principal"
            :resource-uuid="principal.uuid"
            :unlinked-orgs="unlinkedOrgs"
            @organizationLinked="updateOrgs"
          />
        </div>
      </div>
      <div class="mt-4">
        <OrganizationList
          action="unlink"
          :orgs="linkedOrgs"
          empty-message="No organizations found."
          resource-owner-type="principal"
          :resource-owner-uuid="principal.uuid"
          @organizationUnlinked="updateOrgs"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Principal from '~/components/principals/Principal'
import OrganizationList from '~/components/orgs/List'
import LinkOrganization from '~/components/orgs/OrganizationLink'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    Principal,
    LinkOrganization
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

  computed: {
    ...mapGetters({
      linkedOrgs: 'principal/linkedOrgs',
      unlinkedOrgs: 'principal/unlinkedOrgs'
    })
  },

  created () {
    this.updateOrgs()
  },

  methods: {
    updateOrgs () {
      this.$store.dispatch('principal/fetchLinkedOrgs', { resourceUuid: this.principal.uuid, resourceType: 'principals' })
      this.$store.dispatch('principal/fetchUnlinkedOrgs', { resourceUuid: this.principal.uuid, resourceType: 'principals' })
    }
  }
}
</script>
