<template>
  <div>
    <button
      class="inline-flex items-center spaced-x-2 btn btn-sm btn-white transition-all"
    >
      <a @click.prevent="createOrganizationModal=!createOrganizationModal">New Organization</a>
    </button>
    <Modal :open="createOrganizationModal">
      <div slot="title">
        New Organization
      </div>
      <div slot="subtitle">
        Subtitle
      </div>
      <div slot="body">
        Body
      </div>
      <div slot="actions">
        <button class="btn btn-white transition-all" @click="createOrganizationModal=false">
          Cancel
        </button>
        <button type="button" class="relative ml-4 btn btn-black transition-all">
          Save
        </button>
      </div>
    </Modal>
  </div>
</template>
<script>
export default {
  data: () => ({
    createOrganizationModal: false
  })
}
</script>
