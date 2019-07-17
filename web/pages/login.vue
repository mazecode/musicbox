<template>
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-4 is-offset-4">
          <h2 class="title has-text-centered">Welcome back!</h2>

          <form method="post" @submit.prevent="login">
            <div class="field">
              <label class="label">Email</label>
              <div class="control">
                <input
                  type="email"
                  class="input"
                  name="email"
                  v-model="email"
                />
              </div>
            </div>
            <div class="field">
              <label class="label">Password</label>
              <div class="control">
                <input
                  type="password"
                  class="input"
                  name="password"
                  v-model="password"
                />
              </div>
            </div>
            <div class="control">
              <button type="submit" class="button is-dark is-fullwidth">
                Log In
              </button>
            </div>
          </form>
          <div class="has-text-centered" style="margin-top: 20px">
            <p>
              Don't have an account?
              <nuxt-link to="/register">Register</nuxt-link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  layout: "login",
  middleware: "guest",
  components: {},
  data() {
    return {
      email: "",
      password: "",
      error: null
    };
  },
  methods: {
    async login() {
      try {
        this.$bvToast.toast("Logging in...", {
          title: "Message",
          autoHideDelay: 1000,
          variant: "info",
          appendToast: true
        });

        await this.$auth
          .loginWith("local", {
            data: {
              email: this.email,
              password: this.password
            }
          })
          .catch(e => {
            this.$bvToast.toast("Failed Logging In", {
              title: "Error"
            });
            console.log(e);
          });

        if (this.$auth.loggedIn) {
          await this.$bvToast.toast("Successfully Logged In", {
            title: "Success",
            // autoHideDelay: 8000,
            variant: "success",
            appendToast: true
          });

          await this.$router.push("/");
        }
      } catch (e) {
        this.$bvToast.toast("Username or Password wrong", {
          title: "Error",
          appendToast: true
        });
        console.log(e);
      }
    },
    async google() {
      // await this.$auth.loginWith("google").catch(e => {
      //   this.$toast.show("Error", { icon: "fingerprint" });
      // });
    },
    async facebook() {
      // await this.$auth.loginWith("facebook").catch(e => {
      //   this.$toast.show("Error", { icon: "fingerprint" });
      // });
    },
    check() {
      // console.log(this.$auth.loggedIn);
    }
  }
};
</script>