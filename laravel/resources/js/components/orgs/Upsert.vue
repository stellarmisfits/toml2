<template>
  <div>
    <template v-if="action==='create'">
      <button
        class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all"
        @click.prevent="modal=!modal"
      >
        New Organization
      </button>
    </template>

    <template v-if="action==='update'">
      <fa
        icon="edit"
        class="hover:text-gray-400 cursor-pointer"
        @click.prevent="modal=!modal"
      />
    </template>

    <Modal :open="modal">
      <div slot="title">
        {{ title }}
      </div>
      <div slot="body">
        <form class="spaced-y-4" @submit.prevent="update" @keydown="form.onKeydown($event)">
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
  props: {
    action: {
      type: String,
      required: true,
      validator: (val) => ['create', 'update'].includes(val)
    },
    organization: { type: Object, default: null }
  },
  data: () => ({
    modal: false,
    form: new Form({
      name: null,
      alias: null
    })
  }),
  computed: {
    title () {
      return (this.action === 'create') ? 'Add New Organization' : 'Update Organization'
    }
  },
  watch: {
    modal: function () {
      if (this.modal && this.action === 'update') {
        this.form.name = this.organization.name
        this.form.alias = this.organization.alias
      }
    }
  },
  methods: {
    async save () {
      try {
        if (this.action === 'create') {
          const { data } = await this.form.post('/api/organizations')
          this.$store.commit('org/SET_ORG', { org: data.data })
        }

        if (this.action === 'update') {
          const { data } = await this.form.patch('/api/organizations/' + this.$route.params.uuid)
          this.$store.commit('org/SET_ORG', { org: data.data })
        }

        this.form.reset()
        this.modal = false
      } catch {

      }
    }
  }
}
</script>
