<template>
  <div class="min-h-screen flex flex-col font-sans">
    <tw-navbar />
    <main class="flex-grow p-8">
      <child />
    </main>
    <locale-switcher />
  </div>
</template>

<script>
import TwNavbar from '~/components/TwNavbar'
import LocaleSwitcher from '~/components/LocaleSwitcher'

export default {
  name: 'MainLayout',

  components: {
    TwNavbar,
    LocaleSwitcher
  }
}
</script>
