<template>
  <a-well>
    <router-link
      :to="{ name: 'principal.details', params: { uuid: principal.uuid }}"
      class="flex justify-between items-center px-6 py-6 hover:bg-gray-100 cursor-pointer"
    >
      <div class="flex-grow">
        <div class="flex justify-between items-baseline">
          <span>{{ principal.name }}</span>
        </div>
        <div class="flex justify-between items-baseline mt-1">
          <span
            class="text-sm text-gray-600"
          >
            <span
              class="inline-flex items-center"
            >
              <span>{{ principal.email }}</span>
            </span>
          </span>
        </div>
      </div>
      <unlink
        v-if="linked"
        :resource="principal"
        resource-type="PRINCIPAL"
      />
      <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-600 fill-current ml-4">
        <path d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z" />
      </svg>
    </router-link>
  </a-well>
</template>
<script>
import Unlink from '~/components/orgs/Unlink'
export default {
  components: {
    Unlink
  },
  props: {
    principal: { type: Object, required: true },
    linked: { type: Boolean, default: false }
  },
  data: () => ({
    //
  })
}
</script>
