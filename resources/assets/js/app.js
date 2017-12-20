// setup lodash
window._ = require("lodash");

// setup jquery
try {
  // window.$ = window.jQuery = require('jquery');
} catch (e) {}

// setup axios
window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// setup token
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
  console.error(
    "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
  );
}

window.Vue = require("vue");

Object.defineProperty(Vue.prototype, '_', { value: require('lodash') });

Vue.component("markdown", require("./components/Markdown.vue"));
Vue.component("blog-meta", require("./components/BlogMeta.vue"));

const app = new Vue({
  el: "#app",
  data () {
    return {
      category_id: 0,
    }
  },
  methods: {
    categoryChangeForMeta() {
      // trigger fetchMeta method on BlogMeta component
      this.$refs.blogMeta.fetchMeta()
    }
  }
});

require("./link-method");
// require("./dropdown-ajax");
