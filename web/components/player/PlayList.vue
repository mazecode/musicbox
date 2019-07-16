<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4>Play List</h4>
        <ul>
          <li
            v-for="(track, index) in playList"
            :key="track.id"
            v-bind="track.title"
          >
            {{ track.title }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style></style>

<script>
export default {
  name: 'PlayList',
  data() {
    return {
      playList: [
        { id: 1, title: 'Track A' },
        { id: 2, title: 'Track B' },
        { id: 3, title: 'Track C' },
        { id: 4, title: 'Track D' }
      ]
    }
  },
  mounted() {
    console.log('PlayList mounted')
  },
  methods: {
    async get() {
      let response = await axios.get('/api/playLists')
    }
  }
}
</script>
