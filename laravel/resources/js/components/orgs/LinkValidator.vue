<template>
  <div>
    <button
      class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all"
      @click.prevent="modal=!modal"
    >
      <span>Link Validator</span>
    </button>
    <Modal :open="modal">
      <div v-if="unlinkedValidators" slot="title">
        Link validator to the {{ org.name }} organization.
      </div>
      <div slot="body">
        <form v-if="unlinkedValidators" class="spaced-y-4">
          <label class="block">
            <select v-model="form.resource_uuid" :class="{ 'is-invalid': form.errors.has('resource_uuid') }" class="form-select mt-1">
              <option disabled :value="null">Select Validator...</option>
              <option
                v-for="validator in unlinkedValidators"
                :key="validator.uuid"
                :value="validator.uuid"
              >
                {{ validator.name }}
              </option>
            </select>
            <has-error :form="form" field="email" />
          </label>
        </form>
        <empty-list v-else>
          No unlinked validator records were found. To create a new validator
          <router-link to="/app/validators">
            click here.
          </router-link>
        </empty-list>
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
      resource_type: 'VALIDATOR',
      resource_uuid: null
    })
  }),
  computed: {
    ...mapGetters({
      unlinkedValidators: 'org/unlinkedValidators'
    })
  },
  created () {
    this.$store.dispatch('org/fetchUnlinkedValidators', this.org.uuid)
  },
  methods: {
    async save () {
      await this.form.post('/api/organizations/' + this.org.uuid + '/link')
      this.form.reset()
      this.$store.dispatch('org/fetchUnlinkedValidators', this.org.uuid)
      this.$store.dispatch('org/fetchLinkedValidators', this.org.uuid)
      this.modal = false
    }
  }
}
</script>
