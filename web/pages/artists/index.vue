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
import PlayList from '~/components/player/PlayList.vue'

export default {
  components: {
    PlayList
  },
  data() {
    return {
      artists: this.$store.states.artists.all,
      artists: null,
      links: []
    }
  },
  async asyncData({ $axios }) {
    // try {
    //   let response = await $axios.$get('/player/artists')
    //   artists = response.data
    //   links = response.links
    //   return { artists, links }
    // } catch (err) {
    //   console.error(err)
    // }
  },
  methods: {
    async all() {}
  }
}
</script>

<style lang="scss" scoped></style>
