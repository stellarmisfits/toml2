<template>
  <a-well class="px-6 py-12">
    <div class="flex items-center justify-center">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        class="h-16 w-16"
      >
        <path
          d="M6 2h6v6c0 1.1.9 2 2 2h6v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2z"
          class="fill-current text-gray-300"
        />
        <polygon
          points="14 2 20 8 14 8"
          class="fill-current text-gray-500"
        />
      </svg>
    </div>
    <div class="mt-4 text-center max-w-xl mx-auto">
      {{ message }}
    </div>
  </a-well>
</template>
<script>
export default {
  name: 'EmptyList',
  props: {
    message: {
      type: String,
      required: true
    }
  }
}
</script>
