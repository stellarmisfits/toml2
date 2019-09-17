<template>
  <div>
    <a href="#" class="dropdown-item" @click.prevent="modal=true">
      <fa class="mr-2" icon="edit" />Update
    </a>
    <Modal :open="modal" @close="close">
      <div slot="title">
        Upload an image for asset {{ asset.name }}.
      </div>
      <div slot="body">
        <input id="file" ref="file" type="file">
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="close">
          Cancel
        </button>
        <button type="button" class="relative ml-4 btn btn-black transition-all" @click="save">
          Upload
        </button>
      </div>
    </Modal>
  </div>
</template>
<script>
import Form from 'vform'
import Vapor from 'laravel-vapor'
export default {
  props: {
    asset: { type: Object, required: true }
  },
  data: () => ({
    modal: false,
    form: new Form({
      uuid: '',
      filename: '',
      content_type: ''
    })
  }),
  methods: {
    close () {
      this.modal = false
      this.$emit('close')
    },
    async save () {
      const assetUuid = this.$route.params.uuid

      try {
        const response = await Vapor.store(this.$refs.file.files[0], {
          progress: progress => {
            this.uploadProgress = Math.round(progress * 100)
          }
        })

        this.form.uuid = response.uuid
        this.form.filename = this.$refs.file.files[0].name
        this.form.content_type = this.$refs.file.files[0].type

        await this.form.post('/api/assets/' + assetUuid + '/image')

        this.$emit('close')
      } catch (e) {
        console.log(e)
      }
    }
  }
}
</script>
