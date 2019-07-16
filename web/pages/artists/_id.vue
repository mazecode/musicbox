<template>
  <div>
    <h2>Artist {{ id }}</h2>
    <nuxt-child />
  </div>
</template>

<script>
export default {
  validate({ params }) {
    // Must be a number
    return /^\d+$/.test(params.id)
  },
  data() {
    return {
      id: this.$route.params.id
    }
  }
}
</script>

<style></style>
