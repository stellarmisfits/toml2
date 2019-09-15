<template>
  <div>
    <button
      class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all"
      @click.prevent="modal=!modal"
    >
      <span>Link Account</span>
    </button>
    <Modal :open="modal">
      <div v-if="unlinkedAccounts" slot="title">
        Link account to the {{ org.name }} organization.
      </div>
      <div slot="body">
        <form v-if="unlinkedAccounts" class="spaced-y-4">
          <label class="block">
            <select v-model="form.resource_uuid" :class="{ 'is-invalid': form.errors.has('resource_uuid') }" class="form-select mt-1">
              <option disabled :value="null">Select Account...</option>
              <option
                v-for="account in unlinkedAccounts"
                :key="account.uuid"
                :value="account.uuid"
              >
                {{ account.alias }}
              </option>
            </select>
            <has-error :form="form" field="email" />
          </label>
        </form>
        <empty-list v-else>
          No unlinked account records were found. To create a new account
          <router-link to="/app/accounts">
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
      resource_type: 'ACCOUNT',
      resource_uuid: null
    })
  }),
  computed: {
    ...mapGetters({
      unlinkedAccounts: 'org/unlinkedAccounts'
    })
  },
  created () {
    this.$store.dispatch('org/fetchUnlinkedAccounts', this.org.uuid)
  },
  methods: {
    async save () {
      await this.form.post('/api/organizations/' + this.org.uuid + '/link')
      this.form.reset()
      this.$store.dispatch('org/fetchUnlinkedAccounts', this.org.uuid)
      this.$store.dispatch('org/fetchLinkedAccounts', this.org.uuid)
      this.modal = false
    }
  }
}
</script>
