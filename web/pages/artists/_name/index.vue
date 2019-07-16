<template>
  <div>
    {{ name }}
  </div>
</template>

<script>
export default {
  validate({ params }) {
    // Must be a number
    return /\w/.test(params.name)
  },
  data() {
    return {
      name: this.$route.params.name
    }
  }
}
</script>

<style lang="scss" scoped></style>
