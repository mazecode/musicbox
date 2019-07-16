<template>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="display-3">
          MusicBox Player
        </h1>
        <p class="lead">
          Welcome!
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      genres: []
    }
  },
  mounted() {
    console.log('Component mounted.')
  },
  methods: {
    async getGenres() {
      try {
        let response = (await axios.get('/api/player/genres')).data

        console.log(response)
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
