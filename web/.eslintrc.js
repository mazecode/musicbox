module.exports = {
    root: true,
    parserOptions: {
      parser: "babel-eslint",
      sourceType: "module"
    },
    env: {
        browser: true,
        node: true
    },
    globals: {
        $nuxt: true
    },
    extends: [
        "plugin:nuxt/recommended"
      ],
    plugins: ["prettier"],
    rules: {
      "indent": 0,
      "no-tabs": 0,
      "eol-last": "off",
      "generator-star-spacing": 0,
      "no-debugger": process.env.NODE_ENV === "production" ? 2 : 0
    }
}