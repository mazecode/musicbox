<template>
  <div>
    <nuxt />
    <audio-player></audio-player>
  </div>
</template>

<style>
</style>

<script>
import AudioPlayer from '~/components/player/AudioPlayer.vue'

export default {
  components: {
    AudioPlayer
  }
}
</script>
