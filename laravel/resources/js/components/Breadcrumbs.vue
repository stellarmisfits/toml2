<template>
  <div class="bg-white">
    <div class="px-12">
      <div class="py-6">
        <div class="flex justify-between items-center">
          <div
            class="flex items-center text-sm text-gray-700 uppercase font-bold tracking-widest"
          >
            <slot name="title" />
          </div>
          <div>
            <slot name="dropdown" />
          </div>
        </div>
        <div v-if="hasSubtitleSlot" class="mt-2 text-sm text-gray-600 hover:text-gray-900">
          <slot name="subtitle" />
        </div>
        <div v-if="hasMenuSlot" class="mt-6 pt-6 border-t-2 border-gray-200">
          <nav class="flex spaced-x-4 text-gray-600 text text-sm">
            <router-link
              v-for="tab in tabs"
              :key="tab.href"
              :to="{ name: tab.route }"
              active-class="text-gray-900"
            >
              {{ tab.name }}
            </router-link>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ABreadcrumbs',
  props: {
    tabs: {
      type: Array,
      default: null
    }
  },
  data () {
    return {
      //
    }
  },
  computed: {
    hasSubtitleSlot () {
      return !!this.$slots['subtitle']
    },
    hasMenuSlot () {
      return !!this.tabs
    }
  }
}
</script>
