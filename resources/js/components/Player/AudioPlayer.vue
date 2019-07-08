<template>
  <div class="container-fluid fixed-bottom bg-dark">
    <button class="btn btn-secondary btn-sm" @click.prevent="togglePlayer" v-show="!showPlayer">
      <font-awesome-icon icon="eye" />
    </button>

    <div class="row" v-show="showPlayer">
      <div class="col-12 p-0 m-0">
        <div v-on:click="seek" class="player-progress" title="Time played : Total time">
          <div class="progress" style="height: 2px">
            <div
              class="progress-bar"
              :style="{ width: this.percentComplete + '%' }"
              role="progressbar"
              :aria-valuenow="this.percentComplete"
              aria-valuemin="0"
              aria-valuemax="100"
            ></div>
          </div>
        </div>
      </div>
      <div class="col-12 py-0 my-0 text-white">
        <small class="float-left">{{ currentTime }}</small>
        <small class="float-right">{{ durationTime }}</small>
      </div>
    </div>
    <div class="row py2">
      <div class="col-12 col-md-8">
        <div class="media">
          <img :src="cover" class="mr-3" :alt="title" />
          <div class="media-body text-white">
            <h5 class="mt-0">{{ title }}</h5>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 text-center">
        <button class="btn bt-link btn-sm text-white" @click.prevent="stop">
          <font-awesome-icon icon="stop" />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="previous">
          <font-awesome-icon icon="step-backward" />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="playPause">
          <font-awesome-icon icon="play" v-if="!playing" />
          <font-awesome-icon icon="pause" v-else />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="next">
          <font-awesome-icon icon="step-forward" />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="toggleLoop">
          <font-awesome-icon icon="undo" v-if="innerLoop" />
          <span v-else>
            No
            <font-awesome-icon icon="undo" />
          </span>
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="mute">
          <font-awesome-icon icon="volume-down" v-if="!muted" />
          <font-awesome-icon icon="volume-mute" v-else />
        </button>
        <button
          class="btn bt-link btn-sm text-white"
          @click.prevent
          @mouseenter="showVolume = true"
        >
          <font-awesome-icon icon="volume-up" />
        </button>
        <input type="range" min="0" max="100" v-model.lazy.number="volume" v-show="showVolume" />
        <div class="btn-group dropup">
          <button
            class="btn btn-link btn-sm"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <font-awesome-icon icon="ellipsis-v" />
          </button>
          <div class="dropdown-menu">
            <button class="btn btn-link btn-sm" @click="togglePlayer">Show/Hide</button>
            <button class="btn btn-link btn-sm" @click.prevent="download">Download</button>
          </div>
        </div>
      </div>
    </div>

    <audio class="sr-only" :loop="innerLoop" ref="audiofile" :src="file" preload="auto"></audio>
  </div>
</template>

<script>
export default {
  props: {
    file: {
      type: String,
      default: null,
      required: true
    },
    autoPlay: {
      type: Boolean,
      default: false
    },
    loop: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      default: null,
      required: true
    },
    cover: {
      type: String,
      default: null
    }
  },
  data: () => ({
    track: undefined,
    playing: false,
    currentSeconds: 0,
    durationSeconds: 0,
    innerLoop: false,
    loaded: false,
    showPlayer: true,
    showVolume: false,
    volume: 100,
    previousVolume: 35
  }),
  created() {
    this.innerLoop = this.loop;
    this.trackFile = this.file;
  },
  mounted() {
    this.track = this.$el.querySelectorAll("audio")[0];

    this.track.addEventListener("timeupdate", this.update);
    this.track.addEventListener("loadeddata", this.load);
    this.track.addEventListener("pause", () => {
      this.playing = false;
    });
    this.track.addEventListener("play", () => {
      this.playing = true;
    });
    this.track.addEventListener("onended", async () => {
      await this.next();
    });
  },
  methods: {
    playPause() {
      this.playing = !this.playing;
    },
    stop() {
      this.playing = false;
      this.track.currentTime = 0;
    },
    async next() {
      await this.$emit("forward", true);
      this.playing = await true;
    },
    async previous() {
      await this.$emit("backward", true);
      this.playing = await true;
    },
    mute() {
      if (this.muted) {
        return (this.volume = this.previousVolume);
      }

      this.previousVolume = this.volume;
      this.volume = 0;
    },
    showTime() {},
    togglePlayer() {
      this.showPlayer = !this.showPlayer;
    },
    toggleLoop() {
      this.innerLoop = !this.innerLoop;
    },
    download() {
      this.stop();
      window.open(this.file, "download");
    },
    load() {
      if (this.track.readyState >= 2) {
        this.loaded = true;
        this.durationSeconds = parseInt(this.track.duration);

        return (this.playing = this.autoPlay);
      }

      throw new Error("Failed to load sound file.");
    },
    seek(e) {
      if (!this.playing || e.target.tagName === "SPAN") {
        return;
      }

      const el = e.target.getBoundingClientRect();
      const seekPos = (e.clientX - el.left) / el.width;

      this.track.currentTime = parseInt(this.track.duration * seekPos);
    },
    update(e) {
      this.currentSeconds = parseInt(this.track.currentTime);
    },
    convertTimeHHMMSS(val) {
      let hhmmss = new Date(val * 1000).toISOString().substr(11, 8);

      return hhmmss.indexOf("00:") === 0 ? hhmmss.substr(3) : hhmmss;
    },
  },
  computed: {
    currentTime() {
      return this.convertTimeHHMMSS(this.currentSeconds);
    },
    durationTime() {
      return this.convertTimeHHMMSS(this.durationSeconds);
    },
    percentComplete() {
      return parseInt((this.currentSeconds / this.durationSeconds) * 100);
    },
    muted() {
      return this.volume / 100 === 0;
    }
  },
  watch: {
    playing(value) {
      if (value) {
        return this.track.play();
      }

      this.track.pause();
    },
    volume(value) {
      this.showVolume = false;
      this.track.volume = this.volume / 100;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
