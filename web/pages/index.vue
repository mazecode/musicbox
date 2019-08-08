<template>
  <div class="container">
    <template v-if="loggedIn"
      >Hello {{ user.name }}</template
    >
    <template v-else>
      Please sign in
      <Parent />
    </template>
  </div>
</template>

<script>
import Parent from "~/components/vuex/Parent";

export default {
  auth: false,
  components: {
    Parent
  }
};
</script>

<style>
</style>