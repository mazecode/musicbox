<template>
  <div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand"><font-awesome-icon icon="user-secret"/> MusicBox Player</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <router-link to="/" class="nav-link">
                Home
                <span class="sr-only">(current)</span>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/about" class="nav-link">About</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/artists" class="nav-link">Artists</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="mt-2">
      <router-view></router-view>
      <audio-player-vue></audio-player-vue>
    </div>
  </div>
</template>

<style scoped>
</style>

<script>

import AudioPlayerVue from '../components/Player/AudioPlayer.vue'

export default {
    components: {
        AudioPlayerVue
    }
};
</script>
