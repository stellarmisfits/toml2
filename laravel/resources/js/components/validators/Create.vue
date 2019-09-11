<template>
  <div>
    <button class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all">
      <a @click.prevent="createOrganizationModal=!createOrganizationModal">Add Validator</a>
    </button>
    <Modal :open="createOrganizationModal">
      <div slot="title">
        New Validator
      </div>
      <div slot="subtitle">
        Complete all applicable fields and exclude any that don't apply.
      </div>
      <div slot="body">
        <form class="spaced-y-4" @submit.prevent="create" @keydown="form.onKeydown($event)">
          <alert-error :form="form" />
          <label class="block">
            <span class="form-label">Alias</span>
            <input
              v-model="form.alias"
              :class="{ 'is-invalid': form.errors.has('alias') }"
              type="text"
              name="alias"
              required="required"
              class="form-input mt-1"
            >
            <has-error :form="form" field="alias" />
          </label>
          <label class="block">
            <span class="form-label">Name</span>
            <input
              v-model="form.name"
              :class="{ 'is-invalid': form.errors.has('name') }"
              type="text"
              name="name"
              required="required"
              class="form-input mt-1"
            >
            <has-error :form="form" field="name" />
          </label>
          <label class="block">
            <span class="form-label">Public Key</span>
            <select
              v-model="form.account_uuid"
              :class="{ 'is-invalid': form.errors.has('account_uuid') }"
              class="form-select mt-1"
              name="account_uuid"
            >
              <option :value="null">NONE</option>
              <option
                v-for="account in accounts"
                :key="account.uuid"
                :value="account.uuid"
              >
                {{ account.slug }}
              </option>
            </select>
            <has-error :form="form" field="account_uuid" />
          </label>
          <label class="block">
            <span class="form-label">Host</span>
            <input
              v-model="form.host"
              :class="{ 'is-invalid': form.errors.has('host') }"
              type="text"
              name="host"
              required="required"
              class="form-input mt-1"
            >
            <has-error :form="form" field="host" />
          </label>
          <label class="block">
            <span class="form-label">History</span>
            <input
              v-model="form.history"
              :class="{ 'is-invalid': form.errors.has('history') }"
              type="text"
              name="history"
              required="required"
              class="form-input mt-1"
            >
            <has-error :form="form" field="history" />
          </label>
          <a-button
            :loading="form.busy"
            type="white"
            class="relative ml-4 btn transition-all"
            @click="create"
          >
            Save
          </a-button>
        </form>
      </div>
      <div slot="actions">
        <button
          class="btn btn-white transition-all"
          @click="createOrganizationModal=false"
        >
          Cancel
        </button>
        <a-button
          :loading="form.busy"
          type="white"
          class="relative ml-4 btn transition-all"
          @click="create"
        >
          Save
        </a-button>
      </div>
    </Modal>
  </div>
</template>
<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
export default {
  data: () => ({
    createOrganizationModal: false,
    form: new Form({
      alias: '',
      name: '',
      account_uuid: null,
      host: '',
      history: ''
    })
  }),
  computed: {
    ...mapGetters({
      accounts: 'account/accounts'
    })
  },
  methods: {
    async create () {
      const { data } = await this.form.post('/api/validators')
      this.$store.dispatch('validator/updateValidators', { validator: data })
      this.form.reset()
    }
  }
}
</script>
