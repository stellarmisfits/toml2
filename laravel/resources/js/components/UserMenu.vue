<template>
  <div id="app">
    <nav class="flex items-center font-sans antialiased">
      <div class="flex items-center">
        <Dropdown>
          <span slot="link" class="appearance-none flex items-center inline-block text-white font-medium">
            <img :src="user.photo_url" class="w-10 h-10 rounded-full mt-2 md:mt-0 lg:mt-0" :alt="$t('settings')" :title="$t('settings')">
            <span class="text-gray-200 px-2 font-semibold">
              {{ user.name }}
            </span>
            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg>
          </span>
          <div slot="dropdown" class="shadow rounded overflow-hidden">
            <router-link :to="{ name: 'settings.profile' }" class="no-underline block px-4 py-3 border-b text-gray-800 bg-gray-200 hover:text-white hover:bg-purple-600">
              <fa class="mr-2" icon="cog" />Settings
            </router-link>
            <a href="#" class="no-underline block px-4 py-3 text-gray-800 bg-gray-200 hover:text-white hover:bg-purple-600" @click.prevent="logout">
              <fa class="mr-2" icon="sign-out-alt" />{{ $t('logout') }}
            </a>
          </div>
        </Dropdown>
      </div>
    </nav>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Dropdown from '~/components/Dropdown'

export default {
  components: {
    Dropdown
  },
  data: () => ({
    open: false
  }),
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
