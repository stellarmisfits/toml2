<template>
  <div>
    <div id="hero" class="relative px-5 pb-12 lg:pb-20 max-w-xl mx-auto md:max-w-2xl lg:max-w-5xl">
      <div class="relative">
        <div class="flex items-center justify-between py-3">
          <div class="flex items-center">
            <a-logo class="h-8 w-8 text-blue-800" />
            <span class="ml-2 text-lg ttext-blue-800">Astrify</span>
          </div>

          <div class="flex items-center">
            <router-link :to="{ name: 'login' }" class="btn-flat flex items-center hover:text-gray-600">
              Login
            </router-link>
            <a href="https://github.com/benbjurstrom/astrify" target="_blank"><fa :icon="['fab', 'github']" class="ml-2 text-3xl text-blue-800 hover:text-gray-600" /></a>
          </div>
        </div>

        <div class="mt-10 lg:mt-20 lg:text-center lg:max-w-xl lg:mx-auto">
          <h1 class="text-3xl font-serif tracking-tight font-bold text-gray-900 leading-tight sm:text-4xl md:text-5xl">
            Create custom <a href="https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md" target="_blank" class="text-blue-800 font-black hover:text-gray-600">Stellar TOML</a> files in seconds.
          </h1>

          <p class="mt-3 text-lg text-gray-700">
            Astrify makes it easy to <a href="https://www.stellar.org/developers/guides/issuing-assets.html" target="_blank" class="underline">publish assets</a> on the <a href="https://www.stellar.org" target="_blank" class="underline">stellar</a> network!
          </p>

          <div class="mt-6 flex justify-center">
            <router-link :to="{ name: 'login' }">
              <a-button>Sign Up Now</a-button>
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <!-- Features Section 1 -->
    <div class="lg:overflow-hidden">
      <div class="pt-4 pb-12 bg-gray-100">
        <div class="lg:relative px-5 max-w-xl md:max-w-2xl lg:max-w-5xl mx-auto">
          <div class="md:flex md:-mx-4 lg:mt-16">
            <!-- Organizations -->
            <div class="md:px-4 md:w-1/3">
              <div class="mt-10 lg:mt-0 text-blue-800">
                <fa class="text-4xl" icon="building" />
              </div>

              <h2 class="mt-4 text-lg text-blue-900 font-medium">
                Organizations
              </h2>

              <p class="mt-2 text-blue-900">
                Astrify allows you to customize your organization's information for publishing to a TOML file. Accounts, Assets, Validators, and Principals that are linked to the organization will show up in real time.
              </p>
            </div>

            <!-- Accounts -->
            <div class="md:px-4 md:w-1/3">
              <div class="mt-10 lg:mt-0 text-blue-800">
                <fa class="text-4xl" icon="key" />
              </div>

              <h2 class="mt-4 text-lg text-blue-900 font-medium">
                Accounts
              </h2>

              <p class="mt-2 text-blue-900">
                Accounts can be added to Astrify using only the public key. Once an account has been added you can use the key as the issuer for your Asset definitions.
              </p>
            </div>

            <!-- Assets -->
            <div class="md:px-4 md:w-1/3">
              <div class="mt-10 lg:mt-0 text-blue-800">
                <fa class="text-4xl" icon="money-bill-alt" />
              </div>

              <h2 class="mt-4 text-lg text-blue-900 font-medium">
                Assets
              </h2>

              <p class="mt-2 text-normal text-blue-900">
                You can use Astrify to quickly define Asset resources and link them to your organization. Online exchanges will use the metadata defined in your Asset resources when listing your asset.
              </p>
            </div>
          </div>
          <div class="my-12">
            <img class="rounded-lg" src="http://via.placeholder.com/1320x760">
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="pt-6 pb-6 bg-blue-900 text-blue-100">
        <div class="flex items-center justify-between px-5 max-w-xl md:max-w-2xl lg:max-w-5xl mx-auto">
          <div>
            © Jelled Media LLC - {{ new Date().getFullYear() }}
          </div>
          <div>
            <a href="/terms" target="_blank">Terms of Service</a> - <a href="/privacy" target="_blank">Privacy</a> - <a href="https://github.com/benbjurstrom/astrify/issues" target="_blank">Support</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
