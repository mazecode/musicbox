<template>
  <div>
    <h2>Artist {{ title }}</h2>
  </div>
</template>

<script>
export default {
  validate({ params }) {
    // Must be a number
    return /\w+/.test(params.title)
  },
  data() {
    return {
      title: this.$route.params.title
    }
  }
}
</script>

<style></style>
