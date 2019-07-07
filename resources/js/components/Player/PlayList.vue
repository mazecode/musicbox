<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4>Play List</h4>
        <ul>
          <li v-for="track in tracks">{{ track.name }}</li>
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
      playList: Array,
      tracks: [
        { name: "Track A" },
        { name: "Track B" },
        { name: "Track C" },
        { name: "Track D" }
      ],
      track: null
    };
  },
  methods: {
    async get() {
      let response = await axios.get("/api/playLists");
    }
  }
};
</script>
