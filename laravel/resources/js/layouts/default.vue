<template>
  <div class="bg-gray-700 min-h-screen flex flex-col font-sans">
    <tw-navbar />
    <main class="flex-grow p-8">
      <child />
    </main>
    <Footer />
  </div>
</template>

<script>
import TwNavbar from '~/components/TwNavbar'
import Footer from '~/components/Footer'

export default {
  name: 'MainLayout',

  components: {
    TwNavbar,
    Footer
  }
}
</script>
