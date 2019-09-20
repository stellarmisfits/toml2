<template>
  <div>
    <div class="py-6 border-t border-gray-200">
      <span class="form-label">Publish TOML</span>
      <span class="form-label-subtext">
        Once published your organization's TOML file will be available at the
        location below. If you've selected a custom domain for your
        organization you should add a CNAME record pointing to the astrify
        subdomain.
      </span>
      <div class="mt-4">
        <label class="inline-flex items-center">
          <input
            v-model="form.published"
            :value="true"
            type="radio"
            class="form-radio"
            name="published"
          >
          <span class="ml-2">Published</span>
        </label>
        <label class="inline-flex items-center ml-6">
          <input
            v-model="form.published"
            :value="false"
            type="radio"
            class="form-radio"
            name="published"
          >
          <span class="ml-2">Unpublished</span>
        </label>
      </div>
      <div class="mt-4">
        <pre class="text-sm bg-gray-800 text-white p-2 rounded">{{ organization.hosted_url }}/.well-known/stellar.toml</pre>
      </div>
    </div>
    <Modal :open="modal">
      <div slot="title">
        Are you sure you want to <span>{{ (published) ? 'publish' : 'un-publish' }}</span>  this organization?
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="close">
          Cancel
        </button>
        <button type="button" class="relative ml-4 btn btn-black transition-all" @click="save">
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
    organization: { type: Object, default: null }
  },
  data: () => ({
    modal: false,
    form: new Form({
      published: null
    })
  }),
  computed: {
    published () {
      return this.form.published
    }
  },
  watch: {
    published: function (newVal, oldVal) {
      if (this.form.originalData.published !== newVal) {
        this.modal = true
      }
    }
  },
  created () {
    let data = {}
    data.published = this.organization.published
    this.form = new Form(data)
  },
  methods: {
    async save () {
      if (this.form.published) {
        const { data } = await this.form.post('/api/organizations/' + this.organization.uuid + '/publish')
        this.$store.commit('org/SET_ORG', { org: data.data })
      } else {
        const { data } = await this.form.delete('/api/organizations/' + this.organization.uuid + '/publish')
        this.$store.commit('org/SET_ORG', { org: data.data })
      }

      this.modal = false
    },
    close () {
      this.form.reset()
      this.modal = false
    }
  }
}
</script>
