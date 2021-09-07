window.Vue = require("vue");
window.axios = require("axios");
require("./bootstrap");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import App from "./components/App.vue";

const app = new Vue({
    el: "#root",
    render: h => h(App)
});