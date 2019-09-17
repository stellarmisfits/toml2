<template>
  <!--  // $table->string('image'); // obtain through media library-->
  <!--  $table->unsignedBigInteger('account_id');-->
  <div class="flex items-stretch -mx-2">
    <div class="w-1/4 px-2">
      <div class="px-6 py-4 bg-white shadow-md rounded-lg h-full">
        <div class="font-bold text-xs text-gray-600 text-center uppercase tracking-wider">
          Display Decimals
        </div>
        <div class="mt-2 text-center text-3xl font-semibold">
          {{ asset.display_decimals }}
        </div>
      </div>
    </div>

    <div class="w-1/4 px-2">
      <div class="px-6 py-4 bg-white shadow-md rounded-lg h-full">
        <div class="font-bold text-xs text-gray-600 text-center uppercase tracking-wider">
          Fixed Number
        </div>
        <div class="mt-2 text-center text-3xl font-semibold">
          {{ asset.fixed_number || 'No' }}
        </div>
      </div>
    </div>

    <div class="w-1/4 px-2">
      <div class="px-6 py-4 bg-white shadow-md rounded-lg h-full">
        <div class="font-bold text-xs text-gray-600 text-center uppercase tracking-wider">
          Max Number
        </div>
        <div class="mt-2 text-center text-3xl font-semibold">
          {{ asset.max_number || 'N/A' }}
        </div>
      </div>
    </div>

    <div class="w-1/4 px-2">
      <div class="px-6 py-4 bg-white shadow-md rounded-lg h-full">
        <div class="font-bold text-xs text-gray-600 text-center uppercase tracking-wider">
          Unlimited
        </div>
        <div class="mt-2 text-center text-3xl font-semibold">
          {{ asset.is_unlimited }}
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// import Anchor from '~/components/assets/Anchor'
export default {
  components: {
    // Anchor
  },
  props: {
    asset: { type: Object, required: true },
    linked: { type: Boolean, default: false }
  },
  data: () => ({
    //
  })
}
</script>
