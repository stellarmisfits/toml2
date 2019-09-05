<template>
  <nav class="flex items-center justify-between flex-wrap bg-gray-800 p-4 mb-8">
    <div class="flex items-center flex-no-shrink text-gray-200 ml-8 mr-8">
      <!-- Logo -->
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="hover:text-gray-400">
        <svg class="fill-current h-10 w-10 ml-2 mr-2" viewBox="0 0 270 270" xmlns="http://www.w3.org/2000/svg">
          <path d="M161.181 16.875l104.724 202.5c11.636 22.5-2.909 50.625-26.181 50.625H195c-34.887 0-34.275-23.819-34.887-37.447-.099-2.207 1.678-3.995 3.887-3.995h27.493c.833 0 1.507-.67 1.507-1.498v-9.168c0-.365-.134-.717-.377-.991l-23.727-25.036c9.353-34.806-5.245-66.142-33.896-86.865-28.841 20.422-43.249 52.059-33.896 86.865l-23.727 25.036a1.493 1.493 0 0 0-.377.991v9.168c0 .828.674 1.498 1.507 1.498H106c2.209 0 3.986 1.788 3.887 3.995-.612 13.628 0 37.447-34.887 37.447H30.276c-23.272 0-37.817-28.125-26.18-50.625l104.723-202.5c11.636-22.5 40.726-22.5 52.362 0z" />
          <path fill-rule="evenodd" d="M135 179.884c10.331 0 18.831-8.423 18.831-18.721s-8.5-18.721-18.831-18.721-18.831 8.423-18.831 18.721 8.5 18.721 18.831 18.721zm-2.871-32.765c.032 1.094.916 1.998 2.021 1.998 2.036-.016 3.978.443 5.683 1.315 1.783.872 3.314 2.173 4.514 3.758a1.98 1.98 0 0 0 2.778.397c.869-.651 1.042-1.919.395-2.791a16.486 16.486 0 0 0-5.919-4.963c-2.258-1.109-4.799-1.76-7.483-1.744-1.089.032-1.989.92-1.989 2.03zm15.644 8.783c-1.058.286-1.674 1.396-1.39 2.458.158.523.253 1.094.332 1.665.079.539.11 1.11.11 1.712.032 1.094.916 2.014 2.021 1.998a2.023 2.023 0 0 0 1.989-2.03 17.924 17.924 0 0 0-.174-2.219 17.06 17.06 0 0 0-.442-2.188c-.284-1.063-1.389-1.681-2.446-1.396z" clip-rule="evenodd" />
        </svg>
      </router-link>
    </div>
    <div class="block sm:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-gray-200 border-teal-light hover:text-gray-400 hover:border-white" @click="toggleNav">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
      </button>
    </div>
    <div :class="openNav ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
      <!-- Top nav links -->
      <div class="text-sm sm:flex-grow font-bold text-gray-200">
        <a href="https://laravel.com/docs/5.8" class="block mt-4 lg:inline-block lg:mt-0 mr-4 hover:text-gray-400">Laravel</a>
        <a href="https://vuejs.org/" class="block mt-4 lg:inline-block lg:mt-0 mr-4 hover:text-gray-400">Vue.js</a>
        <a href="https://tailwindcss.com/" class="block mt-4 lg:inline-block lg:mt-0 mr-4 hover:text-gray-400">Tailwind CSS</a>
        <a href="https://github.com/shriker/laravel-vue-spa-tailwind" class="block mt-4 lg:inline-block lg:mt-0 mr-4 hover:text-gray-400">Github</a>
      </div>

      <!-- Authenticated -->
      <div v-if="user" class="bg-grey-lighter flex flex-col md:flex-row justify-between items-start md:items-center">
        <UserMenu />
      </div>

      <!-- Guest -->
      <template v-else>
        <div class="nav-item mr-4 font-semibold text-white">
          <router-link :to="{ name: 'login' }" class="">
            {{ $t('login') }}
          </router-link>
        </div>
        <div class="nav-item font-semibold text-white">
          <router-link :to="{ name: 'register' }" class="border rounded text-white border-white px-4 py-1 hover:bg-teal-600">
            {{ $t('register') }}
          </router-link>
        </div>
      </template>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import UserMenu from '~/components/UserMenu'

export default {
  components: {
    UserMenu
  },
  data: () => ({
    appName: window.config.appName,
    openNav: false
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
    },
    toggleNav: function () {
      this.openNav = !this.openNav
    }
  }
}
</script>
