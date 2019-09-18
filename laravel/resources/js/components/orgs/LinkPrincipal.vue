<template>
  <div>
    <button
      class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all"
      @click.prevent="modal=!modal"
    >
      <span>Link Principal</span>
    </button>
    <Modal :open="modal">
      <div v-if="unlinkedPrincipals" slot="title">
        Link principal to the {{ org.name }} organization.
      </div>
      <div slot="body">
        <form v-if="unlinkedPrincipals" class="spaced-y-4">
          <label class="block">
            <select v-model="form.resource_uuid" :class="{ 'is-invalid': form.errors.has('resource_uuid') }" class="form-select mt-1">
              <option disabled :value="null">Select Principal...</option>
              <option
                v-for="principal in unlinkedPrincipals"
                :key="principal.uuid"
                :value="principal.uuid"
              >
                {{ principal.name }}
              </option>
            </select>
            <has-error :form="form" field="email" />
          </label>
        </form>
        <a-empty-list v-else>
          No unlinked principal records were found. To create a new principal
          <router-link to="/app/principals">
            click here.
          </router-link>
        </a-empty-list>
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="modal=false">
          Cancel
        </button>
        <button type="button" :disabled="!form.resource_uuid" class="relative ml-4 btn btn-black transition-all" @click="save">
          Save
        </button>
      </div>
    </Modal>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
  props: {
    org: { type: Object, required: true }
  },
  data: () => ({
    modal: false,
    form: new Form({
      resource_type: 'PRINCIPAL',
      resource_uuid: null
    })
  }),
  computed: {
    ...mapGetters({
      unlinkedPrincipals: 'org/unlinkedPrincipals'
    })
  },
  created () {
    this.$store.dispatch('org/fetchUnlinkedPrincipals', this.org.uuid)
  },
  methods: {
    async save () {
      await this.form.post('/api/organizations/' + this.org.uuid + '/link')
      this.form.reset()
      this.$store.dispatch('org/fetchUnlinkedPrincipals', this.org.uuid)
      this.$store.dispatch('org/fetchLinkedPrincipals', this.org.uuid)
      this.modal = false
    }
  }
}
</script>
