require("dotenv").config();

export default {
  mode: "universal",
  /*
   ** Headers of the page
   */
  head: {
    htmlAttrs: {
      lang: "es"
    },
    title: process.env.SITE_NAME || process.env.npm_package_name || "",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        hid: "description",
        name: "description",
        content:
          process.env.SITE_DESCRIPTION ||
          process.env.npm_package_description ||
          ""
      },
      {
        property: "og:title",
        content: "Test title",
        template: chunk => `${chunk} - My page`, //or as string template: '%s - My page',
        vmid: "og:title"
      }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    bodyAttrs: {
      class: ""
    }
  },

  router: {
    linkActiveClass: "active-link",
    routeNameSplitter: "/"
    // middleware: ['auth']
  },
  /*
   ** Customize the progress-bar color
   */
  loading: {
    color: "#4287f5",
    failedColor: "#b0122c",
    height: "4px",
    continuous: true,
  },
  /*
   ** Global CSS
   */
  css: [],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: ["~/plugins/axios", "~plugins/mixins/user.js"],
  /*
   ** Nuxt.js modules
   */
  modules: [
    "@nuxtjs/dotenv",
    "@nuxtjs/axios",
    "@nuxtjs/auth",
    "bootstrap-vue/nuxt",
    [
      "nuxt-fontawesome",
      {
        imports: [
          {
            set: "@fortawesome/free-solid-svg-icons",
            icons: ["fas"]
          },
          {
            set: "@fortawesome/free-brands-svg-icons",
            icons: ["fab"]
          }
        ]
      }
    ]
  ],

  /**
   *
   */
  auth: {
    strategies: {
      local: {
        endpoints: {
          login: {
            url: "/auth/login",
            method: "post",
            propertyName: "meta.token"
          },
          logout: { url: "/auth/logout", method: "post" },
          user: { url: "/auth/user", method: "post", propertyName: "data" }
        },
        tokenRequired: true,
        tokenType: "Bearer"
      },
      facebook: {
        client_id: "your facebook app id",
        userinfo_endpoint:
          "https://graph.facebook.com/v2.12/me?fields=about,name,picture{url},email",
        scope: ["public_profile", "email"]
      },
      google: {
        client_id: "your gcloud oauth app client id"
      }
    },
  },

  /*
   ** Axios module configuration
   ** See https://axios.nuxtjs.org/options
   */
  axios: {
    credentials: false,
    proxy: false,
    debug: true,
    requestInterceptor: (config, { store }) => {
      config.headers.common["Accept"] = "application/json";
      config.headers.common["Authorization"] = "";
      config.headers.common["Content-Type"] =
        "application/x-www-form-urlencoded;application/json";
      return config;
    }
  },

  performance: {
    gzip: false
  },
  /*
   ** Build configuration
   */
  build: {
    loaders: {
      vue: {
        transformAssetUrls: {
          audio: "src"
        }
      }
    },
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: "pre",
          test: /\.(js|vue)$/,
          loader: "eslint-loader",
          exclude: /(node_modules)/
        });
      }

      config.module.rules.push({
        test: /\.(ogg|mp3|wav|mpe?g)$/i,
        loader: "file-loader",
        options: {
          name: "[path][name].[ext]"
        }
      });
    }
  }
};
