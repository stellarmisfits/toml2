<template>
  <div v-if="principals" class="spaced-y-6">
    <list-item
      v-for="principal in principals"
      :key="principal.uuid"
      :principal="principal"
      :linked="linked"
    />
  </div>
  <a-well v-else class="px-6 py-12">
    <empty-list
      :message="message"
    />
  </a-well>
</template>
<script>
import ListItem from '~/components/principals/ListItem'
export default {
  components: {
    ListItem
  },
  props: {
    principals: { type: Array, default: () => [] },
    message: { type: String, required: true },
    linked: { type: Boolean, default: false }
  },
  data: () => ({
    //
  })
}
</script>
