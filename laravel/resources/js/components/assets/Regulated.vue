<template>
  <a-well>
    <div class="bg-white text-sm">
      <div v-if="asset.regulated">
        <!-- approval_server -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Approval Server</span><br>
            <span class="text-gray-600 ml-2 block">Url of a <a class="underline" href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0008.md" target="_blank">sep0008</a> compliant approval service that signs validated transactions..</span>
            <input v-model="asset.approval_server" class="form-textarea font-mono text-sm mt-2 block w-full" placeholder="...">
          </label>
        </div>

        <!-- approval_server -->
        <div class="px-4 py-5">
          <label class="block">
            <span class="font-semibold text-gray-600 ml-2">Approval Criteria</span><br>
            <span class="text-gray-600 ml-2 block">A human readable string that explains the issuer's requirements for approving transactions.</span>
            <input v-model="asset.approval_criteria" class="form-textarea font-mono text-sm mt-2 block w-full" placeholder="...">
          </label>
        </div>
      </div>
      <div v-else>
        This asset is not regulated.
      </div>
    </div>
  </a-well>
</template>
<script>
export default {
  props: {
    asset: { type: Object, required: true }
  },
  data: () => ({
    //
  })
}
</script>
