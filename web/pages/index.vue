<template>
  <div class="container">
    <template v-if="loggedIn">Hello {{ user.name }}</template>
    <template v-else>
      Please sign in
    </template>
  </div>
</template>

<script>
export default {
};
</script>

<style>
</style>