<template>
  <div>
    <Navbar />
    <nuxt />
    <audio-player />
  </div>
</template>

<style></style>

<script>
import Navbar from '~/layouts/partials/Navbar';
import AudioPlayer from '~/components/player/AudioPlayer.vue'

export default {
  components: {
    Navbar,
    AudioPlayer
  }
}
</script>