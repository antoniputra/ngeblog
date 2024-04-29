import { createApp } from "vue";
import App from "./App.vue";
import router from "./routes";
import axios from "axios";

const token = document.head.querySelector('meta[name="csrf-token"]');

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
}

createApp(App).use(router).mount("#ngeblog-app");
