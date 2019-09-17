<template>
  <a-well>
    <div class="lg:flex">
      <div class="relative pb-2/3 lg:flex-none lg:pb-0 lg:h-48 lg:w-48">
        <img v-if="imageUrl" class="absolute h-full w-full object-cover" :src="imageUrl" :alt="imageTitle">
        <div v-else class="absolute flex justify-center items-center h-full w-full object-cover bg-gray-500">
          <fa class="block mr-2" icon="times-circle" />
        </div>
        <slot name="imageAction" />
      </div>
      <div class="flex flex-grow p-6">
        <div class="flex-grow">
          <slot name="body" />
        </div>
        <div class="flex-none">
          <slot name="action" />
        </div>
      </div>
    </div>
    <div class="p-6">
      <slot name="details" />
    </div>
  </a-well>
</template>
<script>
export default {
  name: 'AListItem',
  components: {
    //
  },
  props: {
    imageUrl: { type: String, required: true },
    imageTitle: { type: String, required: true }
  }
}
</script>
