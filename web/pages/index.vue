<template>
  <div class="container">
    <logo />
  </div>
</template>

<script>
import Logo from '~/components/Logo.vue'

export default {
  components: {
    Logo,
  },
  data: () => ({}),
  async asyncData({ $axios }) {}
}
</script>

<style>
</style>
