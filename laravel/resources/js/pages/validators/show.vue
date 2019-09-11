<template>
  <div class="flex-grow">
    <a-breadcrumbs>
      <span slot="title">
        <router-link :to="{ name: 'validators' }">
          Validators
        </router-link>
        <span class="mx-3 text-gray-400 font-light text-2xl leading-none">/</span>{{ validator.displayName }}</span>
      <span slot="dropdown">delete validator</span>
    </a-breadcrumbs>
    <div class="px-12 py-8 mx-auto max-w-4xl">
      <transition name="fade" mode="out-in">
        <router-view :validator="validator" />
      </transition>
    </div>
  </div>
</template>

<script>
import ABreadcrumbs from '~/components/Breadcrumbs'
import { mapGetters } from 'vuex'
export default {
  components: { ABreadcrumbs },
  middleware: 'auth',
  data () {
    return {
      tabs: [
        {
          name: 'General',
          route: 'account.details',
          params: { uuid: this.$route.params.uuid }
        }
      ]
    }
  },
  computed: {
    ...mapGetters('validator', ['getValidatorByUuid']),
    validator: function () {
      return this.getValidatorByUuid(this.$route.params.uuid)
    }
  }
}
</script>
