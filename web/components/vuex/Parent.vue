<template>
  <div>
    <h1>
      {{ welcome }} <small>{{ message }}</small>
    </h1>
    <h2>Counter: {{ counter }}</h2>
    <button @click.prevent="increment">+</button>
    <Child1 />
  </div>
</template>

<script>
import Child1 from "~/components/vuex/Child1";

export default {
  mounted() {
      console.log(this.$store)
  },
  components: {
    Child1
  },
  data() {
    return {
      welcome: "Hello Word",
    };
  },
  methods: {
    increments() {
      this.$store.dispatch('todos/increment', 10)
    }
  },
  computed: {
    message() {
      return this.$store.getters['todos/message'];
    },
    counter() {
      return this.$store.getters['todos/counter']
    }
  }
};
</script>

<style lang="scss" scoped>
</style>