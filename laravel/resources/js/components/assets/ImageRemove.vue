<template>
  <div>
    <a href="#" class="dropdown-item" @click.prevent="modal=true">
      <fa class="mr-2" icon="times-circle" />Remove
    </a>
    <Modal :open="modal" @close="close">
      <div slot="title">
        Are you sure you want to delete the image for asset {{ asset.name }}?
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="close">
          Cancel
        </button>
        <button type="button" class="relative ml-4 btn btn-black transition-all" @click="save">
          Delete
        </button>
      </div>
    </Modal>
  </div>
</template>
<script>
import Form from 'vform'
export default {
  props: {
    asset: { type: Object, required: true }
  },
  data: () => ({
    modal: false,
    form: new Form({
      asset_uuid: ''
    })
  }),
  created () {
    this.form.asset_uuid = this.asset.uuid
  },
  methods: {
    close () {
      this.modal = false
      this.$emit('close')
    },
    async save () {
      const assetUuid = this.$route.params.uuid
      await this.form.delete('/api/assets/' + assetUuid + '/image')

      this.form.reset()
      this.modal = false
    }
  }
}
</script>
