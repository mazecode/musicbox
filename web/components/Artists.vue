<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="display-2">
          Artists
        </h3>
        <ul class="list-unstyled">
          <li v-for="artist in artists">
            {{ artist.attributes.name }}
          </li>
        </ul>
      </div>
      <div class="col-12">
        <play-list-vue />
      </div>
    </div>
  </div>
</template>

<script>
import PlayListVue from './Player/PlayList.vue'
export default {
  components: {
    PlayListVue
  },
  data() {
    return {
      artists: [],
      artists: null,
      links: []
    }
  },
  mounted() {
    console.log('Artists mounted')
    this.all()
  },
  methods: {
    async all() {
      try {
        let response = await axios.get('/api/player/artists')
        this.artists = response.data.data
        this.links = response.data.links
      } catch (err) {
        console.error(err)
      }
    }
  }
}
</script>

<style lang="scss" scoped></style>
