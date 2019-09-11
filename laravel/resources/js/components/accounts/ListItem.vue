<template>
  <a-well>
    <router-link
      :to="{ name: 'account.details', params: { slug: account.slug }}"
      class="flex justify-between items-center px-6 py-6 hover:bg-gray-100 cursor-pointer"
    >
      <div class="flex-grow">
        <div class="flex justify-between items-baseline">
          <span>{{ account.slug }}</span>
        </div>
        <div class="flex justify-between items-baseline mt-1">
          <span
            class="text-sm text-gray-600"
          >
            <span
              class="inline-flex items-center"
            >
              <span>{{ (account.verified) ? 'Verified' : 'Not Verified' }}</span>
            </span>
          </span>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-600 fill-current ml-4">
        <path d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z" />
      </svg>
    </router-link>
  </a-well>
</template>
<script>
export default {
  props: {
    account: { type: Object, required: true }
  },
  data: () => ({
    //
  })
}
</script>
