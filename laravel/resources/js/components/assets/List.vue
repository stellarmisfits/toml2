<template>
  <div v-if="assets" class="spaced-y-6">
    <list-item
      v-for="asset in assets"
      :key="asset.uuid"
      :asset="asset"
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
import ListItem from '~/components/assets/ListItem'
import { mapGetters } from 'vuex'
export default {
  components: {
    ListItem
  },
  props: {
    assets: { type: Array, default: () => [] },
    message: { type: String, required: true },
    linked: { type: Boolean, default: false }
  },
  data: () => ({
    //
  }),
  computed: {
    ...mapGetters({
      //
    })
  }
}
</script>
