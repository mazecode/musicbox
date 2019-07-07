<template>
  <div class="container-fluid fixed-bottom">
    <button @click="togglePlayer">Show/Hide</button>
    <div class="row py-2 bg-dark" v-show="showPlayer">
      <div class="col-12 text-center">
        <button class="btn bt-link btn-sm text-white" @click="back">Back</button>
        <button class="btn bt-link btn-sm text-white" @click="play" v-show="!isPlaying">Play</button>
        <button class="btn bt-link btn-sm text-white" @click="pause" v-show="isPlaying">Pause</button>
        <button class="btn bt-link btn-sm text-white" @click="next">Next</button>
        <!-- <button class="btn bt-link btn-sm text-white" @click="stop">Stop</button> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Audio Player mounted");
  },
  data() {
    return {
      track: null,
      isPlaying: false,
      showPlayer: true
    };
  },
  methods: {
    play() {
        this.isPlaying = true;
        console.log('Play track')
    },
    pause() {
        this.isPlaying = false;
        console.log('Pause track')
    },
    stop() {},
    next() {},
    back() {},
    volumenUp() {},
    volumenDown() {},
    showTime() {},
    togglePlayer() {
      this.showPlayer = !this.showPlayer;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
