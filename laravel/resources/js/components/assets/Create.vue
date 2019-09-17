<template>
  <div>
    <button
      class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all"
      @click.prevent="modal=!modal"
    >
      Add Asset
    </button>
    <Modal :open="modal">
      <div slot="title">
        Add Asset
      </div>
      <div slot="subtitle">
        Add an alias and public key of a stellar asset that you control.
      </div>
      <div slot="body">
        <form class="spaced-y-4" @submit.prevent="update" @keydown="form.onKeydown($event)">
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
            <span class="form-label">Public Key</span>
            <input
              v-model="form.public_key"
              :class="{ 'is-invalid': form.errors.has('public_key') }"
              type="text"
              name="public_key"
              required="required"
              class="form-input mt-1"
            >
            <has-error :form="form" field="public_key" />
          </label>
        </form>
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="modal=false">
          Cancel
        </button>
        <button type="button" class="relative ml-4 btn btn-black transition-all" @click.prevent="save">
          Save
        </button>
      </div>
    </Modal>
  </div>
</template>
<script>
import Form from 'vform'
export default {
  data: () => ({
    modal: false,
    form: new Form({
      name: null,
      alias: null,
      public_key: null
    })
  }),
  computed: {
    ready: function () {
      return this.form.name && this.form.alias && this.form.public_key
    }
  },
  methods: {
    async save () {
      await this.form.post('/api/assets')
      this.form.reset()
      this.$store.dispatch('asset/fetchAssets')
      this.modal = false
    }
  }
}
</script>
