<template>
  <div>
    <fa icon="times-circle" class="hover:text-gray-400 cursor-pointer" @click.prevent="modal=!modal" />
    <Modal :open="modal">
      <div slot="title">
        Are you sure you want to unlink?
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="modal=false">
          Cancel
        </button>
        <button type="button" class="relative ml-4 btn btn-black transition-all" @click="save">
          Unlink
        </button>
      </div>
    </Modal>
  </div>
</template>
<script>
import Form from 'vform'
export default {
  props: {
    resource: { type: Object, required: true },
    resourceType: { type: String, required: true }
  },
  data: () => ({
    modal: false,
    form: new Form({
      resource_uuid: '',
      resource_type: ''
    })
  }),
  created () {
    this.form.resource_uuid = this.resource.uuid
    this.form.resource_type = this.resourceType
  },
  methods: {
    async save () {
      const orgUuid = this.$route.params.uuid
      await this.form.delete('/api/organizations/' + orgUuid + '/link')

      if (this.resourceType === 'ACCOUNT') {
        this.$store.dispatch('org/fetchLinkedAccounts', orgUuid)
        this.$store.dispatch('org/fetchUnlinkedAccounts', orgUuid)
      }

      if (this.resourceType === 'ASSET') {
        this.$store.dispatch('org/fetchLinkedAssets', orgUuid)
        this.$store.dispatch('org/fetchUnlinkedAssets', orgUuid)
      }

      if (this.resourceType === 'PRINCIPAL') {
        this.$store.dispatch('org/fetchLinkedPrincipals', orgUuid)
        this.$store.dispatch('org/fetchUnlinkedPrincipals', orgUuid)
      }

      if (this.resourceType === 'VALIDATOR') {
        this.$store.dispatch('org/fetchLinkedValidators', orgUuid)
        this.$store.dispatch('org/fetchUnlinkedValidators', orgUuid)
      }

      this.form.reset()

      this.modal = false
    }
  }
}
</script>
