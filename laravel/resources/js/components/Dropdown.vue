<template>
  <div class="relative">
    <div role="button" class="inline-block select-none" @click="open = !open">
      <slot name="link" />
    </div>
    <div v-show="open" class="absolute pin-r w-full mt-2">
      <slot name="dropdown" />
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    open: false
  })
}
</script>
