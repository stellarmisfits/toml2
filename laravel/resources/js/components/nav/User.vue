<template>
  <div>
    <Dropdown v-if="user">
      <span slot="link" class="flex items-center">
        <img :src="user.photo_url" class="h-8 w-8 rounded-full">
        <span class="ml-3">
          {{ user.name }}
        </span>
        <svg class="h-5 w-5 ml-2 fill-current text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
        </svg>
      </span>
      <div slot="dropdown" class="py-2 w-64">
        <router-link v-if="showSettings" :to="{ name: 'settings.profile' }" class="dropdown-item">
          <fa class="mr-2" icon="cog" />Settings
        </router-link>
        <a href="#" class="dropdown-item" @click.prevent="logout">
          <fa class="mr-2" icon="sign-out-alt" />{{ $t('logout') }}
        </a>
      </div>
    </Dropdown>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    open: false
  }),

  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),
    showSettings: function () {
      return window.config.loginEnabled
    }
  },

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.go({ name: 'login' })
    }
  }
}
</script>
