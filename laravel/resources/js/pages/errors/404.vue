<template>
  <div class="min-h-screen flex flex-col justify-center items-center">
    <a-well class="text-center p-6">
      <h3 class="mb-4 text-2xl">
        404 {{ $t('page_not_found') }}
      </h3>

      <div class="links">
        <router-link :to="{ name: 'dashboard' }">
          <span class="btn-flat">{{ $t('go_home') }}</span>
        </router-link>
      </div>
    </a-well>
  </div>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>
