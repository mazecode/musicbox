<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4>Play List</h4>
        <ul>
          <li v-for="(track, index) in playList" v-bind="track.title" :key="track.id">{{ track.title }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>

<script>
export default {
  mounted() {
    console.log("PlayList mounted");
  },
  data() {
    return {
      playList: [
        { id: 1, title: "Track A" },
        { id: 2, title: "Track B" },
        { id: 3, title: "Track C" },
        { id: 4, title: "Track D" }
      ]
    };
  },
  methods: {
    async get() {
      let response = await axios.get("/api/playLists");
    }
  }
};
</script>
