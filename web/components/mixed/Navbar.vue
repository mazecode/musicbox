<template>
  <div>
    <a class="navbar-item" @click="logout">Logout</a>
  </div>
</template>

<script>
export default {
  methods: {
    async logout() {
      await this.$auth.logout();
    }
  }
};
</script>

<style lang="scss" scoped></style>
