<template>
  <a-list-item
    :image-url="'https://identicon-api.herokuapp.com/' + account.public_key + '/250?format=png'"
    :image-title="account.alias"
    :action="action"
  >
    <div slot="body">
      <div class="flex items-center spaced-x-1">
        <h4 class="font-semibold text-lg leading-tight truncate">
          {{ account.name }}
          <a-pill class="ml-2" color="red">
            {{ (account.verified) ? 'Verified' : 'Not Verified' }}
          </a-pill>
        </h4>
      </div>
      <div class="mt-1">
        <span>{{ account.alias }}</span>
      </div>
      <div class="mt-1">
        <span>{{ account.public_key }}</span>
      </div>
    </div>
    <div slot="action">
      <unlink
        v-if="action==='unlink'"
        resource-type="account"
        :resource-uuid="account.uuid"
        :resource-owner-uuid="resourceOwnerUuid"
        :resource-owner-type="resourceOwnerType"
      />
      <account-edit
        v-if="action==='edit'"
        :account="account"
        action="update"
      />
      <router-link
        v-if="action==='navigate'"
        :to="{ name: 'account.details', params: { uuid: account.uuid }}"
      >
        <fa icon="chevron-circle-right" class="hover:text-gray-400 cursor-pointer" />
      </router-link>
    </div>
  </a-list-item>
</template>
<script>
import Unlink from '~/components/orgs/ResourceUnlink'
import AccountEdit from '~/components/accounts/Upsert'
export default {
  components: {
    Unlink,
    AccountEdit
  },

  props: {
    account: { type: Object, required: true },
    action: {
      type: String,
      required: true,
      validator: (val) => ['edit', 'unlink', 'navigate'].includes(val)
    },
    resourceOwnerUuid: { type: String, default: null },
    resourceOwnerType: { type: String, default: null }
  },

  data: () => ({
    //
  })
}
</script>
