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
          <ValidatorCreate
            :validator="validator"
            action="update"
          />
        </div>
      </div>
      <div>
        <a-well class="mt-4">
          <div class="px-6 py-4">
            <div class="flex justify-between items-center">
              {{ validator.name }}
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
    <div class="px-12 py-8 mx-auto">
      <div class="flex items-baseline justify-between">
        <div>
          <h2 class="text-lg">
            Organizations
          </h2>
          <div class="mt-2 text-sm text-gray-700">
            <div class="max-w-2xl">
              This validator is linked to the following organizations.
            </div>
          </div>
        </div>
        <div class="flex-shrink-0 ml-4">
          <link-organization
            resource-type="validator"
            :resource-uuid="validator.uuid"
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
          resource-owner-type="validator"
          :resource-owner-uuid="validator.uuid"
          @organizationUnlinked="updateOrgs"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ValidatorCreate from '~/components/validators/Upsert'
import OrganizationList from '~/components/orgs/List'
import LinkOrganization from '~/components/orgs/OrganizationLink'
import { mapGetters } from 'vuex'
export default {
  middleware: 'auth',

  components: {
    OrganizationList,
    ValidatorCreate,
    LinkOrganization
  },

  props: {
    validator: { type: Object, required: true }
  },

  metaInfo () {
    return { title: 'Validator Details' }
  },

  data: () => ({
    //
  }),

  computed: {
    ...mapGetters({
      linkedOrgs: 'validator/linkedOrgs',
      unlinkedOrgs: 'validator/unlinkedOrgs'
    })
  },

  created () {
    this.updateOrgs()
  },

  methods: {
    updateOrgs () {
      this.$store.dispatch('validator/fetchLinkedOrgs', { resourceUuid: this.validator.uuid, resourceType: 'validators' })
      this.$store.dispatch('validator/fetchUnlinkedOrgs', { resourceUuid: this.validator.uuid, resourceType: 'validators' })
    }
  }
}
</script>
