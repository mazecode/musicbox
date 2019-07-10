<template>
  <div class="container-fluid fixed-bottom bg-dark">
    <button class="btn btn-secondary btn-sm" @click.prevent="togglePlayer" v-show="!showPlayer">
      <font-awesome-icon icon="eye" />
    </button>

    <div class="row m-0 p-0" v-show="showPlayer">
      <div class="col-12">
        <div class="d-flex justify-content-center my-4">
          <!-- <span class="font-weight-bold indigo-text mr-2 mt-1">{{ currentTime }}</span> -->
          <div class="w-100">
            <h3 class="progress-title">{{ currentTime }}|{{ durationTime }}</h3>
            <div
              @click="seek"
              class="progress orange"
              title="Time played | Total time"
              data-percentage="20"
            >
              <div
                class="progress-bar"
                :style="{ width: percentComplete + '%' }"
                role="progressbar"
                :aria-valuenow="percentComplete"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                <div class="progress-value"></div>
              </div>
            </div>
          </div>
          <!-- <span class="font-weight-bold indigo-text ml-2 mt-1">{{ durationTime }}</span> -->
        </div>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-12">
        <div class="media">
          <div class="media-body text-white">
            <h6 class>{{ artist }}</h6>
            <h5 class="mt-0">{{ title }}</h5>
          </div>
        </div>
      </div>
      <div class="col-12">
        <!-- <button class="btn bt-link btn-sm text-white" @click.prevent="stop">
<font-awesome-icon icon="stop" />
        </button>-->
        <button class="btn bt-link btn-sm text-white" @click.prevent="previous">
          <font-awesome-icon :icon="['fas', 'fast-backward']" size="2x" />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="play" v-if="!playing">
          <font-awesome-icon :icon="['fas', 'play']" size="3x" />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="pause" v-else>
          <font-awesome-icon :icon="['fas', 'pause']" size="3x" />
        </button>
        <button class="btn bt-link btn-sm text-white" @click.prevent="next">
          <font-awesome-icon :icon="['fas', 'fast-forward']" size="2x" />
        </button>
        <!-- <button class="btn bt-link btn-sm text-white" @click.prevent="toggleLoop">
<font-awesome-icon icon="undo" v-if="innerLoop" />
<span v-else>
No
<font-awesome-icon icon="undo" />
</span>
        </button>-->
      </div>
      <div class="col-12">
        <button class="btn bt-link btn-sm text-white" @click.prevent="mute">
          <font-awesome-icon :icon="['fas', 'volume-down']" v-if="!muted" />
          <font-awesome-icon :icon="['fas', 'volumen-mute']" v-else />
        </button>
        <button
          class="btn bt-link btn-sm text-white"
          @click.prevent
          @mouseenter="showVolume = true"
        >
          <font-awesome-icon icon="volume-up" />
        </button>
        <input
          type="range"
          class="custom-range"
          min="0"
          max="100"
          v-model.lazy.number="volume"
          v-show="showVolume"
        />
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

    <audio class="sr-only" :loop="innerLoop" ref="audiofile" :src="file" preload controls></audio>
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
    },
    artist: {
      type: String,
      default: null
    }
  },
  data: () => ({
    track: undefined,
    playing: false,
    currentSeconds: 0,
    durationSeconds: 0,
    time: 0,
    innerLoop: false,
    loaded: false,
    showPlayer: true,
    showVolume: false,
    volume: 100,
    previousVolume: 35
  }),
  created() {
    this.innerLoop = this.loop;
    this.playing = this.playing;
  },
  mounted() {
    this.track = this.$el.querySelectorAll("audio")[0];

    let supportsAudio = !!document.createElement("audio").canPlayType;
    if (supportsAudio) {
      this.track.addEventListener("timeupdate", this.update);
      this.track.addEventListener("loadeddata", this.load);
      this.track.addEventListener("pause", () => {
        this.playing = false;
      });
      this.track.addEventListener("play", () => {
        this.playing = true;
      });
      this.track.addEventListener("ended", async () => {
        await this.next();
        this.autoPlay = await true;
      });
    }
  },
  methods: {
    async play() {
      this.playing = await true;
      this.showTime();
    },
    async pause() {
      this.playing = await false;
    },
    async stop() {
      this.playing = await false;
      this.track.currentTime = await 0;
    },
    async next() {
      await this.$emit("forward", true);
      await this.stop();
      this.autoPlay = await true;
    },
    async previous() {
      await this.$emit("backward", true);
      await this.stop();
      this.autoPlay = await true;
    },
    mute() {
      if (this.muted) {
        return (this.volume = this.previousVolume);
      }

      this.previousVolume = this.volume;
      this.volume = 0;
    },
    showTime() {
      console.log(this.track.seekable);

      this.time = `${this.convertTimeHHMMSS(
        this.track.seekable.start(0)
      )} | ${this.convertTimeHHMMSS(this.track.seekable.end(0))}`;
      console.log(this.time);
    },
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
      if (!this.playing) {
        return;
      }

      const el = e.target.getBoundingClientRect();
      const seekPos = (e.clientX - el.left) / el.width;

      this.track.currentTime = parseInt(this.track.duration * seekPos);
      this.showTime();
    },
    update(e) {
      this.currentSeconds = parseInt(this.track.currentTime);
    },
    convertTimeHHMMSS(val) {
      let hhmmss = new Date(val * 1000).toISOString().substr(11, 8);

      return hhmmss.indexOf("00:") === 0 ? hhmmss.substr(3) : hhmmss;
    }
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
      11;
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
.progress {
    overflow: visible;
}
.progress-bar {
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
}
.progress-bar:after {
    content:"";
    background-color: darkgreen;

    width: 30px;
    height: 30px;
    margin-right: -15px;         /* - 30/2 */
    margin-top: -5px;            /* - (30-20)/2 */
    -webkit-border-radius: 15px; /* 30/2 */
       -moz-border-radius: 15px;
            border-radius: 15px;

    float: right;
}

/*
$colorBase: #fe3b3b;

.progress-title {
  font-size: 18px;
  font-weight: 700;
}
.progress {
  height: 5px;
  background: #e9e9ea;
  border-radius: 0;
  overflow: visible;
  position: relative;
}
.progress:before,
.progress:after {
//   content: "";
//   width: 20px;
//   height: 20px;
//   border-radius: 50%;
//   background: #fff;
//   position: absolute;
//   top: -5px;
//   left: 0;
//   z-index: 1;
}

.progress:after {
//   border: 7px solid #e9e9ea;
//   left: auto;
//   right: 0;
}
.progress .progress-bar {
  box-shadow: none;
  border: none;
  border-radius: 15px;
  position: relative;
  -webkit-animation: animate-positive 1s;
  animation: animate-positive 1s;
}
.progress .progress-value {
  background-color: $colorBase;
  color: $colorBase;
  width: 1.2em;
  height: 1.2em;
  line-height: 27px;
  border-radius: 20px;
  font-size: 17px;
  font-weight: 600;
  position: absolute;
  top: -8px;
  right: 0;
  z-index: 2;
  border: 5px solid $colorBase;
}
.progress:before {
  border: 7px solid $colorBase;
}
.progress-bar {
  background-color: $colorBase;
}
@-webkit-keyframes animate-positive {
  0% {
    width: 0;
  }
}
@keyframes animate-positive {
  0% {
    width: 0;
  }
}*/
</style>
