<template>
  <a-well class="mt-4">
    <div class="px-6 py-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center">
          <span>Lotto' Gelato</span>
        </div>
        <div class="flex items-center spaced-x-1 ml-4">
          <a-pill color="blue">
            Published
          </a-pill>
        </div>
      </div>
      <div class="flex justify-between mt-2">
        <div class="flex items-center text-sm text-gray-600">
          <img src="https://www.gravatar.com/avatar/3ae3918cbb02697b3536f6bcc68adc6d?d=https%3A%2F%2Fui-avatars.com%2Fapi%2FBenjamin%2BBjurstrom" class="h-5 w-5 rounded-full">
          <span class="ml-2">Published a day ago by <span class="text-gray-900">Benjamin Bjurstrom</span></span>
        </div>
      </div>
    </div> <!---->
    <div>
      <div
        class="px-6 py-2 bg-gray-100 border-t text-xs text-gray-700 font-bold uppercase tracking-wider"
      >
        Keys
      </div>
      <div class="bg-white px-6 py-4">
        <div class="flex justify-between items-baseline">
          <span class="text-xs">GA6MOVBKZSOGJ47PHWOLUSN46D6ODSZ7PQJ7NMHRRIS5Z7LP5L7ZZWL6</span>
          <div class="spaced-x-5 text-sm text-gray-600">
            SIGNING_KEY
          </div>
        </div>
        <div class="mt-1">
          <span class="text-sm text-gray-600">
            The signing key is used for SEP-3 Compliance Protocol
          </span>
        </div>
      </div>
      <div class="bg-white px-6 py-4">
        <div class="flex justify-between items-baseline">
          <span class="text-xs">GA6MOVBKZSOGJ47PHWOLUSN46D6ODSZ7PQJ7NMHRRIS5Z7LP5L7ZZWL6</span>
          <div class="spaced-x-5 text-sm text-gray-600">
            URI_REQUEST_SIGNING_KEY
          </div>
        </div>
        <div class="mt-1">
          <span class="text-sm text-gray-600">
            The signing key is used for SEP-7 delegated signing
          </span>
        </div>
      </div>
    </div>
    <div>
      <div
        class="px-6 py-2 bg-gray-100 border-t text-xs text-gray-700 font-bold uppercase tracking-wider"
      >
        Servers
      </div>
      <div class="bg-white px-6 py-4">
        <div class="flex justify-between items-baseline">
          <span>https://fed.astrify.com</span>
          <div class="spaced-x-5 text-sm text-gray-600">
            Federation Server
          </div>
        </div>
        <div class="mt-1">
          <span class="text-sm text-gray-600">
            The endpoint for clients to resolve stellar addresses for users on your domain via SEP-2 Federation Protocol
          </span>
        </div>
      </div>
      <div class="bg-white px-6 py-4">
        <div class="flex justify-between items-baseline">
          <span>https://fed.astrify.com</span>
          <div class="spaced-x-5 text-sm text-gray-600">
            Auth Server
          </div>
        </div>
        <div class="mt-1">
          <span class="text-sm text-gray-600">
            The endpoint for clients to resolve stellar addresses for users on your domain via SEP-2 Federation Protocol
          </span>
        </div>
      </div>
    </div> <!---->
    <div>
      <div class="px-6 py-2 bg-gray-100 border-t text-xs">
        <div class="text-gray-700 font-bold uppercase tracking-wider">
          Accounts
        </div>
        <div>A list of Stellar accounts that are controlled by this domain</div>
      </div>
      <div class="bg-white px-6 py-4 spaced-y-1">
        <div class="flex justify-between items-baseline">
          <a
            href="https://steexp.com/account/GD33AD7P7JP4UNDPDXN2PD2WP7UZJBDN5D4TKK3SG4WLPPL3BVRFL2OO"
            target="_blank"
            class="text-gray-600 hover:text-gray-900 text-xs"
          >
            GA6MOVBKZSOGJ47PHWOLUSN46D6ODSZ7PQJ7NMHRRIS5Z7LP5L7ZZWL6
          </a>
          <span class="text-sm text-gray-600">Verified</span>
        </div>
        <div class="flex justify-between items-baseline">
          <a
            href="https://steexp.com/account/GD33AD7P7JP4UNDPDXN2PD2WP7UZJBDN5D4TKK3SG4WLPPL3BVRFL2OO"
            target="_blank"
            class="text-gray-600 hover:text-gray-900 text-xs"
          >
            GA6MOVBKZSOGJ47PHWOLUSN46D6ODSZ7PQJ7NMHRRIS5Z7LP5L7ZZWL6
          </a>
          <span class="text-sm text-gray-600">Unverified</span>
        </div>
      </div>
    </div> <!---->
  </a-well>
</template>
